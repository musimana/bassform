<?php

use App\Enums\Blocks\BlockType;
use App\Http\Resources\Views\Admin\Blocks\AdminBlocksResource;
use App\Models\Block;
use App\Models\Page;
use App\Services\Admin\BlockAdminService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;

uses(RefreshDatabase::class);

test('syncBlocks can create blocks with optional arg', function (Collection $blocks, array $expected, Page $page) {
    unset($expected);

    $blocks = $blocks->map(function (Block $block, int $index) use ($page) {
        $block->parent_type = Page::class;
        $block->parent_id = $page->id;
        $block->display_order = $page->blocks->count() + $index;

        return $block;
    });
    $blocks = $page->blocks->merge($blocks);

    $actual = BlockAdminService::syncBlocks($blocks, $page->blocks);

    $page->refresh();

    expect($actual)->toBeTrue();
    expect($page->blocks->count())->toEqual($blocks->count());
    expect((new AdminBlocksResource($page->blocks, $page))->getItems())
        ->toEqual((new AdminBlocksResource($blocks, $page))->getItems());
})->with(
    'block-ghosts'
)->with(
    'pages'
);

test('syncBlocks can update blocks with optional arg', function (Collection $blocks, array $expected, Page $page) {
    unset($expected);

    $blocks_count = $page->blocks->count();
    $blocks->map(function (Block $block, int $index) use ($page, $blocks_count) {
        $block->parent_type = Page::class;
        $block->parent_id = $page->id;
        $block->display_order = $blocks_count + $index;
        $block->save();
    });
    $page->fresh();

    $blocks_count = $page->blocks->count();
    $blocks = $page->blocks->map(function (Block $block, int $index) use ($blocks_count) {
        $block->data = match ($block->getType()) {
            BlockType::TABS => json_encode([
                'tabs' => [fake()->word(), fake()->word()],
                'tabContents' => ['<p>' . fake()->word() . '.</p>', '<p>' . fake()->word() . '.</p>'],
            ]) ?: null,
            default => null,
        };
        $block->display_order = $index === 0 ? $blocks_count - 1 : $index - 1;

        return $block;
    });

    $actual = BlockAdminService::syncBlocks($blocks, $page->blocks);

    $blocks = $blocks->sortBy('display_order');
    $page->fresh();

    expect($actual)->toBeTrue();
    expect($page->blocks->count())->toEqual($blocks->count());
    expect((new AdminBlocksResource($page->blocks, $page))->getItems())
        ->toEqual((new AdminBlocksResource($blocks, $page))->getItems());
})->with(
    'blocks'
)->with(
    'pages'
);

test('syncBlocks can delete blocks with optional arg', function (Collection $blocks, array $expected, Page $page) {
    unset($expected);

    $blocks_count = $page->blocks->count();
    $blocks->map(function (Block $block, int $index) use ($page, $blocks_count) {
        $block->parent_type = Page::class;
        $block->parent_id = $page->id;
        $block->display_order = $blocks_count + $index;
        $block->save();
    });
    $page->refresh();

    $blocks = $page->blocks->slice(1);

    $actual = BlockAdminService::syncBlocks($blocks, $page->blocks);
    $blocks = $blocks->sortBy('display_order');
    $page->refresh();

    expect($actual)->toBeTrue();
    expect($page->blocks->count())->toEqual($blocks->count());
})->with(
    'blocks'
)->with(
    'pages'
);

test('syncBlocks ignores unknown fields', function () {
    $block = Block::factory()->type(BlockType::STACK)->create();
    $block_original = $block;
    $data = [
        'unknownField' => 'invalid value',
    ];

    $actual = BlockAdminService::syncBlocks(collect([$block->fill($data)]));

    expect($actual)->toBeTrue();

    $block->refresh();

    /** @phpstan-ignore-next-line (Intentionally accessing undefined property as part of the test.) */
    expect($block)
        ->unknown_field->toBeNull()
        ->parent_type->toEqual($block_original->parent_type)
        ->parent_id->toEqual($block_original->parent_id)
        ->display_order->toEqual($block_original->display_order)
        ->type->toEqual($block_original->type);
});
