<?php

use App\Http\Resources\Views\DetailsViewResource;
use App\Interfaces\Resources\Items\ArraysToItemInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(DetailsViewResource::class)
    ->toImplement(ArraysToItemInterface::class);

arch('it has a getItem method')
    ->expect(DetailsViewResource::class)
    ->toHaveMethod('getItem');

arch('it\'s in use in the App namespace')
    ->expect(DetailsViewResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function () {
    $actual = (new DetailsViewResource)->getItem([], []);

    expect($actual['content'])
        ->toBeArray()
        ->toBeEmpty();

    expect($actual['metadata']['links'])
        ->toBeArray()
        ->toHaveCount(count(config('metadata.social_links', [])))
        ->toMatchArray(config('metadata.social_links'));

    expect($actual['metadata']['navbarDesktop'])
        ->toBeArray()
        ->toBeEmpty();

    expect($actual['metadata']['navbarMobile'])
        ->toBeArray()
        ->toBeEmpty();

    expect($actual['metadata'])
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

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(2)
        ->toMatchArray([
            'content' => [],
            'metadata' => [
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
            ],
        ]);
});
