<?php

use App\Enums\BlockType;
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

$tabs = [BlockType::TABS->value => ['Tab One', 'Tab Two']];

dataset('blocks', function () use ($stack_html, $tabs) {
    return [
        'stack block' => [
            fn () => collect([Block::factory()->create(['type' => BlockType::STACK->value])]),
            [['html' => $stack_html, 'type' => BlockType::STACK->value]],
        ],
        'stack blocks' => [
            fn () => collect([
                Block::factory()->create(['type' => BlockType::STACK->value]),
                Block::factory()->create(['type' => BlockType::STACK->value]),
            ]),
            [
                ['html' => $stack_html, 'type' => BlockType::STACK->value],
                ['html' => $stack_html, 'type' => BlockType::STACK->value],
            ],
        ],
        'tabs block' => [
            fn () => collect([
                Block::factory()->create([
                    'type' => BlockType::TABS->value,
                    'data' => json_encode($tabs),
                ]),
            ]),
            [$tabs],
        ],
        'tabs blocks' => [
            fn () => collect([
                Block::factory()->create([
                    'type' => BlockType::TABS->value,
                    'data' => json_encode($tabs),
                ]),
                Block::factory()->create([
                    'type' => BlockType::TABS->value,
                    'data' => json_encode($tabs),
                ]),
            ]),
            [
                $tabs,
                $tabs,
            ],
        ],
        'mixed blocks' => [
            fn () => collect([
                Block::factory()->create(['type' => BlockType::STACK->value]),
                Block::factory()->create([
                    'type' => BlockType::TABS->value,
                    'data' => json_encode($tabs),
                ]),
            ]),
            [
                ['html' => $stack_html, 'type' => BlockType::STACK->value],
                $tabs,
            ],
        ],
    ];
});
