<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'BalajiDharma\LaravelAdminCore\Controllers',
    'prefix' => 'admin',
], function () {
    Route::get('hello-world', 'UserController@helloWorld');
});

