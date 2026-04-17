<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Path to the application directory (outside public_html)
$appDir = dirname(__DIR__) . '/afobainofilms';

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = $appDir . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require $appDir . '/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once $appDir . '/bootstrap/app.php';

// Tell Laravel that the public directory is public_html (not app/public)
$app->usePublicPath(__DIR__);

$app->handleRequest(Request::capture());
