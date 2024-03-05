<?php

use App\Http\Resources\Views\Public\Content\PageContentResource;
use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;

arch('it implements the expected interface')
    ->expect(PageContentResource::class)
    ->toImplement(PageItemInterface::class);

arch('it has a getItem method')
    ->expect(PageContentResource::class)
    ->toHaveMethod('getItem');

arch('it\'s in use in the App namespace')
    ->expect(PageContentResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function () {
    $actual = (new PageContentResource)->getItem(new Page);

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(6)
        ->toMatchArray([
            'addendum' => '',
            'article' => null,
            'subtitle' => '',
            'bodytext' => '',
            'tabs' => [],
            'title' => '',
        ]);
});
