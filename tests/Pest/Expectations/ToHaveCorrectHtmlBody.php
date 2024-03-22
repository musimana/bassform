<?php

use Illuminate\Testing\TestResponse;

/*
|--------------------------------------------------------------------------
| Expectation API Extention - toHaveCorrectHtmlBody
|--------------------------------------------------------------------------
|
| Method to extend Pest's Expectation API.
|
| Asserts that the given response contains all of the expected HTML <body>
| tag elements in the correct order.
|
| `$response->dump();` is useful for debugging.
|
*/

expect()->extend('toHaveCorrectHtmlBody', function () {
    $this->getContent()
        ->toBeString();

    (new TestResponse($this->value))
        ->assertSeeInOrder([
            '<body class="font-sans antialiased">',
            '<div id="app" data-page="{',
            '></div>',
            '</body>',
            '</html>',
        ], false);

    return $this;
});
