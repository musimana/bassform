<?php

use Tests\Enums\ExampleBlock;

$blocks = fn () => [
    ...array_merge(...array_map(
        fn (ExampleBlock $block_type) => [
            $block_type->value . ' block' => [
                fn () => collect([
                    $block_type->exampleModel(),
                ]),
                [
                    $block_type->expectedData(),
                ],
            ],
        ],
        ExampleBlock::cases()
    )),
    ...array_merge(...array_map(
        fn (ExampleBlock $block_type) => [
            $block_type->value . ' blocks' => [
                fn () => collect([
                    $block_type->exampleModel(),
                    $block_type->exampleModel(),
                ]),
                [
                    $block_type->expectedData(),
                    $block_type->expectedData(),
                ],
            ],
        ],
        ExampleBlock::cases()
    )),
    'all blocks' => [
        fn () => collect(array_map(
            fn (ExampleBlock $block_type) => $block_type->exampleModel(),
            ExampleBlock::cases()
        )),
        array_map(
            fn (ExampleBlock $block_type) => $block_type->expectedData(),
            ExampleBlock::cases()
        ),
    ],
];

dataset('blocks', function () use ($blocks) {
    return $blocks();
});
