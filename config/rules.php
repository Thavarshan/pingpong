<?php

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;
use Emberfuse\Scorch\Rules\PasswordRule;

return [
    /*
     * Password Input Validation Rules.
     */
    'password' => ['required', 'string', new PasswordRule(), 'confirmed'],

    /*
     * User Login Validation Rules.
     */
    'login' => [
        'email' => ['required', 'string', 'email'],
        'password' => ['required', 'string'],
        'remember' => ['nullable'],
    ],

    /*
     * User Registration Validation Rules.
     */
    'register' => [
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
            Rule::unique(User::class),
        ],
        'phone' => ['sometimes', 'string'],
        'password' => ['required', 'string', new PasswordRule(), 'confirmed'],
    ],

    /*
     * User Profile Information Validation Rules.
     */
    'update_profile' => [
        'name' => ['required', 'string', 'max:255'],
        'username' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email'],
        'phone' => ['sometimes', 'string'],
        'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
    ],

    /*
     * Address Inputs Validation Rules.
     */
    'address' => [
        'line1' => ['required', 'string', 'max:255'],
        'line2' => ['sometimes', 'string', 'max:255'],
        'city' => ['required', 'string', 'max:255'],
        'state' => ['required', 'string', 'max:255'],
        'country' => ['required', 'string', 'max:255'],
        'postal_code' => ['required', 'string', 'max:255'],
    ],

    /*
     * User Account Password Update Validation Rules.
     */
    'update_password' => [
        'current_password' => ['required', 'string'],
        'password' => [
            'required',
            'string',
            new PasswordRule(),
            'confirmed',
            'different:current_password',
        ],
    ],
];
