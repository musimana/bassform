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
    | Open Graph Image
    |--------------------------------------------------------------------------
    |
    | The string for the filename of the image to be used for the app's
    | Open Graph image. Should be in the resources/images directory, so it's
    | included in Vite's asset bundling.
    |
    | Max size: 8MB, 1200px x 630px.
    | [Open Graph Docs](https://ogp.me/)
    | [Good Blog](https://kaydee.net/blog/open-graph-image/)
    |
    */

    'open_graph_image' => env('APP_IMAGE_OPEN_GRAPH'),

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
