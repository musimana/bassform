<?php

use App\Enums\Blocks\BlockType;
use App\Http\Resources\Views\Public\Blocks\BlockDataResource;
use App\Interfaces\Resources\Formatters\ItemToJsonFormatterInterface;

arch('it implements the expected interface')
    ->expect(BlockDataResource::class)
    ->toImplement(ItemToJsonFormatterInterface::class);

test('getValue returns ok for all blocks', function (BlockType $block_type, ?array $data) {
    $expected = $data ? json_encode($data) : null;

    expect((new BlockDataResource($block_type, $data))->getValue())
        ->toEqual($expected);
})->with(
    'block-types'
)->with([
    'null' => [null],
    'empty array' => [[]],
    'tab block data' => [['tabs' => ['tab'], 'tabContents' => ['<p>Tab contents.</p>']]],
    'html data' => [['html' => '<h1>HTML</h1>']],
]);

test('getJsonValidated returns ok for all blocks', function (BlockType $block_type, ?array $data) {
    $expected = match ($block_type) {
        BlockType::HEADER_LOGO => $data['heading'] ?? false ? json_encode($data) : json_encode(['heading' => [], 'subheading' => []]),
        BlockType::WYSIWYG => $data['html'] ?? false ? json_encode($data) : json_encode(['html' => []]),
        BlockType::PANEL_LINKS, BlockType::TABS, BlockType::UNKNOWN => $data ? json_encode($data) : null,
        default => null,
    };

    expect((new BlockDataResource($block_type, $data))->getJsonValidated())
        ->toEqual($expected);
})->with(
    'block-types'
)->with([
    'null' => [null],
    'empty array' => [[]],
    'header block data' => [['heading' => 'Heading', 'subheading' => 'Sub-Heading']],
    'html data' => [['html' => '<h1>HTML</h1>']],
    'tab block data' => [['tabs' => ['tab'], 'tabContents' => ['<p>Tab contents.</p>']]],
]);
