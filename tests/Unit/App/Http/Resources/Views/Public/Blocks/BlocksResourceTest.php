<?php

use App\Http\Resources\Views\Public\Blocks\BlockResource;
use App\Http\Resources\Views\Public\Blocks\BlocksResource;
use App\Interfaces\Resources\Indexes\CollectionIndexInterface;
use App\Models\Block;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(BlocksResource::class)
    ->toImplement(CollectionIndexInterface::class);

test('getItems returns ok', function (Collection $blocks, array $expected) {
    $actual = (new BlocksResource)->getItems($blocks);

    foreach ($actual as $block) {
        $block_formatted = $block;

        if (is_array($block['data'])) {
            $block_formatted['data'] = json_encode($block['data']);
        }

        $resource = (new BlockResource(Block::factory()->make($block_formatted)))->getItem();

        expect($block)
            ->toBeArray()
            ->toMatchArray($resource);
    }

    expect($actual)
        ->toBeArray()
        ->toHaveCount(count($expected));
})->with('blocks');
