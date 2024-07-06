<?php

use App\Http\Resources\Views\Sitemaps\PagesSitemapResource;
use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(PagesSitemapResource::class)
    ->toImplement(ConstantIndexInterface::class);

test('getItems returns ok', function () {
    $actual = (new PagesSitemapResource)->getItems();

    expect($actual)
        ->toBeArray()
        ->toHaveCount(2);

    expect($actual[0])
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->toMatchArray([
            'loc' => url('/'),
            'lastmod' => strval(config('metadata.first_published_year')) . '-01-01',
            'changefreq' => 'weekly',
            'priority' => '1.0',
        ]);

    expect($actual[1])
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->toMatchArray([
            'loc' => url('privacy'),
            'lastmod' => strval(config('metadata.first_published_year')) . '-01-01',
            'changefreq' => 'yearly',
            'priority' => '0.1',
        ]);
});
