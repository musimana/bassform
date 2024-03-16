<?php

use App\Http\Resources\Views\Navbars\MobileNavbarResource;
use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use App\Models\Navbar;
use App\Models\NavbarItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(MobileNavbarResource::class)
    ->toImplement(ConstantIndexInterface::class);

arch('it has a getItems method')
    ->expect(MobileNavbarResource::class)
    ->toHaveMethod('getItems');

test('getItem returns ok', function () {
    $navbar = Navbar::factory()
        ->has(NavbarItem::factory(3), 'items')
        ->create();

    $actual = (new MobileNavbarResource)->getItems();

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
