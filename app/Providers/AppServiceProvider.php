<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force session configuration
        if ($this->app->runningInConsole() === false) {
            $this->app['config']['session.driver'] = config('session.driver', 'file');
            $this->app['config']['session.path'] = storage_path('framework/sessions');
        }
    }
}
