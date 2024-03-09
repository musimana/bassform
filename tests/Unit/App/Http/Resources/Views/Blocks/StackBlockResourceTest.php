<?php

use App\Http\Resources\Views\Blocks\StackBlockResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;

arch('it implements the expected interface')
    ->expect(StackBlockResource::class)
    ->toImplement(ConstantItemInterface::class);

arch('it has a getItem method')
    ->expect(StackBlockResource::class)
    ->toHaveMethod('getItem');

arch('it\'s in use in the App namespace')
    ->expect(StackBlockResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function () {
    $actual = (new StackBlockResource)->getItem();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(1)
        ->toMatchArray([
            'html' => '<h3 class="w-full mb-4 font-semibold text-sm text-gray-950 dark:text-gray-100 uppercase tracking-widest">Stack</h3><ul class="list-disc ml-8 mb-8">'
                . '<li><a href="https://vuejs.org/" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"><span style="display: inline-block;" class="font-mono w-48"><strong>V</strong>ue v3.x</span></a><em>Client-side framework</em></li>'
                . '<li><a href="https://inertiajs.com/" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"><span style="display: inline-block;" class="font-mono w-48"><strong>I</strong>nertia v1.x</span></a><em>Build tool</em></li>'
                . '<li><a href="https://laravel.com/" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"><span style="display: inline-block;" class="font-mono w-48"><strong>L</strong>aravel v10.x</span></a><em>Server-side framework</em></li>'
                . '<li><a href="https://tailwindcss.com/docs" target="_blank" rel="noopener noreferrer" class="group inline-flex items-center hover:text-gray-900 dark:hover:text-gray-50 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-100"><span style="display: inline-block;" class="font-mono w-48"><strong>T</strong>ailwind v3.x</span></a><em>CSS framework</em></li>'
                . '</ul><p>For PHP v8.2.x</p>',
        ]);
});
