<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'documentServices' => [
        [
            'url' => env('DOCUMENT_SERVICE_URL1'),
            'key' => env('DOCUMENT_SERVICE_KEY1'),
            'directory' => env('DOCUMENT_SERVICE_DIRECTORY1'),
            'printer' => env('DOCUMENT_SERVICE_PRINTER1'),
        ],
        [
            'url' => env('DOCUMENT_SERVICE_URL2'),
            'key' => env('DOCUMENT_SERVICE_KEY2'),
            'directory' => env('DOCUMENT_SERVICE_DIRECTORY2'),
            'printer' => env('DOCUMENT_SERVICE_PRINTER2'),
        ],
    ]
];
