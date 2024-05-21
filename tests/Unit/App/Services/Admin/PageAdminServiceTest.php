<?php

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

    expect($page->title)->toEqual($data['title']);
    expect($page->subtitle)->toEqual($page_original->subtitle);
    expect($page->content)->toEqual($page_original->content);
    expect($page->meta_title)->toEqual($page_original->meta_title);
    expect($page->meta_description)->toEqual($page_original->meta_description);
    expect($page->in_sitemap)->toEqual($page_original->in_sitemap);
    expect($page->blocks)->toEqual($page_original->blocks);
})->with('pages');

test('update returns correctly for maximum valid data', function (Page $page) {
    $page_original = $page;
    $data = [
        'title' => 'New Title',
        'subtitle' => 'New Subtitle',
        'content' => '<p>New content.</p>',
        'metaTitle' => 'New Meta-Title',
        'metaDescription' => 'New Meta-Description',
        'inSitemap' => !$page->in_sitemap,
    ];

    $actual = PageAdminService::update($page, collect($data));

    expect($actual)->toBeTrue();

    $page->refresh();

    expect($page->title)->toEqual($data['title']);
    expect($page->subtitle)->toEqual($data['subtitle']);
    expect($page->content)->toEqual($data['content']);
    expect($page->meta_title)->toEqual($data['metaTitle']);
    expect($page->meta_description)->toEqual($data['metaDescription']);
    expect($page->in_sitemap)->toEqual($data['inSitemap']);
    expect($page->blocks)->toEqual($page_original->blocks);
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
    expect($page->title)->toEqual($data['title']);
    expect($page->subtitle)->toEqual($page_original->subtitle);
    expect($page->content)->toEqual($page_original->content);
    expect($page->meta_title)->toEqual($page_original->meta_title);
    expect($page->meta_description)->toEqual($page_original->meta_description);
    expect($page->in_sitemap)->toEqual($page_original->in_sitemap);
    expect($page->blocks)->toEqual($page_original->blocks);
});
