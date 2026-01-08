<?php

/**
 * Velocix Framework Bootstrap
 */

require __DIR__ . '/../vendor/autoload.php';

use Velocix\Foundation\Application;
use Velocix\Database\Connection;
use Velocix\Database\Model;

// Create application instance
$app = new Application(dirname(__DIR__));

// Load environment variables
if (file_exists($app->basePath('.env'))) {
    $lines = file($app->basePath('.env'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value, '"\'');
            $_ENV[$key] = $value;
            putenv("{$key}={$value}");
        }
    }
}

// Load exception classes manually (FIX untuk autoload issue)
require_once __DIR__ . '/../vendor/velocix/framework/src/Foundation/Exceptions/HttpException.php';

// Load database configuration
$dbConfig = require $app->basePath('config/database.php');

// Get default connection
$defaultConnection = $dbConfig['default'] ?? 'mysql';
$connectionConfig = $dbConfig['connections'][$defaultConnection] ?? [];

// Setup database connection (optional, only if config exists)
if (!empty($connectionConfig)) {
    try {
        $connection = Connection::make($connectionConfig);
        Model::setConnection($connection);
    } catch (\Exception $e) {
        // Silent fail for web, show error for CLI
        if (php_sapi_name() === 'cli') {
            echo "⚠ Database connection failed: " . $e->getMessage() . "\n";
        }
    }
}

// Exception handler
set_exception_handler(function($e) {
    $handler = new \Velocix\Foundation\ExceptionHandler();
    $handler->render($e);
});

return $app;