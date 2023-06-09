<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'allow_credentials' => true,

    'paths' => ['api/*', 'auth/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['PUT,DELETE,POST,GET,OPTIONS'],

    'allowed_origins' => ['http://localhost:5173', env('CLIENT_DOMAIN'), "*"],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ["Accept, Authorization, Content-Type", '*'],

    'exposed_headers' => [],

    'max_age' => 122000,

    'supports_credentials' => true,

];
