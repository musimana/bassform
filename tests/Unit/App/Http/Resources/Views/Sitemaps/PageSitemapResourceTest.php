<?php

use App\Http\Resources\Views\Sitemaps\PageSitemapResource;
use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->page = Page::factory()->create([
        'slug' => 'test-page',
        'meta_description' => 'Test page example meta-description.',
        'meta_keywords' => 'test, page, keywords',
        'meta_title' => 'Test Page',
    ]);
});

arch('it implements the expected interface')
    ->expect(PageSitemapResource::class)
    ->toImplement(PageItemInterface::class);

arch('it has a getItem method')
    ->expect(PageSitemapResource::class)
    ->toHaveMethod('getItem');

arch('it\'s in use in the App namespace')
    ->expect(PageSitemapResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function () {
    $actual = (new PageSitemapResource)->getItem($this->page);

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->toMatchArray([
            'loc' => url('test-page'),
            'lastmod' => now()->format('Y-m-d'),
            'changefreq' => 'weekly',
            'priority' => 0.8,
        ]);
});
