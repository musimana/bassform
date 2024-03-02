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

    expect($actual['navbarItems'])
        ->toBeArray()
        ->toHaveCount(2);

    expect($actual['navbarItems'][0])
        ->toHaveCamelCaseKeys()
        ->toHaveCount(2)
        ->toMatchArray([
            'title' => 'About',
            'url' => '#',
        ]);

    expect($actual['navbarItems'][1]['subItems'])
        ->toBeArray()
        ->toBeEmpty();

    expect($actual['navbarItems'][1])
        ->toHaveCamelCaseKeys()
        ->toHaveCount(3)
        ->toMatchArray([
            'title' => 'Pages',
            'url' => url('about'),
            'subItems' => [],
        ]);

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(9)
        ->toMatchArray([
            'appName' => config('app.name'),
            'canLogin' => true,
            'canonical' => url('/'),
            'canRegister' => true,
            'copyright' => config('metadata.copyright'),
            'description' => config('metadata.description'),
            'links' => [
                'github' => config('metadata.social_links.github'),
            ],
            'navbarItems' => [
                ['title' => 'About', 'url' => '#'],
                [
                    'title' => 'Pages',
                    'url' => url('about'),
                    'subItems' => [],
                ],
            ],
            'title' => config('app.name'),
        ]);
})->todo('BASS-40 Needs NavbarItem modelling');
