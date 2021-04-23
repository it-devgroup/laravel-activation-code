<?php

use ItDevgroup\LaravelActivationCode\ActivationCodeServiceInterface;

return [
    'default' => [
        'max_attempt' => env('ACTIVATION_CODE_DEFAULT_MAX_ATTEMPT', 5),
        'code_generate_mode' => env(
            'ACTIVATION_CODE_DEFAULT_GENERATE_MODE',
            ActivationCodeServiceInterface::GENERATE_CODE_MODE_ALL
        ),
        'code_length' => env('ACTIVATION_CODE_DEFAULT_CODE_LENGTH', 20),
        'code_ttl' => env('ACTIVATION_CODE_DEFAULT_CODE_TTL', '1h'),
    ],
    'sms' => [
        'max_attempt' => env('ACTIVATION_CODE_SMS_MAX_ATTEMPT', 5),
        'code_generate_mode' => env(
            'ACTIVATION_CODE_SMS_GENERATE_MODE',
            ActivationCodeServiceInterface::GENERATE_CODE_MODE_NUMBER
        ),
        'code_length' => env('ACTIVATION_CODE_SMS_CODE_LENGTH', 4),
        'code_ttl' => env('ACTIVATION_CODE_SMS_CODE_TTL', '5m'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Table name
    |--------------------------------------------------------------------------
    */
    'table' => 'activation_codes',

    /*
    |--------------------------------------------------------------------------
    | Model
    |--------------------------------------------------------------------------
    | Default: \ItDevgroup\LaravelActivationCode\Model\ActivationCode::class
    | Change to your custom class if you need to extend the model or change the table name
    | A custom class must inherit the base class \ItDevgroup\LaravelActivationCode\Model\ActivationCode
    */
    'model' => \ItDevgroup\LaravelActivationCode\Model\ActivationCode::class,
];
