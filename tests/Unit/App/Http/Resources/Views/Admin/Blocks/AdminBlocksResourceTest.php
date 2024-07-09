<?php

use App\Enums\Blocks\BlockType;
use App\Http\Resources\Views\Admin\Blocks\AdminBlockResource;
use App\Http\Resources\Views\Admin\Blocks\AdminBlocksResource;
use App\Interfaces\Resources\Indexes\CollectionIndexInterface;
use App\Models\Block;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(AdminBlocksResource::class)
    ->toImplement(CollectionIndexInterface::class);

test('getCollection returns ok', function (Collection $blocks) {
    $actual = (new AdminBlocksResource($blocks))->getCollection();

    expect($actual)
        ->toEqual($blocks);
})->with('blocks');

test('getItems returns ok', function (Collection $blocks, array $expected) {
    $actual = (new AdminBlocksResource($blocks))->getItems();

    foreach ($actual as $block) {
        $block_formatted = $block;

        if (is_array($block['data'])) {
            $block_formatted['data'] = json_encode($block['data']);
        }

        $resource = (new AdminBlockResource(Block::factory()->make($block_formatted)))->getItem();

        expect($block)
            ->toBeArray()
            ->toMatchArray($resource);
    }

    expect($actual)
        ->toBeArray()
        ->toHaveCount(count($expected));
})->with('blocks');

test('setItems returns ok', function (Collection $blocks, array $expected) {
    $expected = array_map(
        fn ($block_array) => [
            'id' => false,
            'type' => $block_array['type'],
            'data' => $block_array['data'],
            'schema' => BlockType::from($block_array['type'])->schema(),
        ],
        $expected
    );

    $resource = new AdminBlocksResource;
    $resource->setItems($expected);

    $actual = $resource->getCollection();

    foreach ($actual as $index => $block) {
        $resource = (new AdminBlockResource($block))->getItem();

        expect($resource)
            ->toBeArray()
            ->type->toEqual($expected[$index]['type']);
    }

    expect($actual)
        ->toHaveCount(count($blocks));
})->with('blocks');
