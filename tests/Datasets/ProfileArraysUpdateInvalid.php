<?php

$standard_array = [
    'name' => 'Name',
    'email' => 'test@example.com',
];

dataset('profile-arrays-update-invalid', function () use ($standard_array) {
    return [
        'empty request' => [
            [],
            [
                'name' => 'The name field is required.',
                'email' => 'The email field is required.',
            ],
        ],
        'name missing' => [
            ['email' => 'test@example.com'],
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
            ['name' => 'Name'],
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
    ];
});
