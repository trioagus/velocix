<?php

namespace App\Providers;

use Velocix\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered
     *
     * @var array
     */
    public $bindings = [
        // Example:
        // ServerProvider::class => DigitalOceanServerProvider::class,
    ];

    /**
     * All of the container singletons that should be registered
     *
     * @var array
     */
    public $singletons = [
        // Example:
        // DowntimeNotifier::class => PingdomDowntimeNotifier::class,
    ];

    /**
     * Register any application services
     *
     * This method is called before boot() and is used to bind services into the container
     */
    public function register()
    {
        // Register repository bindings here
        // Example:
        // $this->app->bind(
        //     \App\Repositories\Contracts\UserRepositoryInterface::class,
        //     \App\Repositories\UserRepository::class
        // );

        // Register your service bindings here
        // Example:
        // $this->app->singleton(UserService::class, function($app) {
        //     return new UserService($app->make(UserRepositoryInterface::class));
        // });
    }

    /**
     * Bootstrap any application services
     *
     * This method is called after all providers have been registered
     */
    public function boot()
    {
        // Bootstrap code here (runs after all services are registered)
        // Example:
        // - Load routes
        // - Publish assets
        // - Register view composers
        // - Boot database migrations
    }
}