<?php

use App\Models\Block;
use Illuminate\Foundation\Application;

$laravel_delimiter_position = strpos(Application::VERSION, '.');
$laravel_version = $laravel_delimiter_position
    ? substr(Application::VERSION, 0, $laravel_delimiter_position) . '.x'
    : Application::VERSION;

$stack_html = '<h3 class="w-full mb-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">Stack</h3><ul class="list-disc ml-8 mb-8">'
    . '<li><a href="https://vuejs.org/" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"><span style="display: inline-block;" class="font-mono w-48"><strong>V</strong>ue v3.x</span></a><em>Client-side framework</em></li>'
    . '<li><a href="https://inertiajs.com/" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"><span style="display: inline-block;" class="font-mono w-48"><strong>I</strong>nertia v1.x</span></a><em>Build tool</em></li>'
    . '<li><a href="https://laravel.com/" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"><span style="display: inline-block;" class="font-mono w-48"><strong>L</strong>aravel v' . $laravel_version . '</span></a><em>Server-side framework</em></li>'
    . '<li><a href="https://tailwindcss.com/docs" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"><span style="display: inline-block;" class="font-mono w-48"><strong>T</strong>ailwind v3.x</span></a><em>CSS framework</em></li>'
    . '</ul><p>For PHP v8.2.x</p>';

$tabs = ['tabs' => ['Tab One', 'Tab Two']];

dataset('blocks', function () use ($stack_html, $tabs) {
    return [
        'stack block' => [
            fn () => collect([Block::factory()->create(['type' => 'stack'])]),
            [['html' => $stack_html]],
        ],
        'stack blocks' => [
            fn () => collect([
                Block::factory()->create(['type' => 'stack']),
                Block::factory()->create(['type' => 'stack']),
            ]),
            [
                ['html' => $stack_html],
                ['html' => $stack_html],
            ],
        ],
        'tabs block' => [
            fn () => collect([
                Block::factory()->create([
                    'type' => 'tabs',
                    'data' => json_encode($tabs),
                ]),
            ]),
            [$tabs],
        ],
        'tabs blocks' => [
            fn () => collect([
                Block::factory()->create([
                    'type' => 'tabs',
                    'data' => json_encode($tabs),
                ]),
                Block::factory()->create([
                    'type' => 'tabs',
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
                Block::factory()->create(['type' => 'stack']),
                Block::factory()->create([
                    'type' => 'tabs',
                    'data' => json_encode($tabs),
                ]),
            ]),
            [
                ['html' => $stack_html],
                $tabs,
            ],
        ],
    ];
});
