<?php

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

test('getItems returns ok', function (Collection $blocks, array $expected) {
    $actual = (new AdminBlocksResource)->getItems($blocks);

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
