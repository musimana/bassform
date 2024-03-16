<?php

use App\Http\Resources\Views\Blocks\BlocksResource;
use App\Interfaces\Resources\Indexes\CollectionIndexInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(BlocksResource::class)
    ->toImplement(CollectionIndexInterface::class);

arch('it has a getItems method')
    ->expect(BlocksResource::class)
    ->toHaveMethod('getItems');

test('getItems returns ok', function (Collection $blocks, array $expected) {
    $actual = (new BlocksResource)->getItems($blocks);

    expect($actual)
        ->toBeArray()
        ->toHaveCount(count($expected))
        ->toMatchArray($expected);
})->with('blocks');
