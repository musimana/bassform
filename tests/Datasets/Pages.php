<?php

use App\Enums\Blocks\BlockType;
use App\Models\Page;

$tabs = ['tabs' => ['Tab One', 'Tab Two'], 'tabContents' => ['<p>Tab one content.</p>', '<p>Tab two content.</p>']];

dataset('pages', function () use ($tabs) {
    return [
        'minimum page record' => [fn () => Page::factory()->create()],
        'full page record' => [fn () => Page::factory()->dummy()->create()],
        'homepage' => [fn () => Page::factory()->dummy()->homePage()->create()],
        'about page' => [fn () => Page::factory()->dummy()->aboutPage()->create()],
        'privacy page' => [fn () => Page::factory()->dummy()->privacyPage()->create()],
        'full page with tabs block' => [
            fn () => Page::factory()->dummy()->hasBlocks(1, fn (array $attributes) => [
                ...$attributes,
                'parent_type' => Page::class,
                'type' => BlockType::TABS->value,
                'data' => json_encode($tabs),
            ])->create(),
        ],
        'full page with stack block' => [
            fn () => Page::factory()->dummy()->hasBlocks(1, fn (array $attributes) => [
                ...$attributes,
                'parent_type' => Page::class,
                'type' => BlockType::STACK->value,
            ])->create(),
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
            ])->create(),
        ],
    ];
});
