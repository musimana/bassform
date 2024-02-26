<?php

use App\Http\Resources\Views\Public\Links\PageLinkResource;
use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(PageLinkResource::class)
    ->toImplement(PageItemInterface::class);

arch('it has a getItem method')
    ->expect(PageLinkResource::class)
    ->toHaveMethod('getItem');

arch('it\'s in use in the App namespace')
    ->expect(PageLinkResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function (Page $page) {
    $actual = (new PageLinkResource)->getItem($page);

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(2)
        ->toMatchArray([
            'title' => $page->getTitle(),
            'url' => $page->getUrl(),
        ]);
})->with('pages');
