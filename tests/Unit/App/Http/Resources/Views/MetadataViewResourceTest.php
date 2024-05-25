<?php

use App\Http\Resources\Views\MetadataViewResource;
use App\Interfaces\Resources\Items\ArrayToItemInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(MetadataViewResource::class)
    ->toImplement(ArrayToItemInterface::class);

arch('it has a getItem method')
    ->expect(MetadataViewResource::class)
    ->toHaveMethod('getItem');

arch('it\'s in use in the App namespace')
    ->expect(MetadataViewResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function () {
    $actual = (new MetadataViewResource)->getItem([]);

    expect($actual['links'])
        ->toBeArray()
        ->toHaveCount(count(config('metadata.social_links', [])))
        ->toMatchArray(config('metadata.social_links'));

    expect($actual['navbarDesktop'])
        ->toBeArray()
        ->toBeEmpty();

    expect($actual['navbarMobile'])
        ->toBeArray()
        ->toBeEmpty();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(10)
        ->toMatchArray([
            'appName' => config('app.name'),
            'canLogin' => true,
            'canonical' => url('/'),
            'canRegister' => true,
            'copyright' => config('metadata.copyright'),
            'description' => config('metadata.description'),
            'links' => config('metadata.social_links'),
            'navbarDesktop' => [],
            'navbarMobile' => [],
            'title' => config('app.name'),
        ]);
});
