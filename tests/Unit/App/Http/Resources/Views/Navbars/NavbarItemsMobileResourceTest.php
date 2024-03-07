<?php

use App\Http\Resources\Views\Navbars\NavbarItemsMobileResource;
use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use App\Models\Navbar;
use App\Models\NavbarItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(NavbarItemsMobileResource::class)
    ->toImplement(ConstantIndexInterface::class);

arch('it has a getItems method')
    ->expect(NavbarItemsMobileResource::class)
    ->toHaveMethod('getItems');

arch('it\'s in use in the App namespace')
    ->expect(NavbarItemsMobileResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function () {
    $navbar = Navbar::factory()
        ->has(NavbarItem::factory(3), 'items')
        ->create();

    $actual = (new NavbarItemsMobileResource)->getItems();

    expect($actual)
        ->toBeArray()
        ->toHaveCount(3);

    foreach ($navbar->items as $index => $navbar_item) {
        expect($actual[$index])
            ->toHaveCamelCaseKeys()
            ->toHaveCount(2);

        expect($actual[$index]['title'])->toEqual($navbar_item->getTitle());
        expect($actual[$index]['url'])->toEqual($navbar_item->getUrl());
    }
});
