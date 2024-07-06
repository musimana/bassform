<?php

use App\Http\Resources\Views\Public\Content\PageContentResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;

arch('it implements the expected interface')
    ->expect(PageContentResource::class)
    ->toImplement(ConstantItemInterface::class);

test('getItem returns ok', function () {
    $actual = (new PageContentResource)->getItem();

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
