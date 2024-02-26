<?php

use App\Http\Controllers\Public\SitemapController;
use App\Http\Resources\Views\Sitemaps\SitemapPagesContentResource;
use App\Http\Resources\Views\Sitemaps\SitemapsContentResource;
use App\Models\Page;

test('TEMPLATE_SITEMAP_INDEX blade template exists', function () {
    $template = (new ReflectionClassConstant(
        SitemapController::class,
        'TEMPLATE_SITEMAP_INDEX'
    ))->getValue();

    expect($template)->toBeString();

    $this->assertFileExists(resource_path('views/' . $template . '.blade.php'));
});

test('TEMPLATE_SITEMAP_ITEMS blade template exists', function () {
    $template = (new ReflectionClassConstant(
        SitemapController::class,
        'TEMPLATE_SITEMAP_ITEMS'
    ))->getValue();

    expect($template)->toBeString();

    $this->assertFileExists(resource_path('views/' . $template . '.blade.php'));
});

test('index renders the sitemap index view', function () {
    $route = route('sitemap.index');
    $actual = $this->get($route);
    $session = session()->all();
    $headers = $actual->headers->all();

    $actual
        ->assertStatus(200)
        ->assertSessionHasNoErrors()
        ->assertViewIs('sitemaps.default');

    expect($session)->toHaveCorrectSessionValues($route);

    expect($headers)->toHaveCorrectHeaderValues();

    expect($actual)->toHaveCorrectXmlSitemapIndex((new SitemapsContentResource)->getItems());
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
        ->assertViewIs('sitemaps.items');

    expect($session)->toHaveCorrectSessionValues($route);

    expect($headers)->toHaveCorrectHeaderValues();

    expect($actual)->toHaveCorrectXmlSitemapPages((new SitemapPagesContentResource)->getItems());
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
