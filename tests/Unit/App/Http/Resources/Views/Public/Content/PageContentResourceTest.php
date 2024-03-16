<?php

use App\Http\Resources\Views\Public\Content\PageContentResource;
use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;

arch('it implements the expected interface')
    ->expect(PageContentResource::class)
    ->toImplement(PageItemInterface::class);

test('getItem returns ok', function () {
    $actual = (new PageContentResource)->getItem(new Page);

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->toMatchArray([
            'blocks' => [],
            'bodytext' => null,
            'heading' => '',
            'subheading' => '',
        ]);
});
