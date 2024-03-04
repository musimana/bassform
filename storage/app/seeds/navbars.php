<?php

/*
|--------------------------------------------------------------------------
| Navbar Model Seeds
|--------------------------------------------------------------------------
|
| List of models with their data, that will be generated when the
| NavbarSeeder is run.
|
*/

$seeds = [

    [
        'title' => 'Header',
        'navbar_items' => [
            [
                'title' => 'About',
                'url' => url('about'),
            ],
            [
                'title' => 'Features',
                'url' => url('features'),
                'subitems' => [
                    [
                        'title' => 'Forms',
                        'url' => url('forms'),
                    ],
                    [
                        'title' => 'Modals',
                        'url' => url('modals'),
                    ],
                ],
            ],
        ],
    ],

];
