<?php

use App\Http\Resources\Views\Blocks\BlocksResource;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it has a getItems method')
    ->expect(BlocksResource::class)
    ->toHaveMethod('getItems');

arch('it\'s in use in the App namespace')
    ->expect(BlocksResource::class)
    ->toBeUsedIn('App');

test('getItems returns ok', function (array $blocks, array $expected) {
    $actual = (new BlocksResource)->getItems($blocks);

    expect($actual)
        ->toBeArray()
        ->toHaveCount(count($expected))
        ->toMatchArray($expected);
})->with('blocks');