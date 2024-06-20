<?php

use App\Http\Resources\Views\Navbars\ItemLinksNavbarResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\NavbarItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(ItemLinksNavbarResource::class)
    ->toImplement(ConstantItemInterface::class);

arch('it has a getItem method')
    ->expect(ItemLinksNavbarResource::class)
    ->toHaveMethod('getItem');

test('getItem returns ok', function (NavbarItem $navbar_item) {
    $actual = (new ItemLinksNavbarResource($navbar_item))->getItem();
    $expected = [
        'title' => $navbar_item->getTitle(),
        'url' => $navbar_item->getUrl(),
        'subItems' => $navbar_item->children->count()
            ? $navbar_item->children->map(fn ($sub_item) => ['title' => $sub_item->getTitle(), 'url' => $sub_item->getUrl()])->toArray()
            : [],
    ];

    expect($actual['subItems'] ?? false)
        ->toHaveCount(count($expected['subItems']))
        ->toEqual($expected['subItems']);

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(count($expected))
        ->toMatchArray($expected);
})->with('navbar-item-ghosts');
