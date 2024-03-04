<?php

use App\Http\Resources\Views\Navbars\NavbarItemLinksResource;
use App\Interfaces\Resources\Items\NavbarItemInterface;
use App\Models\NavbarItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(NavbarItemLinksResource::class)
    ->toImplement(NavbarItemInterface::class);

arch('it has a getItem method')
    ->expect(NavbarItemLinksResource::class)
    ->toHaveMethod('getItem');

arch('it\'s in use in the App namespace')
    ->expect(NavbarItemLinksResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function (NavbarItem $navbar_item) {
    $actual = (new NavbarItemLinksResource)->getItem($navbar_item);
    $expected = [
        'title' => $navbar_item->getTitle(),
        'url' => $navbar_item->getUrl(),
    ];

    if ($navbar_item->children->count() === 3) {
        $expected['subItems'] = [];
    }

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(count($expected))
        ->toMatchArray($expected);
})->with('navbar-item-ghosts');