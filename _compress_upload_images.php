<?php

require __DIR__ . '/vendor/autoload.php';

use Cloudinary\Cloudinary;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

// Load env
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => $_ENV['CLOUDINARY_CLOUD_NAME'],
        'api_key'    => $_ENV['CLOUDINARY_API_KEY'],
        'api_secret' => $_ENV['CLOUDINARY_API_SECRET'],
    ],
    'url' => ['secure' => true],
]);

$manager = new ImageManager(new Driver());

$sourceDir = __DIR__ . '/sample_img';
$tmpDir    = __DIR__ . '/storage/app/private';

$files = glob($sourceDir . '/*.jpg');
sort($files);

$results = [];

foreach ($files as $file) {
    $basename = pathinfo($file, PATHINFO_FILENAME);
    $tmpPath  = $tmpDir . "/compressed-{$basename}.jpg";

    echo "Processing {$basename}...\n";

    // Read, resize to max 1600px wide, save at quality 80
    $image = $manager->decodePath($file);
    $encoded = $image->scaleDown(width: 1600)
        ->encode(new JpegEncoder(quality: 80));
    file_put_contents($tmpPath, $encoded->toString());

    $originalSize  = filesize($file);
    $compressedSize = filesize($tmpPath);
    echo "  Compressed: " . round($originalSize / 1024) . "KB -> " . round($compressedSize / 1024) . "KB\n";

    // Upload to Cloudinary
    $result = $cloudinary->uploadApi()->upload($tmpPath, [
        'folder'        => 'afobaino-films/gallery',
        'public_id'     => "afobaino-{$basename}",
        'resource_type' => 'image',
        'overwrite'     => true,
    ]);

    $url = $result['secure_url'];
    echo "  Uploaded: {$url}\n\n";

    $results[$basename] = $url;

    // Cleanup
    @unlink($tmpPath);
}

echo "\n=== ALL URLS ===\n";
foreach ($results as $name => $url) {
    echo "{$name}: {$url}\n";
}
