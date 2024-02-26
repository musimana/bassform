<?php

use App\Http\Resources\Views\Navbars\NavbarItemsResource;
use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use App\Models\Page;
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

test('getItem returns ok', function (Page $page) {
    $actual = (new NavbarItemsResource)->getItems();

    expect($actual)
        ->toBeArray()
        ->toHaveCount(2);

    expect($actual[0])
        ->toHaveCamelCaseKeys()
        ->toHaveCount(2)
        ->toMatchArray([
            'title' => 'About',
            'url' => Page::where('slug', 'about')->first()?->getUrl() ?? '#',
        ]);

    expect($actual[1]['subItems'])
        ->toBeArray()
        ->toHaveCount(1);

    expect($actual[1]['subItems'][0])
        ->toHaveCamelCaseKeys()
        ->toHaveCount(2)
        ->toMatchArray([
            'title' => $page->getTitle(),
            'url' => $page->getUrl(),
        ]);

    expect($actual[1])
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
})->with('pages');
