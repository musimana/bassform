<?php

use App\Http\Resources\Views\Sitemaps\SitemapHomepageContentResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(SitemapHomepageContentResource::class)
    ->toImplement(ConstantItemInterface::class);

arch('it has a getItem method')
    ->expect(SitemapHomepageContentResource::class)
    ->toHaveMethod('getItem');

arch('it\'s in use in the App namespace')
    ->expect(SitemapHomepageContentResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function () {
    $actual = (new SitemapHomepageContentResource)->getItem();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->toMatchArray([
            'loc' => url('/'),
            'lastmod' => '1970-01-01',
            'changefreq' => 'weekly',
            'priority' => 0.8,
        ]);
});
