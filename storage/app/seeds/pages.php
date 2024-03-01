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
        <section id="welcome" class="px-4 py-4">
            <p class="text-lg pb-4">
                Welcome traveller! This is a template VILT SSR app by Musimana. Enjoy making something great!
            </p>
        </section>

        <hr class="mb-1 border-gray-900 dark:border-gray-100" />
        <hr class="mt-1 border-gray-900 dark:border-gray-100" />

        <section id="stack" class="px-4 pt-12">
            <h3 class="w-full pb-4 font-mono font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">++++ Stack ++++</h3>

            <p>
                Built with a
                <a
                    href="https://laravel.com/"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"
                >
                    <em>Laravel</em>
                </a>
                VILT stack.
            </p>
        </section>
        ',
        'in_sitemap' => 1,
        'meta_title' => 'About',
        'meta_description' => config('metadata.description'),
        'meta_keywords' => config('metadata.keywords'),
        'template' => 'Public/PublicContent',
        'is_homepage' => 0,
    ],

];
