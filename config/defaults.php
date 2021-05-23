<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

return [
    /*
     * Default User Related Settings and Details...
     */
    'users' => [
        'credentials' => [
            'name' => 'Administrator',
            'username' => 'administrator',
            'email' => 'admin@preflight.test',
            'phone' => '0112345678',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'email_verified_at' => Carbon::now(),
            'remember_token' => Str::random(10),
            'settings' => [
                'notifications' => ['mail', 'database', 'sms'],
            ],
            'address' => [
                'line1' => '4431 Birch Street',
                'city' => 'Greenwood',
                'state' => 'Indiana',
                'country' => 'United States',
                'postal_code' => '46142',
            ],
            'locked' => false,
            'profile_photo_path' => null,
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
        ],

        'settings' => [
            'notifications' => ['mail', 'database', 'sms'],
        ],
    ],

    /*
     * Default API Related Details...
     */
    'api' => [
        'permissions' => [
            'create',
            'read',
            'update',
            'delete',
        ],
    ],
];
