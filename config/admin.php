<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Prefix Settings
    |--------------------------------------------------------------------------
    |
    | Admin default prefix is "admin".
    | You can override the value by setting new prefix instead of admin.
    |
    */
    'prefix' => env('ADMIN_PREFIX', 'admin'),

    /*
    |--------------------------------------------------------------------------
    | Admin Pagination Settings
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default pagination settings for your application.
    |
    */
    'paginate' => [
        'per_page' => 10,
        'each_side' => 2,
    ],
];
