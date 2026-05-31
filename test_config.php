<?php
require 'vendor/autoload.php';
$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);
$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);
$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);
foreach (glob('config/*.php') as $f) {
    try {
        $c = require $f;
        if (!is_array($c)) {
            echo $f . " returns " . gettype($c) . "\n";
        }
    } catch (\Throwable $e) {
        // Ignore errors
    }
}
