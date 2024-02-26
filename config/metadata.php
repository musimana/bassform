<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Meta Author
    |--------------------------------------------------------------------------
    |
    | The string used for the app's HTML head element's
    | `<meta name="author">` content.
    |
    */

    'author' => env('APP_AUTHOR', ''),

    /*
    |--------------------------------------------------------------------------
    | Copyright Message
    |--------------------------------------------------------------------------
    |
    | The copyright message string to be used in the footer.
    |
    */

    'copyright' => env('APP_COPYRIGHT', 'MIT (' . date('Y') . ')'),

    /*
    |--------------------------------------------------------------------------
    | Meta Description
    |--------------------------------------------------------------------------
    |
    | The string used for the app's HTML head element's
    | `<meta name="description">` content.
    |
    */

    'description' => env('APP_DESCRIPTION', ''),

    /*
    |--------------------------------------------------------------------------
    | Social Media Links
    |--------------------------------------------------------------------------
    |
    | Array of external links to be made available to the app's frontend.
    |
    */

    'social_links' => [
        'github' => env('APP_LINK_PROJECT_REPO'),
    ],
];
