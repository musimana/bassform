<?php

use App\Enums\Blocks\BlockType;
use App\Enums\Webpages\WebpageTemplate;

/*
|--------------------------------------------------------------------------
| Page Model Seeds
|--------------------------------------------------------------------------
|
| List of models with their data, that will be generated when the
| PageSeeder is run.
|
*/

$seeds = [

    [
        'slug' => 'home',
        'title' => config('app.name'),
        'subtitle' => config('metadata.description'),
        'content' => '
            <p class="font-semibold">
                <em>Welcome traveller, you can find demos of the app\'s features via the links below, with more available from the dashboard when you login.</em>
            </p>
        ',
        'meta_title' => config('app.name'),
        'meta_description' => config('metadata.description'),
        'meta_keywords' => config('metadata.keywords'),
        'template' => WebpageTemplate::PUBLIC_INDEX->value,
        'in_sitemap' => 0,
        'is_homepage' => 1,
    ],

    [
        'slug' => 'about',
        'title' => 'About',
        'subtitle' => config('app.name'),
        'content' => '
            <p class="text-lg text-gray-800 dark:text-gray-200 tracking-widest mb-8 border-l-4 border-gray-900 dark:border-gray-300 p-2 bg-gray-200 dark:bg-gray-800"><em>"Laravel Breeze variant with Vue, Inertia & Tailwind"</em></p>
            <p class="px-4 pb-4">
                Bassform is a light-weight template for scaffolding <a href="https://laravel.com/" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"><em>Laravel</em></a> apps,
                with Vue for the UI.
                It is based on and inspired by the VILT SSR flavour of <a href="https://github.com/laravel/breeze" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"><em>Laravel Breeze</em></a>.
            </p>
            <p class="px-4 pb-4">
                The template includes versions of Breeze\'s authentication, profile & dark mode features,
                plus additional common UI components, SEO enhancements and a test suite with near total code coverage.
            </p>
            <p class="px-4 pb-4">
                The template is open source and once a new project has been initiated from it,
                you\'re free to customise it however you wish.
            </p>
            <hr class="my-8 border-gray-900 dark:border-gray-100" />
        ',
        'meta_title' => 'About',
        'meta_description' => config('metadata.description'),
        'template' => WebpageTemplate::PUBLIC_CONTENT->value,
        'blocks' => [
            ['type' => BlockType::STACK->value],
        ],
    ],

    [
        'slug' => 'controls',
        'title' => 'Controls',
        'subtitle' => 'The UI control components that come with the template are demonstrated below.',
        'meta_title' => 'Controls',
        'meta_description' => 'Page demonstrating the UI control components that come with the template. Including accordions, buttons, dropdowns & modals.',
        'template' => WebpageTemplate::PUBLIC_CONTENT_CONTROLS->value,
        'blocks' => [
            [
                'type' => BlockType::TABS->value,
                'data' => json_encode(['tabs' => ['Pop-ups', 'Buttons']]),
            ],
        ],
    ],

    [
        'slug' => 'forms',
        'title' => 'Forms',
        'subtitle' => 'The UI form & input components that come with the template are demonstrated below.',
        'meta_title' => 'Forms',
        'meta_description' => 'Page demonstrating the UI form & input components that come with the template. Including checkbox, text, select & file upload inputs.',
        'template' => WebpageTemplate::PUBLIC_CONTENT_FORMS->value,
    ],

];
