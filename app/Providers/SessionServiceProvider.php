<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Session\SessionManager;

class SessionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('session', function ($app) {
            return new SessionManager($app);
        });

        $this->app->singleton('session.store', function ($app) {
            return $app['session']->driver();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Force session driver configuration
        if ($this->app->runningInConsole()) {
            return;
        }

        $sessionManager = $this->app['session'];
        
        // Ensure default session driver is properly configured
        $sessionManager->extend('file', function ($app) use ($sessionManager) {
            return $sessionManager->createFileDriver();
        });
    }
}
