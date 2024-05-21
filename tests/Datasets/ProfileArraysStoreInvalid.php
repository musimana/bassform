<?php

$standard_array = [
    'name' => 'Test User',
    'email' => 'test@example.com',
    'password' => 'ten4characters',
    'password_confirmation' => 'ten4characters',
];

dataset('profile-arrays-store-invalid', function () use ($standard_array) {
    return [
        'empty request' => [
            [],
            [
                'name' => 'The name field is required.',
                'email' => 'The email field is required.',
                'password' => 'The password field is required.',
            ],
        ],
        'name missing' => [
            [
                'email' => 'test@example.com',
                'password' => 'ten4characters',
                'password_confirmation' => 'ten4characters',
            ],
            ['name' => 'The name field is required.'],
        ],
        'name empty' => [
            array_merge($standard_array, ['name' => '']),
            ['name' => 'The name field is required.'],
        ],
        'name not string' => [
            array_merge($standard_array, ['name' => 1]),
            ['name' => 'The name field must be a string.'],
        ],
        'name >255 characters' => [
            array_merge($standard_array, ['name' => str_pad('', 256, 'a')]),
            ['name' => 'The name field must not be greater than 255 characters.'],
        ],
        'email missing' => [
            [
                'name' => 'Test User',
                'password' => 'ten4characters',
                'password_confirmation' => 'ten4characters',
            ],
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
        'email not lowercase' => [
            array_merge($standard_array, ['email' => 'TEST@example.com']),
            ['email' => 'The email field must be lowercase.'],
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
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password_confirmation' => 'ten4characters',
            ],
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
        'password >255 characters' => [
            array_merge(
                $standard_array,
                [
                    'password' => str_pad('', 256, 'a'),
                    'password_confirmation' => str_pad('', 256, 'a'),
                ],
            ),
            ['password' => 'The password field must not be greater than 255 characters.'],
        ],
        'password confirmation missing' => [
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => 'ten4characters',
            ],
            ['password' => 'The password field confirmation does not match.'],
        ],
        'password confirmation incorrect' => [
            array_merge($standard_array, ['password_confirmation' => 'password']),
            ['password' => 'The password field confirmation does not match.'],
        ],
    ];
});
