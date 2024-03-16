<?php

use App\Http\Resources\Views\Navbars\DesktopNavbarResource;
use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use App\Models\Navbar;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(DesktopNavbarResource::class)
    ->toImplement(ConstantIndexInterface::class);

arch('it has a getItems method')
    ->expect(DesktopNavbarResource::class)
    ->toHaveMethod('getItems');

test('getItem returns ok', function (Navbar $navbar) {
    $actual = (new DesktopNavbarResource)->getItems();

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
