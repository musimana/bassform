<?php

$standard_array = [
    'title' => 'Title',
    'webpageStatusId' => 1,
    'inSitemap' => true,
];

dataset('page-arrays-update-invalid', function () use ($standard_array) {
    return [
        'empty request' => [
            [],
            [
                'title' => 'The title field is required.',
                'webpageStatusId' => 'The webpage status id field is required.',
                'inSitemap' => 'The in sitemap field is required.',
            ],
        ],
        'title missing' => [
            ['webpageStatusId' => 1, 'inSitemap' => true],
            ['title' => 'The title field is required.'],
        ],
        'title empty' => [
            array_merge($standard_array, ['title' => '']),
            ['title' => 'The title field is required.'],
        ],
        'title not string' => [
            array_merge($standard_array, ['title' => 1]),
            ['title' => 'The title field must be a string.'],
        ],
        'title >255 characters' => [
            array_merge($standard_array, ['title' => str_pad('', 256, 'a')]),
            ['title' => 'The title field must not be greater than 255 characters.'],
        ],
        'metaDescription not string' => [
            array_merge($standard_array, ['metaDescription' => 1]),
            ['metaDescription' => 'The meta description field must be a string.'],
        ],
        'metaDescription >255 characters' => [
            array_merge($standard_array, ['metaDescription' => str_pad('', 256, 'a')]),
            ['metaDescription' => 'The meta description field must not be greater than 255 characters.'],
        ],
        'webpageStatusId missing' => [
            ['title' => 'Title', 'inSitemap' => true],
            ['webpageStatusId' => 'The webpage status id field is required.'],
        ],
        'webpageStatusId empty' => [
            array_merge($standard_array, ['webpageStatusId' => '']),
            ['webpageStatusId' => 'The webpage status id field is required.'],
        ],
        'webpageStatusId not integer' => [
            array_merge($standard_array, ['webpageStatusId' => 'a']),
            ['webpageStatusId' => 'The webpage status id field must be an integer.'],
        ],
        'webpageStatusId > max WebpageStatus' => [
            array_merge($standard_array, ['webpageStatusId' => 42]),
            ['webpageStatusId' => 'The webpage status id field must not be greater than 2.'],
        ],
        'inSitemap missing' => [
            ['title' => 'Title', 'webpageStatusId' => 1],
            ['inSitemap' => 'The in sitemap field is required.'],
        ],
        'inSitemap empty' => [
            array_merge($standard_array, ['inSitemap' => '']),
            ['inSitemap' => 'The in sitemap field is required.'],
        ],
        'inSitemap not boolean' => [
            array_merge($standard_array, ['inSitemap' => 2]),
            ['inSitemap' => 'The in sitemap field must be true or false.'],
        ],
    ];
});
