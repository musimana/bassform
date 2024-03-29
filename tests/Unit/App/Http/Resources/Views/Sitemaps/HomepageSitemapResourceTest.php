<?php

use App\Http\Resources\Views\Sitemaps\HomepageSitemapResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(HomepageSitemapResource::class)
    ->toImplement(ConstantItemInterface::class);

arch('it has a getItem method')
    ->expect(HomepageSitemapResource::class)
    ->toHaveMethod('getItem');

test('getItem returns ok', function () {
    $actual = (new HomepageSitemapResource)->getItem();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->toMatchArray([
            'loc' => url('/'),
            'lastmod' => '2024-03-01',
            'changefreq' => 'weekly',
            'priority' => 0.8,
        ]);
});
