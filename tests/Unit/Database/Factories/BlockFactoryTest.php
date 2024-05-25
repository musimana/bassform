<?php

use App\Enums\BlockType;
use App\Models\Block;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('makes all types of block models', function (BlockType $block_type) {
    $actual = Block::factory()->make(['type' => $block_type->value]);

    expect($actual['type'])
        ->toEqual($block_type->value);
})->with('block-types');
