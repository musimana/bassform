<?php

use App\Http\Resources\Views\Sitemaps\SitemapPagesContentResource;
use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(SitemapPagesContentResource::class)
    ->toImplement(ConstantIndexInterface::class);

arch('it has a getItems method')
    ->expect(SitemapPagesContentResource::class)
    ->toHaveMethod('getItems');

arch('it\'s in use in the App namespace')
    ->expect(SitemapPagesContentResource::class)
    ->toBeUsedIn('App');

test('getItems returns ok', function () {
    $actual = (new SitemapPagesContentResource)->getItems();

    expect($actual)
        ->toBeArray()
        ->toHaveCount(1);

    expect($actual[0])
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->toMatchArray([
            'loc' => url('/'),
            'lastmod' => '1970-01-01',
            'changefreq' => 'weekly',
            'priority' => 0.8,
        ]);
});
