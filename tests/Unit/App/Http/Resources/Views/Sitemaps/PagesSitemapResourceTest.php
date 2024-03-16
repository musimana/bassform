<?php

use App\Http\Resources\Views\Sitemaps\PagesSitemapResource;
use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(PagesSitemapResource::class)
    ->toImplement(ConstantIndexInterface::class);

arch('it has a getItems method')
    ->expect(PagesSitemapResource::class)
    ->toHaveMethod('getItems');

arch('it\'s in use in the App namespace')
    ->expect(PagesSitemapResource::class)
    ->toBeUsedIn('App');

test('getItems returns ok', function () {
    $actual = (new PagesSitemapResource)->getItems();

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
