<?php

use Illuminate\Testing\TestResponse;

/*
|--------------------------------------------------------------------------
| Expectation API Extention - toHaveCorrectXmlSitemapIndex
|--------------------------------------------------------------------------
|
| Method to extend Pest's Expectation API.
|
| Asserts that the given response contains all of the expected XML tag
| elements in the correct order.
|
| `$response->dump();` is useful for debugging.
|
*/

expect()->extend('toHaveCorrectXmlSitemapIndex', function (array $content) {
    $this->getContent()
        ->toBeString();

    expect($content)
        ->toBeArray()
        ->toHaveCount(1)
        ->toMatchArray([
            url('sitemaps/pages.xml'),
        ]);

    (new TestResponse($this->value))
        ->assertSeeInOrder([
            '<?xml version=\'1.0\' encoding=\'UTF-8\'?>',
            '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">',
            '<sitemap>',
            '<loc>' . url('sitemaps/pages.xml') . '</loc>',
            '</sitemap>',
            '</sitemapindex>',
        ], false);

    return $this;
});
