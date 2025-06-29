<?php

return [
    'defaults' => [
        'guard' => 'web', // Guard default untuk user biasa
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [ // Guard untuk user biasa
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [ // Guard TERPISAH untuk admin
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],

    'providers' => [
        'users' => [ // Provider untuk model User
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admins' => [ // Provider untuk model Admin
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
        'admins' => [ // Opsional: Konfigurasi reset password untuk admin
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];