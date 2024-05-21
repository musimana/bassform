<?php

$standard_array = [
    'email' => 'test@example.com',
    'password' => 'ten4characters',
];

dataset('authenticated-session-arrays-store-invalid', function () use ($standard_array) {
    return [
        'empty request' => [
            [],
            ['email' => 'The email field is required.'],
        ],
        'email missing' => [
            ['password' => 'ten4characters'],
            ['email' => 'The email field is required.'],
        ],
        'email empty' => [
            array_merge($standard_array, ['email' => '']),
            ['email' => 'The email field is required.'],
        ],
        'email not string' => [
            array_merge($standard_array, ['email' => 1]),
            ['email' => 'The email field must be a string.'],
        ],
        'email not email' => [
            array_merge($standard_array, ['email' => 'test@']),
            ['email' => 'The email field must be a valid email address.'],
        ],
        'email >255 characters' => [
            array_merge($standard_array, ['email' => str_pad('', 256, 'a', STR_PAD_LEFT)]),
            ['email' => 'The email field must not be greater than 255 characters.'],
        ],
        'password missing' => [
            ['email' => 'test@example.com'],
            ['password' => 'The password field is required.'],
        ],
        'password empty' => [
            array_merge($standard_array, ['password' => '']),
            ['password' => 'The password field is required.'],
        ],
        'password not string' => [
            array_merge($standard_array, ['password' => 1, 'password_confirmation' => 1]),
            ['password' => 'The password field must be a string.'],
        ],
        'password incorrect' => [
            array_merge($standard_array, ['password' => 'twenty----characters']),
            ['email' => 'These credentials do not match our records.'],
        ],
    ];
});
