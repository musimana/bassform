<?php

use App\Http\Resources\Views\Blocks\TabsBlockResource;
use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(TabsBlockResource::class)
    ->toImplement(PageItemInterface::class);

arch('it has a getItem method')
    ->expect(TabsBlockResource::class)
    ->toHaveMethod('getItem');

arch('it\'s in use in the App namespace')
    ->expect(TabsBlockResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function (Page $page) {
    $actual = (new TabsBlockResource)->getItem($page);

    expect($actual)
        ->toBeArray()
        ->toBeEmpty();
})->with('pages');
