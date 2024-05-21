<?php

$standard_array = [
    'password' => 'ten4characters',
    'password_confirmation' => 'ten4characters',
];

dataset('password-arrays-update-invalid', function () use ($standard_array) {
    return [
        'empty request' => [
            [],
            ['password' => 'The password field is required.'],
        ],
        'password missing' => [
            ['password_confirmation' => 'ten4characters'],
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
        'password <14 characters' => [
            array_merge($standard_array, ['password' => 'password', 'password_confirmation' => 'password']),
            ['password' => 'The password field must be at least 14 characters.'],
        ],
        'password confirmation missing' => [
            ['password' => 'ten4characters'],
            ['password' => 'The password field confirmation does not match.'],
        ],
        'password confirmation incorrect' => [
            [
                'password' => 'ten4characters',
                'password_confirmation' => 'password',
            ],
            ['password' => 'The password field confirmation does not match.'],
        ],
    ];
});
