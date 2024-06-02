<?php

use App\Enums\Blocks\BlockType;
use App\Http\Resources\Views\Public\Blocks\BlockResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Block;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(BlockResource::class)
    ->toImplement(ConstantItemInterface::class);

test('getItem returns ok for stored blocks', function (Collection $collection_blocks) {
    foreach ($collection_blocks as $block) {
        expect((new BlockResource($block))->getItem())
            ->toHaveCamelCaseKeys()
            ->toHaveCount(2)
            ->type->toEqual($block->type)
            ->data->toEqual($block->getData());
    }
})->with('blocks');

test('getItem returns ok for ghost blocks', function (Collection $collection_blocks) {
    foreach ($collection_blocks as $block) {
        expect((new BlockResource($block))->getItem())
            ->toHaveCamelCaseKeys()
            ->toHaveCount(2)
            ->type->toEqual($block->type)
            ->data->toEqual($block->getData());
    }
})->with('block-ghosts');

test('getItem returns ok for unknown block types', function () {
    $block = Block::factory()->create(['type' => 'fake-block-type']);

    expect((new BlockResource($block))->getItem())
        ->toHaveCamelCaseKeys()
        ->toHaveCount(2)
        ->type->toEqual(BlockType::UNKNOWN->value)
        ->data->toEqual(BlockType::UNKNOWN->staticData());
});
