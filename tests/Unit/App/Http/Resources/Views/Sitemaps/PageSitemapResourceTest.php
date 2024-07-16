<?php

use App\Http\Resources\Views\Sitemaps\PageSitemapResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->page = Page::factory()->create([
        'slug' => 'test-page',
    ]);
});

arch('it implements the expected interface')
    ->expect(PageSitemapResource::class)
    ->toImplement(ConstantItemInterface::class);

test('getItem returns ok', function () {
    $actual = (new PageSitemapResource($this->page))->getItem();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->toMatchArray([
            'loc' => url('test-page'),
            'lastmod' => now()->format('Y-m-d'),
            'changefreq' => 'monthly',
            'priority' => '0.7',
        ]);
});
