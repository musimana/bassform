<?php

use App\Http\Resources\Views\Public\Content\HomepageContentResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(HomepageContentResource::class)
    ->toImplement(ConstantItemInterface::class);

arch('it has a getItem method')
    ->expect(HomepageContentResource::class)
    ->toHaveMethod('getItem');

arch('it\'s in use in the App namespace')
    ->expect(HomepageContentResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function () {
    $actual = (new HomepageContentResource)->getItem();

    expect($actual['items'])
        ->toBeArray()
        ->toBeEmpty();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->toMatchArray([
            'heading' => 'Getting Started',
            'subheading' => '',
            'bodytext' => '<p class="mb-8">Laravel VILT stack template app with server-side rendering (SSR), Larastan, Pest & Dusk test suites. Created by Musimana.</p><h3 class="font-semibold mt-12 mb-8 text-gray-700 dark:text-gray-300">Features</h3>',
            'items' => [],
        ]);
});
