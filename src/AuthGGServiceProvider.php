<?php

namespace Deko96\AuthGG;

use Illuminate\Support\ServiceProvider;

class AuthGGServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('auth-gg.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'auth-gg');

        // Register the main class to use with the facade
        $this->app->singleton('auth-gg', function () {
            return new AuthGG;
        });
    }
}
