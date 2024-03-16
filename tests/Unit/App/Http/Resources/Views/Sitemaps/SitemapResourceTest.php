<?php

use App\Http\Resources\Views\Sitemaps\SitemapResource;
use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(SitemapResource::class)
    ->toImplement(ConstantIndexInterface::class);

arch('it has a getItems method')
    ->expect(SitemapResource::class)
    ->toHaveMethod('getItems');

arch('it\'s in use in the App namespace')
    ->expect(SitemapResource::class)
    ->toBeUsedIn('App');

test('getItems returns ok', function () {
    $actual = (new SitemapResource)->getItems();

    expect($actual)
        ->toBeArray()
        ->toHaveCount(1)
        ->toMatchArray([
            url('sitemaps/pages.xml'),
        ]);
});
