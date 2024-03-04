<?php

use App\Http\Resources\Views\Navbars\NavbarItemsResource;
use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use App\Models\Navbar;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(NavbarItemsResource::class)
    ->toImplement(ConstantIndexInterface::class);

arch('it has a getItems method')
    ->expect(NavbarItemsResource::class)
    ->toHaveMethod('getItems');

arch('it\'s in use in the App namespace')
    ->expect(NavbarItemsResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function (Navbar $navbar) {
    $actual = (new NavbarItemsResource)->getItems();

    expect($actual)
        ->toBeArray()
        ->toHaveCount($navbar->items->count());

    foreach ($navbar->items as $index => $navbar_item) {
        expect($actual[$index])
            ->toHaveCamelCaseKeys()
            ->toHaveCount($navbar_item->children->count() ? 3 : 2);

        expect($actual[$index]['title'])->toEqual($navbar_item->getTitle());
        expect($actual[$index]['url'])->toEqual($navbar_item->getUrl());
    }
})->with('navbars');
