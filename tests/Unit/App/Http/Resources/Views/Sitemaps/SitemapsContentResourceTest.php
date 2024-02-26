<?php

use App\Http\Resources\Views\Sitemaps\SitemapsContentResource;
use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(SitemapsContentResource::class)
    ->toImplement(ConstantIndexInterface::class);

arch('it has a getItems method')
    ->expect(SitemapsContentResource::class)
    ->toHaveMethod('getItems');

arch('it\'s in use in the App namespace')
    ->expect(SitemapsContentResource::class)
    ->toBeUsedIn('App');

test('getItems returns ok', function () {
    $actual = (new SitemapsContentResource)->getItems();

    expect($actual)
        ->toBeArray()
        ->toHaveCount(1)
        ->toMatchArray([
            url('sitemaps/pages.xml'),
        ]);
});
