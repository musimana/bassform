<?php

use Illuminate\Testing\TestResponse;

/*
|--------------------------------------------------------------------------
| Expectation API Extention - toHaveCorrectXmlSitemapPages
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

expect()->extend('toHaveCorrectXmlSitemapPages', function ($content) {
    $this->getContent()
        ->toBeString();

    expect($content)
        ->toBeArray()
        ->toHaveCount(3);

    expect($content[0])
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->toMatchArray([
            'loc' => url('/'),
            'lastmod' => now()->format('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => '1.0',
        ]);

    expect($content[1])
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->toMatchArray([
            'loc' => url('privacy'),
            'lastmod' => now()->format('Y-m-d'),
            'changefreq' => 'yearly',
            'priority' => '0.1',
        ]);

    expect($content[2])
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->toMatchArray([
            'loc' => url('/test-page'),
            'lastmod' => now()->format('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => 0.8,
        ]);

    (new TestResponse($this->value))
        ->assertSeeInOrder([
            '<urlset',
            'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"',
            'xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"',
            'xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"',
            'xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"',
            '>',
            '<url>',
            '<loc>' . url('/') . '</loc>',
            '<lastmod>' . now()->format('Y-m-d') . '</lastmod>',
            '<changefreq>weekly</changefreq>',
            '<priority>1.0</priority>',
            '</url>',
            '</urlset>',
        ], false);

    return $this;
});
