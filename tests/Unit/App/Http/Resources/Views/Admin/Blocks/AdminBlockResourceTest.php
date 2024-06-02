<?php

use App\Enums\Blocks\BlockType;
use App\Http\Resources\Views\Admin\Blocks\AdminBlockResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Block;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(AdminBlockResource::class)
    ->toImplement(ConstantItemInterface::class);

test('getItem returns ok for stored blocks', function (Collection $collection_blocks) {
    foreach ($collection_blocks as $block) {
        expect((new AdminBlockResource($block))->getItem())
            ->toHaveCamelCaseKeys()
            ->toHaveCount(4)
            ->type->toEqual($block->type)
            ->data->toEqual($block->getData())
            ->id->toEqual($block->id ?? false)
            ->schema->toEqual($block->getType()->schema());
    }
})->with('blocks');

test('getItem returns ok for ghost blocks', function (Collection $collection_blocks) {
    foreach ($collection_blocks as $block) {
        expect((new AdminBlockResource($block))->getItem())
            ->toHaveCamelCaseKeys()
            ->toHaveCount(4)
            ->type->toEqual($block->type)
            ->data->toEqual($block->getData())
            ->id->toEqual($block->id ?? false)
            ->schema->toEqual($block->getType()->schema());
    }
})->with('block-ghosts');

test('getItem returns ok for unknown block types', function () {
    $block = Block::factory()->create(['type' => 'fake-block-type']);

    expect((new AdminBlockResource($block))->getItem())
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->type->toEqual(BlockType::UNKNOWN->value)
        ->data->toEqual(BlockType::UNKNOWN->staticData())
        ->id->toEqual($block->id)
        ->schema->toEqual(BlockType::UNKNOWN->schema());
});
