<?php
require __DIR__ . '/vendor/autoload.php';

use Cloudinary\Cloudinary;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$cloud = new Cloudinary([
    'cloud' => [
        'cloud_name' => $_ENV['CLOUDINARY_CLOUD_NAME'],
        'api_key'    => $_ENV['CLOUDINARY_API_KEY'],
        'api_secret' => $_ENV['CLOUDINARY_API_SECRET'],
    ],
    'url' => ['secure' => true],
]);

$manager = new ImageManager(new Driver());
$urls = [];

for ($i = 1; $i <= 7; $i++) {
    $num = str_pad($i, 2, '0', STR_PAD_LEFT);
    $src = __DIR__ . "/sample_img/{$num}.jpg";
    $tmp = "/tmp/compressed-{$num}.jpg";

    $img = $manager->decodePath($src);
    $enc = $img->scaleDown(width: 1600)->encode(new JpegEncoder(quality: 80));
    file_put_contents($tmp, $enc->toString());

    $r = $cloud->uploadApi()->upload($tmp, [
        'folder'        => 'afobaino-films/gallery',
        'public_id'     => "afobaino-{$num}",
        'resource_type' => 'image',
        'overwrite'     => true,
    ]);

    $urls[$num] = $r['secure_url'];
    @unlink($tmp);
}

// Write JSON results
file_put_contents('/tmp/cloudinary_urls.json', json_encode($urls, JSON_PRETTY_PRINT));
echo "DONE\n";
