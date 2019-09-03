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
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    
    'facebook' => [
        'client_id' => '190297315164957',
        'client_secret' => '6c76c58246e6f66c18f32d74d5225f64',
        'redirect' => 'https://www.atypikhouse.fr/facebook/callback',
    ],
    
    'google' => [
        'client_id' => '463888495338-vbbt7ihd8o3mrkciad0216t5v3ei60hg.apps.googleusercontent.com',
        'client_secret' => 'okl1KVe_prE922UWIrMxD9Iu',
        'redirect' => 'https://www.atypikhouse.fr/google/callback',  
    ], 
    
];
