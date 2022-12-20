<?php

namespace BalajiDharma\LaravelAdminCore;

use Illuminate\Support\ServiceProvider;

class AdminCoreServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/admin-routes.php');

        $this->loadViewsFrom(__DIR__.'/resources/views', 'admin');
    }

}