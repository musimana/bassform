<?php

use App\Http\Resources\Views\Navbars\NavbarItemPagesResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(NavbarItemPagesResource::class)
    ->toImplement(ConstantItemInterface::class);

arch('it has a getItem method')
    ->expect(NavbarItemPagesResource::class)
    ->toHaveMethod('getItem');

arch('it\'s in use in the App namespace')
    ->expect(NavbarItemPagesResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function (Page $page) {
    $actual = (new NavbarItemPagesResource)->getItem();

    expect($actual['subItems'])
        ->toBeArray()
        ->toHaveCount(1);

    expect($actual['subItems'][0])
        ->toHaveCamelCaseKeys()
        ->toHaveCount(2)
        ->toMatchArray([
            'title' => $page->getTitle(),
            'url' => $page->getUrl(),
        ]);

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(3)
        ->toMatchArray([
            'title' => 'Pages',
            'url' => url('about'),
            'subItems' => [
                [
                    'title' => $page->getTitle(),
                    'url' => $page->getUrl(),
                ],
            ],
        ]);
})->with('pages')->todo('BASS-40 Needs NavbarItem modelling');
