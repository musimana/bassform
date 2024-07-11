<?php

use App\Enums\Blocks\BlockType;
use App\Http\Resources\Views\Admin\Blocks\AdminBlocksResource;
use App\Models\Page;
use App\Services\Admin\PageAdminService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('update returns correctly for minimum valid data', function (Page $page) {
    $page_original = $page;
    $data = [
        'title' => $page->getTitle() . ' - UPDATED',
        'inSitemap' => $page_original->in_sitemap ? true : false,
    ];

    $actual = PageAdminService::update($page, collect($data));

    expect($actual)->toBeTrue();

    $page->refresh();

    expect($page)
        ->not->toBeNull()
        ->title->toEqual($data['title'])
        ->meta_description->toEqual($page_original->meta_description)
        ->in_sitemap->toEqual($page_original->in_sitemap)
        ->template->toEqual($page_original->template)
        ->blocks->toEqual($page_original->blocks);
})->with('pages');

test('update returns correctly for maximum valid data', function (Page $page) {
    $page_original = $page;

    $blocks_array = (new AdminBlocksResource($page->blocks, $page))->getItems();

    if ($blocks_array[0] ?? false) {
        $data_new = match (BlockType::tryFrom($blocks_array[0]['type'])) {
            BlockType::TABS => ['tabs' => [fake()->word(), fake()->word()], 'tabContents' => ['<p>' . fake()->word() . '.</p>', '<p>' . fake()->word() . '.</p>']],
            default => false,
        };

        $blocks_array[0]['data'] = $data_new ?: $blocks_array[0]['data'];
    }

    $data = [
        'title' => 'New Title',
        'metaDescription' => 'New Meta-Description',
        'inSitemap' => !$page->in_sitemap,
        'blocks' => $blocks_array,
    ];

    $actual = PageAdminService::update($page, collect($data));

    expect($actual)->toBeTrue();

    $page->fresh();

    expect($page)
        ->not->toBeNull()
        ->title->toEqual($data['title'])
        ->meta_description->toEqual($data['metaDescription'])
        ->in_sitemap->toEqual($data['inSitemap'])
        ->template->toEqual($page_original->template);
})->with('pages');

test('update ignores unknown fields', function () {
    $page = Page::factory()->create();
    $page_original = $page;
    $data = [
        'title' => $page->getTitle() . ' - UPDATED',
        'inSitemap' => $page_original->in_sitemap ? true : false,
        'unknownField' => 'invalid value',
    ];

    $actual = PageAdminService::update($page, collect($data));

    expect($actual)->toBeTrue();

    $page->refresh();

    /** @phpstan-ignore-next-line (Intentionally accessing undefined property as part of the test.) */
    expect($page->unknown_field)->toBeNull();

    expect($page)
        ->not->toBeNull()
        ->title->toEqual($data['title'])
        ->meta_description->toEqual($page_original->meta_description)
        ->in_sitemap->toEqual($page_original->in_sitemap)
        ->template->toEqual($page_original->template)
        ->blocks->toEqual($page_original->blocks);
});
