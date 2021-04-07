<?php

namespace Martynv\LaravelUuidModels;

use Illuminate\Support\ServiceProvider;

class LaravelUuidModelsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'martynv');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'martynv');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-uuid-models.php', 'laravel-uuid-models');
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravel-uuid-models.php' => config_path('laravel-uuid-models.php'),
        ], 'laravel-uuid-models.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/martynv'),
        ], 'laravel-uuid-models.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/martynv'),
        ], 'laravel-uuid-models.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/martynv'),
        ], 'laravel-uuid-models.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
