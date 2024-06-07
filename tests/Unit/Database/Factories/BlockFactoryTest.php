<?php

use App\Enums\Blocks\BlockType;
use App\Models\Block;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('makes user models')
    ->expect(fn () => Block::factory()->make(['display_order' => 3]))
    ->display_order->toEqual(3)
    ->parent_type->toBeString()
    ->parent_id->toBeInt();

it('makes all types of block models', function (BlockType $block_type) {
    $actual = Block::factory()->type($block_type)->make(['display_order' => 3]);

    expect($actual)
        ->not->toBeNull()
        ->type->toEqual($block_type->value)
        ->display_order->toEqual(3)
        ->parent_type->toBeString()
        ->parent_id->toBeInt();
})->with('block-types');
