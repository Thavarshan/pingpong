<?php

return [
    'user' => [
        'name' => env('DEFAULT_USER_NAME', 'User'),
        'email' => env('DEFAULT_USER_EMAIL', 'user@example.com'),
        'password' => env('DEFAULT_USER_PASSWORD'), // Make sure the value is hashed.
    ],
];
