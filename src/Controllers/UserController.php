<?php

namespace BalajiDharma\LaravelAdminCore\Controllers;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function helloWorld()
    {
        return view('admin::hello');
    }
}