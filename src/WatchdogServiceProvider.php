<?php

namespace Amitav\Watchdog;

use Illuminate\Support\ServiceProvider;

class WatchdogServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('watchdog', function ($app) {
            return new Watchdog;
        });
    }

    public function boot()
    {
        // loading the routes from the routes file.
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/Http/routes.php';
        }

        // define the path to views
        $this->loadViewsFrom(__DIR__ . '/../views', 'watchdog');

        // publishing the watchdog config file
        // publishing the migrations
        $this->publishes([
            __DIR__ . '/config/watchdog.php' => config_path('watchdog.php'),
            __DIR__ . '/migrations/2015_07_13_000000_create_watchdog_table.php' => base_path('database/migrations/2015_07_13_000000_create_watchdog_table.php'),
            __DIR__ . '/WatchdogCleanup.php' => app_path('Console/Commands/WatchdogCleanup.php'),
        ]);
    }
}
