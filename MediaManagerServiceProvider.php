<?php

namespace Webelightdev\LaravelMediaManager;

use Illuminate\Support\ServiceProvider;

class LaravelMediaManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/src/resources/leng/en', 'MediaManager');

        $this->publishes([__DIR__.'/src/resources/leng/en' => resource_path('lang/mediaManager/message')]);
        // Config
        $this->publishes([__DIR__.'/config/mediaManager.php' => config_path('mediaManager.php')]);
        // Migration
       $this->publishes([__DIR__.'/../database/migrations' => $this->app->databasePath().'/migrations'], 'migrations');

       include __DIR__.'/routes.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind('laravel-mediaManager', function () {
           return new LaravelMediaManagerClass();
       });

       $this->app->make('Webelightdev\LaravelMediaManager\src\Controllers\MediaController');
       $this->loadViewsFrom(__DIR__.'/src/resources/views/', 'MediaManager');
    }
}
