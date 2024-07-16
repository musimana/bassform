<?php

use App\Http\Resources\Views\Public\Content\PrivacyPolicyContentResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(PrivacyPolicyContentResource::class)
    ->toImplement(ConstantItemInterface::class);

test('getItem returns ok without a Page Model', function () {
    $actual = (new PrivacyPolicyContentResource)->getItem();

    expect($actual['blocks'])
        ->toBeArray()
        ->toHaveCount(3);

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4);
});

test('getItem returns ok with a Page Model', function () {
    $page = Page::factory()->create([
        'title' => 'Privacy Policy',
        'slug' => 'privacy',
    ]);

    $actual = (new PrivacyPolicyContentResource($page))->getItem();

    expect($actual['blocks'])
        ->toBeArray()
        ->toBeEmpty();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->toMatchArray([
            'blocks' => [],
            'bodytext' => $page->content,
            'heading' => $page->title,
            'subheading' => $page->subtitle,
        ]);
});
