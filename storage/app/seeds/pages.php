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

$description_controls = 'Page demonstrating the UI control components that come with the template. Including accordions, buttons, dropdowns & modals.';
$description_forms = 'Page demonstrating the UI form & input components that come with the template. Including checkbox, text, select & file upload inputs.';

$seeds = [

    [
        'slug' => 'home',
        'title' => config('app.name'),
        'meta_title' => config('app.name'),
        'meta_description' => config('metadata.description'),
        'meta_keywords' => config('metadata.keywords'),
        'template' => WebpageTemplate::PUBLIC_INDEX->value,
        'in_sitemap' => 0,
        'is_homepage' => 1,
        'blocks' => [
            [
                'type' => BlockType::HEADER_LOGO->value,
                'data' => json_encode([
                    'heading' => config('app.name'),
                    'subheading' => config('metadata.description'),
                ])
            ],
            ['type' => BlockType::SECTION_DIVIDER->value],
            [
                'type' => BlockType::WYSIWYG->value,
                'data' => json_encode([
                    'html' => '
                        <p><strong>Welcome traveller</strong>, you can find demos of the app\'s features via the links below,
                            with more available from the dashboard when you login.</p>
                        <p>You can also see the code on the
                            <a
                                href="https://github.com/musimana/bassform"
                                target="_blank"
                                rel="noopener noreferrer"
                            ><i>Public Repo</i></a>.</p>
                    ',
                ]),
            ],
            ['type' => BlockType::SECTION_DIVIDER->value],
            [
                'type' => BlockType::PANEL_LINKS->value,
                'data' => json_encode([
                    'title' => 'Features',
                    'items' => [
                        [
                            'title' => 'Controls',
                            'content' => $description_controls,
                            'url' => url('controls'),
                        ],
                        [
                            'title' => 'Forms',
                            'content' => $description_forms,
                            'url' => url('forms'),
                        ],
                    ],
                ])
            ],
        ],
    ],

    [
        'slug' => 'about',
        'title' => 'About',
        'meta_title' => 'About',
        'meta_description' => config('metadata.description'),
        'template' => WebpageTemplate::PUBLIC_CONTENT->value,
        'blocks' => [
            [
                'type' => BlockType::WYSIWYG->value,
                'data' => json_encode([
                    'html' => '
                        <h2 class="text-page-title">ABOUT</h2>
                        <p class="text-page-subtitle">' . config('app.name') . '</p>
                        <blockquote>
                            <p>
                                <i>“Laravel Breeze variant with Vue, Inertia &amp; Tailwind”&nbsp;</i>
                            </p>
                        </blockquote>
                        <p>
                            Bassform is a light-weight template for scaffolding
                            <a href="https://laravel.com/" target="_blank" rel="noopener noreferrer"><i>Laravel</i></a> apps,
                            with Vue for the UI.
                            It is based on and inspired by the VILT SSR flavour of
                            <a href="https://github.com/laravel/breeze" target="_blank" rel="noopener noreferrer"><i>Laravel Breeze</i></a>.
                        </p>
                        <p>
                            The template includes versions of Breeze\'s authentication, profile & dark mode features,
                            plus additional common UI components, SEO enhancements and a test suite with near total code coverage.
                        </p>
                        <p>
                            The template is open source and once a new project has been initiated from it,
                            you\'re free to customise it however you wish.
                        </p>
                    ',
                ])
            ],
            ['type' => BlockType::SECTION_DIVIDER->value],
            ['type' => BlockType::STACK->value],
        ],
    ],

    [
        'slug' => 'controls',
        'title' => 'Controls',
        'meta_title' => 'Controls',
        'meta_description' => $description_controls,
        'template' => WebpageTemplate::PUBLIC_CONTENT_CONTROLS->value,
        'blocks' => [
            [
                'type' => BlockType::WYSIWYG->value,
                'data' => json_encode([
                    'html' => '
                        <h2 class="text-page-title">CONTROLS</h2>
                        <p class="text-page-subtitle">The UI control components that come with the template are demonstrated below</p>
                    ',
                ])
            ],
            ['type' => BlockType::SECTION_DIVIDER->value],
        ],
    ],

    [
        'slug' => 'forms',
        'title' => 'Forms',
        'meta_title' => 'Forms',
        'meta_description' => $description_forms,
        'template' => WebpageTemplate::PUBLIC_CONTENT_FORMS->value,
        'blocks' => [
            [
                'type' => BlockType::WYSIWYG->value,
                'data' => json_encode([
                    'html' => '
                        <h2 class="text-page-title">FORMS</h2>
                        <p class="text-page-subtitle">The UI form & input components that come with the template are demonstrated below</p>
                    ',
                ])
            ],
            ['type' => BlockType::SECTION_DIVIDER->value],
        ],
    ],

];
