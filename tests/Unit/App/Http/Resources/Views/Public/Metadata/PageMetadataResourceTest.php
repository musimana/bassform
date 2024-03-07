<?php

use App\Http\Resources\Views\Public\Metadata\PageMetadataResource;
use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->page = Page::factory()->create([
        'slug' => 'test-page',
        'meta_description' => 'Test page example meta-description.',
        'meta_title' => 'Test Page',
    ]);
});

arch('it implements the expected interface')
    ->expect(PageMetadataResource::class)
    ->toImplement(PageItemInterface::class);

arch('it has a getItem method')
    ->expect(PageMetadataResource::class)
    ->toHaveMethod('getItem');

arch('it\'s in use in the App namespace')
    ->expect(PageMetadataResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function () {
    $actual = (new PageMetadataResource)->getItem($this->page);

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(3)
        ->toMatchArray([
            'canonical' => url($this->page->slug),
            'description' => $this->page->getMetaDescription(),
            'title' => $this->page->getMetaTitle(),
        ]);
});
