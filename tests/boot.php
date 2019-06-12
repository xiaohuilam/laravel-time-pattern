<?php
require __DIR__ . '/../vendor/autoload.php';

define('LARAVEL_START', microtime(true));

/**
 * @var \Illuminate\Foundation\Application $app
 */
$app = require_once __DIR__ . '/../vendor/laravel/laravel/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$app->register(\Xiaohuilam\LaravelTimePattern\PatternServiceProvider::class);
