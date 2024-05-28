<?php

use App\Enums\Blocks\BlockType;
use App\Http\Resources\Views\Blocks\StackBlockResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;

arch('it implements the expected interface')
    ->expect(StackBlockResource::class)
    ->toImplement(ConstantItemInterface::class);

arch('it has a getItem method')
    ->expect(StackBlockResource::class)
    ->toHaveMethod('getItem');

test('getItem returns ok')
    ->expect(fn () => (new StackBlockResource)->getItem())
    ->toHaveCamelCaseKeys()
    ->toHaveCount(2)
    ->type->toEqual(BlockType::STACK->value)
    ->html->toBeString();
