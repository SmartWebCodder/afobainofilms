<?php

namespace App\Console\Commands;

use Cloudinary\Cloudinary;
use Illuminate\Console\Command;

class UploadToCloudinary extends Command
{
    protected $signature = 'cloudinary:upload {file : Path to the file to upload} {--folder=videos : Cloudinary folder} {--public-id= : Custom public ID} {--resource-type=video : Resource type (image, video, raw)}';

    protected $description = 'Upload a file to Cloudinary and return the secure URL';

    public function handle(): int
    {
        $filePath = $this->argument('file');

        if (! file_exists($filePath)) {
            $this->error("File not found: {$filePath}");

            return self::FAILURE;
        }

        $config = config('services.cloudinary');

        if (empty($config['cloud_name']) || empty($config['api_key']) || empty($config['api_secret'])) {
            $this->error('Cloudinary credentials are not configured. Check your .env file.');

            return self::FAILURE;
        }

        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => $config['cloud_name'],
                'api_key' => $config['api_key'],
                'api_secret' => $config['api_secret'],
            ],
            'url' => [
                'secure' => true,
            ],
        ]);

        $fileSize = filesize($filePath);
        $this->info("Uploading: {$filePath} (" . number_format($fileSize / 1024 / 1024, 1) . ' MB)');

        $options = [
            'folder' => $this->option('folder'),
            'resource_type' => $this->option('resource-type'),
            'overwrite' => true,
        ];

        if ($publicId = $this->option('public-id')) {
            $options['public_id'] = $publicId;
        }

        try {
            $this->info('Uploading to Cloudinary... This may take a moment.');

            $result = $cloudinary->uploadApi()->upload($filePath, $options);

            $this->newLine();
            $this->info('Upload successful!');
            $this->table(
                ['Property', 'Value'],
                [
                    ['Public ID', $result['public_id']],
                    ['Format', $result['format']],
                    ['Size', number_format($result['bytes'] / 1024 / 1024, 1) . ' MB'],
                    ['URL', $result['secure_url']],
                ]
            );

            $this->newLine();
            $this->line('Secure URL:');
            $this->comment($result['secure_url']);

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Upload failed: ' . $e->getMessage());

            return self::FAILURE;
        }
    }
}
