<?php

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
        'slug' => 'about',
        'title' => 'About',
        'subtitle' => config('app.name'),
        'content' => '
        <section id="welcome" class="p-4">
            <p class="text-lg tracking-widest border-l-4 border-gray-900 dark:border-gray-300 p-2 bg-gray-200 dark:bg-gray-800"><em>"Suped-up Laravel Breeze with Vue, Inertia & Tailwind"</em></p>
            <p class="mt-8">
                Bassform is a light-weight template for scaffolding <a href="https://laravel.com/" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"><em>Laravel</em></a> apps,
                with Vue for the UI.
                It is based on and inspired by the VILT SSR flavour of <a href="https://github.com/laravel/breeze" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"><em>Laravel Breeze</em></a>.
            </p>
            <p>
                The template includes versions of Breeze\'s authentication, profile & dark mode features,
                plus additional common UI components, SEO enhancements and a test suite with near total code coverage.
            </p>
            <p>
                The template is open source and once a new project has been initiated from it,
                you\'re free to customise it however you wish.
            </p>
        </section>

        <hr class="my-8 border-gray-900 dark:border-gray-100" />
        ',
        'in_sitemap' => 1,
        'meta_title' => 'About',
        'meta_description' => config('metadata.description'),
        'meta_keywords' => config('metadata.keywords'),
        'template' => 'Public/PublicContent',
        'is_homepage' => 0,
    ],

    [
        'slug' => 'controls',
        'title' => 'Controls',
        'subtitle' => 'The UI control components that come with the template are demonstrated below.',
        'in_sitemap' => 1,
        'meta_title' => 'Controls',
        'meta_description' => 'Page demonstrating the UI control components that come with the template. Including accordions, buttons, dropdowns & modals.',
        'meta_keywords' => config('metadata.keywords'),
        'template' => 'Public/PublicContentControls',
        'is_homepage' => 0,
    ],

    [
        'slug' => 'forms',
        'title' => 'Forms',
        'subtitle' => 'The UI form & input components that come with the template are demonstrated below.',
        'in_sitemap' => 1,
        'meta_title' => 'Forms',
        'meta_description' => 'Page demonstrating the UI form & input components that come with the template. Including checkbox, text, select & file upload inputs.',
        'meta_keywords' => config('metadata.keywords'),
        'template' => 'Public/PublicContentForms',
        'is_homepage' => 0,
    ],

];
