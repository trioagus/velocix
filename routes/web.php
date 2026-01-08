<?php

use Velocix\Foundation\Application;

$router = app('router');

// Home
$router->get('/', 'App\Http\Controllers\HomeController@index');

$router->get('/about', 'App\Http\Controllers\AboutController@index');

// API Routes
$router->group(['prefix' => 'api', 'middleware' => ['api']], function($router) {
    $router->get('/users', 'App\Http\Controllers\Api\UserController@index');
    $router->get('/users/{id}', 'App\Http\Controllers\Api\UserController@show');
});

// Auth Routes (if using make:auth)
if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}