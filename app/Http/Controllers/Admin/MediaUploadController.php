<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Cloudinary\Cloudinary;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

class MediaUploadController extends Controller
{
    private function cloudinary(): Cloudinary
    {
        $config = config('services.cloudinary');

        return new Cloudinary([
            'cloud' => [
                'cloud_name' => $config['cloud_name'],
                'api_key'    => $config['api_key'],
                'api_secret' => $config['api_secret'],
            ],
            'url' => ['secure' => true],
        ]);
    }

    /**
     * Upload and compress an image via Intervention, then push to Cloudinary.
     */
    public function image(Request $request): JsonResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'max:30720'], // 30 MB max
        ]);

        $file = $request->file('image');
        $slug = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $tmpPath = storage_path("app/private/tmp-{$slug}.jpg");

        try {
            // Compress with Intervention Image — resize to max 1600px, quality 80
            $manager = new ImageManager(new Driver());
            $image = $manager->decodePath($file->getRealPath());

            $encoded = $image->scaleDown(width: 1600)
                ->encode(new JpegEncoder(quality: 80));
            file_put_contents($tmpPath, $encoded->toString());

            // Upload to Cloudinary
            $result = $this->cloudinary()->uploadApi()->upload($tmpPath, [
                'folder'        => 'afobaino-films/portfolio',
                'public_id'     => $slug . '-' . Str::random(4),
                'resource_type' => 'image',
                'overwrite'     => true,
            ]);

            return response()->json([
                'url' => $result['secure_url'],
            ]);
        } finally {
            @unlink($tmpPath);
        }
    }

    /**
     * Upload a video, compress with ffmpeg, then push to Cloudinary.
     */
    public function video(Request $request): JsonResponse
    {
        $request->validate([
            'video' => ['required', 'mimes:mp4,mov,avi,webm', 'max:512000'], // 500 MB max
        ]);

        $file = $request->file('video');
        $slug = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $inputPath  = $file->getRealPath();
        $outputPath = storage_path("app/private/tmp-{$slug}.mp4");

        try {
            // Compress with ffmpeg
            $ffmpeg = '/usr/local/bin/ffmpeg';
            $cmd = implode(' ', [
                $ffmpeg,
                '-i',
                escapeshellarg($inputPath),
                '-c:v libx264 -preset medium -crf 28',
                '-vf "scale=1280:-2"',
                '-c:a aac -b:a 128k',
                '-movflags +faststart',
                '-y',
                escapeshellarg($outputPath),
                '2>&1',
            ]);

            exec($cmd, $output, $exitCode);

            if ($exitCode !== 0 || !file_exists($outputPath)) {
                return response()->json([
                    'error' => 'Video compression failed.',
                    'details' => implode("\n", array_slice($output, -5)),
                ], 422);
            }

            // Upload to Cloudinary
            $result = $this->cloudinary()->uploadApi()->upload($outputPath, [
                'folder'        => 'afobaino-films/portfolio',
                'public_id'     => $slug . '-' . Str::random(4),
                'resource_type' => 'video',
                'overwrite'     => true,
            ]);

            // Also generate a thumbnail
            $thumbUrl = str_replace(
                '/video/upload/',
                '/video/upload/so_5,w_800,c_fill,q_80/',
                str_replace('.mp4', '.jpg', $result['secure_url'])
            );

            return response()->json([
                'url'       => $result['secure_url'],
                'thumbnail' => $thumbUrl,
            ]);
        } finally {
            @unlink($outputPath);
        }
    }
}
