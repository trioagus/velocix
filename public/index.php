<?php

/**
 * Velocix Framework - Entry Point
 */

$app = require __DIR__ . '/../bootstrap/app.php';

// DEBUG - Remove after fixing


// Load routes
require $app->basePath('routes/web.php');

// Run the application
$app->run();