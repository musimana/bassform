<?php

use App\Http\Resources\Views\Navbars\NavbarItemAboutResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(NavbarItemAboutResource::class)
    ->toImplement(ConstantItemInterface::class);

arch('it has a getItem method')
    ->expect(NavbarItemAboutResource::class)
    ->toHaveMethod('getItem');

arch('it\'s in use in the App namespace')
    ->expect(NavbarItemAboutResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok when the item isn\'t seeded', function () {
    $actual = (new NavbarItemAboutResource)->getItem();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toBeArray()
        ->toBeEmpty();
});

test('getItem returns ok when the item is seeded', function () {
    Page::factory()->aboutPage()->create();
    $actual = (new NavbarItemAboutResource)->getItem();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(2)
        ->toMatchArray([
            'title' => 'About',
            'url' => url('about'),
        ]);
});
