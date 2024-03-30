<?php

use App\Http\Resources\Views\Blocks\StackBlockResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;

arch('it implements the expected interface')
    ->expect(StackBlockResource::class)
    ->toImplement(ConstantItemInterface::class);

arch('it has a getItem method')
    ->expect(StackBlockResource::class)
    ->toHaveMethod('getItem');

test('getItem returns ok', function () {
    $actual = (new StackBlockResource)->getItem();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(1);

    expect($actual['html'])->toBeString();
});
