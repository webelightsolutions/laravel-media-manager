<?php

namespace Webelightdev\LaravelMediaManager;

use Illuminate\Support\ServiceProvider;

class MediaManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.    
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/resources/lang/en/mediaManager/message', 'MediaManager');

        $this->publishes([__DIR__.'/resources/leng/en' => resource_path('lang/en/mediaManager/messages')]);
        // Config
        $this->publishes([__DIR__.'/../config/mediaManager.php' => config_path('mediaManager.php')]);
        // Migration
        $this->publishes([__DIR__.'/../database/migrations' => $this->app->databasePath().'/migrations'], 'migrations');
       include __DIR__.'/Routes/routes.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind('laravel-mediaManager', function () {
           return new MediaManagerClass();
       });

       $this->app->make('Webelightdev\LaravelMediaManager\Controllers\MediaController');
       $this->loadViewsFrom(__DIR__.'/resources/views/', 'MediaManager');
    }
}
