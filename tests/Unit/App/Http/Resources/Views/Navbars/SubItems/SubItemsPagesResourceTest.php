<?php

use App\Http\Resources\Views\Navbars\SubItems\SubItemsPagesResource;
use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(SubItemsPagesResource::class)
    ->toImplement(ConstantIndexInterface::class);

arch('it has a getItems method')
    ->expect(SubItemsPagesResource::class)
    ->toHaveMethod('getItems');

arch('it\'s in use in the App namespace')
    ->expect(SubItemsPagesResource::class)
    ->toBeUsedIn('App');

test('getItems returns ok', function (Page $page) {
    $actual = (new SubItemsPagesResource)->getItems($page);

    expect($actual)
        ->toBeArray()
        ->toHaveCount(1);

    expect($actual[0])
        ->toHaveCamelCaseKeys()
        ->toHaveCount(2)
        ->toMatchArray([
            'title' => $page->getTitle(),
            'url' => $page->getUrl(),
        ]);
})->with('pages')->todo('BASS-40 Needs NavbarItem modelling');
