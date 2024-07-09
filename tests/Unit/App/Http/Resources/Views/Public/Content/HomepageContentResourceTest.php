<?php

use App\Enums\Webpages\WebpageTemplate;
use App\Http\Resources\Views\Public\Content\HomepageContentResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(HomepageContentResource::class)
    ->toImplement(ConstantItemInterface::class);

test('getItem returns ok without a Page Model', function () {
    $actual = (new HomepageContentResource)->getItem();

    expect($actual['blocks'])
        ->toBeArray()
        ->toBeEmpty();

    expect($actual['items'])
        ->toBeArray()
        ->toBeEmpty();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(5)
        ->toMatchArray([
            'blocks' => [],
            'bodytext' => '',
            'heading' => config('app.name'),
            'items' => [],
            'subheading' => '',
        ]);
});

test('getItem returns ok with a Page Model', function () {
    $page = Page::factory()->create([
        'title' => 'Home',
        'slug' => 'home',
        'is_homepage' => 1,
    ]);

    $actual = (new HomepageContentResource)->getItem();

    expect($actual['blocks'])
        ->toBeArray()
        ->toBeEmpty();

    expect($actual['items'])
        ->toBeArray()
        ->toBeEmpty();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(5)
        ->toMatchArray([
            'blocks' => [],
            'bodytext' => $page->content,
            'heading' => $page->title,
            'items' => [],
            'subheading' => $page->subtitle,
        ]);
});

test('getTemplate returns a WebpageTemplate', function () {
    $actual = (new HomepageContentResource)->getTemplate();

    expect($actual?->value)
        ->toEqual('Public/PublicContent');
});

it('initialises with setDefaultModel ok', function () {
    $actual = new HomepageContentResource;

    expect($actual->getTemplate()?->value)
        ->toEqual(WebpageTemplate::PUBLIC_INDEX->value);

    expect($actual->getItem()['blocks'])
        ->toHaveCamelCaseKeys()
        ->toHaveCount(1)
        ->toMatchArray([
            [
                'type' => 'header-logo',
                'data' => [
                    'heading' => 'Bassform - VILT SSR',
                    'subheading' => 'Laravel VILT stack template app with server-side rendering (SSR), Larastan, Pest & Dusk test suites. Created by Musimana.',
                ],
            ],
        ]);
});
