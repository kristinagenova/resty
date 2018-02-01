<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),         // Your GitHub Client ID
        'client_secret' => env('GITHUB_CLIENT_SECRET'), // Your GitHub Client Secret
        'redirect' => 'http://127.0.0.1:8000/social/github/callback',
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),         // Your Facebook Client ID
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'), // Your Facebook Client Secret
        'redirect' => 'http://127.0.0.1:8000/social/facebook/callback',
    ],

    'twitter' => [
        'client_id' => env('TWITTER_CLIENT_ID'),         // Your Facebook Client ID
        'client_secret' => env('TWITTER_CLIENT_SECRET'), // Your Facebook Client Secret
        'redirect' => 'http://127.0.0.1:8000/social/twitter/callback',
    ],

    'zomato' => [
        'api_key' => env('ZOMATO_API_KEY'),
    ],

    'google' => [
        'api_key' => env('GOOGLE_MAPS_API_KEY'),
    ],

];
