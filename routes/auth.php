<?php

use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;

$router = app('router');

// Guest routes
$router->group(['middleware' => GuestMiddleware::class], function($router) {
    $router->get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm');
    $router->post('/login', 'App\Http\Controllers\Auth\LoginController@login');
    $router->get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm');
    $router->post('/register', 'App\Http\Controllers\Auth\RegisterController@register');
});

// Protected routes
$router->group(['middleware' => AuthMiddleware::class], function($router) {
    $router->get('/dashboard', 'App\Http\Controllers\DashboardController@index');
    $router->post('/logout', 'App\Http\Controllers\Auth\LoginController@logout');
});