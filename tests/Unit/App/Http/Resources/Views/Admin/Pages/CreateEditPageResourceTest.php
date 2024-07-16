<?php

use App\Enums\Webpages\WebpageStatus;
use App\Http\Resources\Views\Admin\Blocks\AdminBlocksResource;
use App\Http\Resources\Views\Admin\Pages\CreateEditPageResource;
use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(CreateEditPageResource::class)
    ->toImplement(PageItemInterface::class);

test('getItem returns ok with stored models', function (Page $page) {
    $actual = (new CreateEditPageResource)->getItem($page);

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(7)
        ->toMatchArray([
            'id' => $page->id,
            'blocks' => (new AdminBlocksResource($page->blocks, $page))->getItems(),
            'title' => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'inSitemap' => $page->isInSitemap(),
            'slug' => $page->slug,
            'webpageStatusId' => fn () => WebpageStatus::tryFrom($page->webpage_status_id ?? 1)?->value
                ?? WebpageStatus::DRAFT->value,
        ]);
})->with('pages');

test('getItem returns ok with ghost models', function (Page $page) {
    $actual = (new CreateEditPageResource)->getItem($page);

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(7)
        ->toMatchArray([
            'id' => $page->id,
            'blocks' => (new AdminBlocksResource($page->blocks, $page))->getItems(),
            'title' => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'inSitemap' => $page->isInSitemap(),
            'slug' => $page->slug,
            'webpageStatusId' => fn () => WebpageStatus::tryFrom($page->webpage_status_id ?? 1)?->value
                ?? WebpageStatus::DRAFT->value,
        ]);
})->with('page-ghosts');
