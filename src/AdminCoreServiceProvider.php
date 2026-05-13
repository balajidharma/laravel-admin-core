<?php

namespace BalajiDharma\LaravelAdminCore;

use Illuminate\Support\ServiceProvider;

class AdminCoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/admin.php', 'admin'
        );
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/admin.php' => config_path('admin.php'),
            ], ['config', 'admin-core', 'admin-core-config']);

            $this->publishes([
                __DIR__.'/../database/seeders/AdminCoreSeeder.php' => database_path('seeders/AdminCoreSeeder.php'),
            ], ['seeders', 'admin-core', 'admin-core-seeders']);
        }
    }
}
