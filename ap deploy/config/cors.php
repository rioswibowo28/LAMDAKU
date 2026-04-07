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

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],    'allowed_origins' => [
        'http://localhost:3000',
        'http://localhost:3001', 
        'http://127.0.0.1:3000',
        'http://127.0.0.1:3001',
        'http://192.168.40.221:3000',
        'http://192.168.40.221:3001',
        'https://lamdaku.com',
        'http://lamdaku.com',
        'https://www.lamdaku.com',
        'http://www.lamdaku.com',
        '*'  // Allow all origins for production
    ],

    'allowed_origins_patterns' => [
        'http://192.168.*.*:3000',  // Allow local network access
        'http://192.168.*.*:3001',  // Allow local network access on port 3001
        'http://10.*.*.*:3000',     // Allow private network access
        'http://10.*.*.*:3001',     // Allow private network access on port 3001
        'http://172.16.*.*:3000',   // Allow private network access
        'http://172.16.*.*:3001',   // Allow private network access on port 3001
    ],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,
];
