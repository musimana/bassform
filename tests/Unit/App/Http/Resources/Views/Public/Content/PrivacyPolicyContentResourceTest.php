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
        ->toHaveCount(3)
        ->toMatchArray([
            [
                'type' => 'wysiwyg',
                'data' => [
                    'html' => '<h2 class="text-page-title">PRIVACY POLICY</h2>
                        <p class="text-page-subtitle">' . config('app.name') . '</p>',
                ],
            ],
            [
                'type' => 'section-divider',
                'data' => [],
            ],
            [
                'type' => 'privacy-policy',
                'data' => ['html' => view('partials.static-blocks.privacy')->render()],
            ],
        ]);

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(1);
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
        ->toHaveCount(1)
        ->toMatchArray([
            'blocks' => [],
        ]);
});
