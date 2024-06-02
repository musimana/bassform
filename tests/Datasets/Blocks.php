<?php

use App\Enums\Blocks\BlockType;
use App\Http\Resources\Formatters\LaravelVersionFormatterResource;
use App\Http\Resources\Formatters\PhpVersionFormatterResource;
use App\Models\Block;

$laravel_version = (new LaravelVersionFormatterResource)->getValue();
$php_version = (new PhpVersionFormatterResource)->getValue();

$stack_html = '<h3 class="w-full mb-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">Stack</h3><ul class="list-disc ml-8 mb-8">'
    . '<li><a href="https://vuejs.org/" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"><span style="display: inline-block;" class="font-mono w-48"><strong>V</strong>ue v3.x</span></a><em>Client-side framework</em></li>'
    . '<li><a href="https://inertiajs.com/" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"><span style="display: inline-block;" class="font-mono w-48"><strong>I</strong>nertia v1.x</span></a><em>Build tool</em></li>'
    . '<li><a href="https://laravel.com/" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"><span style="display: inline-block;" class="font-mono w-48"><strong>L</strong>aravel v' . $laravel_version . '</span></a><em>Server-side framework</em></li>'
    . '<li><a href="https://tailwindcss.com/docs" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"><span style="display: inline-block;" class="font-mono w-48"><strong>T</strong>ailwind v3.x</span></a><em>CSS framework</em></li>'
    . '</ul><p>Running on PHP v' . $php_version . '</p>';

$tabs = ['tabs' => ['Tab One', 'Tab Two'], 'tabContents' => ['<p>Tab one content.</p>', '<p>Tab two content.</p>']];
$tabs_json = json_encode($tabs) ?: '';

dataset('blocks', function () use ($stack_html, $tabs, $tabs_json) {
    return [
        'stack block' => [
            fn () => collect([Block::factory()->type(BlockType::STACK)->create()]),
            [['html' => $stack_html, 'type' => BlockType::STACK->value]],
        ],
        'stack blocks' => [
            fn () => collect([
                Block::factory()->type(BlockType::STACK)->create(),
                Block::factory()->type(BlockType::STACK)->create(),
            ]),
            [
                ['html' => $stack_html, 'type' => BlockType::STACK->value],
                ['html' => $stack_html, 'type' => BlockType::STACK->value],
            ],
        ],
        'tabs block' => [
            fn () => collect([Block::factory()->type(BlockType::TABS, $tabs_json)->create()]),
            [$tabs],
        ],
        'tabs blocks' => [
            fn () => collect([
                Block::factory()->type(BlockType::TABS, $tabs_json)->create(),
                Block::factory()->type(BlockType::TABS, $tabs_json)->create(),
            ]),
            [
                $tabs,
                $tabs,
            ],
        ],
        'all blocks' => [
            fn () => collect([
                Block::factory()->type(BlockType::STACK)->create(),
                Block::factory()->type(BlockType::TABS, $tabs_json)->create(),
            ]),
            [
                ['html' => $stack_html, 'type' => BlockType::STACK->value],
                $tabs,
            ],
        ],
    ];
});
