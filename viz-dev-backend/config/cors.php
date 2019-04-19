<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */

    'supportsCredentials' => true,
    'allowedOrigins' => [
        'http://localhost',
        'https://localhost',
    ],
    'allowedOriginsPatterns' => [],
    'allowedHeaders' => ['*'],
    'allowedMethods' => [
        'GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'OPTIONS',
    ],
    'exposedHeaders' => [],
    'maxAge' => 0,
];
