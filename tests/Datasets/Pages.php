<?php

use App\Models\Page;
use Tests\Enums\ExampleBlock;

$pages_with_blocks = [...array_map(
    fn (ExampleBlock $block_type) => [
        'Page min with ' . $block_type->value . ' Block' => fn () => Page::factory()->hasBlocks(1, fn (array $attributes) => [
            ...$attributes,
            'parent_type' => Page::class,
            'type' => $block_type->value,
            'data' => $block_type->exampleDataJson(),
        ])->create(),
    ],
    ExampleBlock::cases()
)];

$pages_with_blocks['Page max, all Blocks'] = function () {
    $page = Page::factory()->dummy()->create();

    array_map(
        fn (ExampleBlock $block_type) => $block_type->exampleModel(Page::class, $page->id),
        ExampleBlock::cases()
    );

    return Page::with('blocks')->find($page->id);
};

dataset('pages', function () use ($pages_with_blocks) {
    return [
        'page min record' => [fn () => Page::factory()->create()],
        'page max random record' => [fn () => Page::factory()->dummy()->create()],
        'homepage' => [fn () => Page::factory()->homePage()->create()],
        'about page' => [fn () => Page::factory()->aboutPage()->create()],
        'privacy page' => [fn () => Page::factory()->privacyPage()->create()],
        ...$pages_with_blocks,
    ];
});
