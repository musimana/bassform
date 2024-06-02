<?php

use App\Enums\Blocks\BlockType;
use App\Models\Page;

$tabs = ['tabs' => ['Tab One', 'Tab Two'], 'tabContents' => ['<p>Tab one content.</p>', '<p>Tab two content.</p>']];

dataset('page-ghosts', function () use ($tabs) {
    return [
        'new model' => [fn () => new Page],
        'minimum page record ghost' => [fn () => Page::factory()->make()],
        'full page record ghost' => [fn () => Page::factory()->dummy()->make()],
        'homepage ghost' => [fn () => Page::factory()->dummy()->homePage()->make()],
        'privacy page ghost' => [fn () => Page::factory()->dummy()->privacyPage()->make()],
        'full page with tabs block' => [
            fn () => Page::factory()->dummy()->hasBlocks(1, fn (array $attributes) => [
                ...$attributes,
                'parent_type' => Page::class,
                'type' => BlockType::TABS->value,
                'data' => json_encode($tabs),
            ])->make(),
        ],
        'full page with stack block' => [
            fn () => Page::factory()->dummy()->hasBlocks(1, fn (array $attributes) => [
                ...$attributes,
                'parent_type' => Page::class,
                'type' => BlockType::STACK->value,
            ])->make(),
        ],
        'full page with all blocks' => [
            fn () => Page::factory()->dummy()->hasBlocks(1, fn (array $attributes) => [
                ...$attributes,
                'parent_type' => Page::class,
                'type' => BlockType::TABS->value,
                'data' => json_encode($tabs),
            ])->hasBlocks(1, fn (array $attributes) => [
                ...$attributes,
                'parent_type' => Page::class,
                'type' => BlockType::STACK->value,
            ])->make(),
        ],
    ];
});
