<?php

use App\Enums\Webpages\WebpageTemplate;
use App\Http\Resources\Views\Sitemaps\PagesSitemapResource;
use App\Http\Resources\Views\Sitemaps\SitemapResource;
use App\Models\Page;

test('index renders the sitemap index view', function () {
    $route = route('sitemap.index');
    $actual = $this->get($route);
    $session = session()->all();
    $headers = $actual->headers->all();

    $actual
        ->assertStatus(200)
        ->assertSessionHasNoErrors()
        ->assertViewIs(str_replace('/', '.', WebpageTemplate::SITEMAP_INDEX->value));

    expect($session)->toHaveCorrectSessionValues($route);

    expect($headers)->toHaveCorrectHeaderValues();

    expect($actual)->toHaveCorrectXmlSitemapIndex((new SitemapResource)->getItems());
});

test('show can render the general pages sitemap view', function () {
    Page::factory()->create([
        'slug' => 'test-page',
        'meta_description' => 'Test page example meta-description.',
        'meta_keywords' => 'test, page, keywords',
        'meta_title' => 'Test Page',
    ]);

    $route = route('sitemap.show', 'pages');
    $actual = $this->get($route);
    $session = session()->all();
    $headers = $actual->headers->all();

    $actual
        ->assertStatus(200)
        ->assertSessionHasNoErrors()
        ->assertViewIs(str_replace('/', '.', WebpageTemplate::SITEMAP_ITEMS->value));

    expect($session)->toHaveCorrectSessionValues($route);

    expect($headers)->toHaveCorrectHeaderValues();

    expect($actual)->toHaveCorrectXmlSitemapPages((new PagesSitemapResource)->getItems());
});

test('show renders the 404 view for unknown sitemaps', function () {
    $route = url('sitemaps/foo.xml');
    $actual = $this->get($route);
    $session = session()->all();

    $actual
        ->assertStatus(404)
        ->assertSessionHasNoErrors();

    expect($session)->toHaveCorrectSessionValues($route);
});
