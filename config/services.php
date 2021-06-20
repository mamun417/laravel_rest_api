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
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '906129273056222',
        'client_secret' => '261558c8965e54ce14d78644ba2d7d37',
        'redirect' => 'https://localhost/laravel-socialite/public/login/facebook/callback'
    ],

    'github' => [
        'client_id' => 'Iv1.a3cb5fc08ad9437c',
        'client_secret' => 'c87703f87a6dcda89e2ea7ab54de0a7f39fc20bd',
        'redirect' => config('app.url') . '/api/auth/login/github/callback'
    ],

    'google' => [
        'client_id' => '806913873830-knbqlue4k4ko4874sjhrbf26m8f5t9gt.apps.googleusercontent.com',
        'client_secret' => '0L0N7FQygLCG3xLLJi0rN-QU',
        'redirect' => config('app.url') . '/api/auth/login/google/callback'
    ],

    'twitter' => [
        'client_id' => 'bliQonScn5ZWT0UKcHhnoYKf6',
        'client_secret' => 'StHHgA4yaj15ByyB6Qg1xoNwkqVtfG1FJYlynV9yWH0Hhc2qni',
        'redirect' => config('app.url') . '/api/auth/login/twitter/callback'
    ],

    'linkedin' => [
        'client_id' => '78khf88p1jtz89',
        'client_secret' => 'xO6DQTbcKJANLqFb',
        'redirect' => 'http://localhost/laravel-socialite/public/login/linkedin/callback'
    ],
];
