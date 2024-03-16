<?php

use App\Http\Resources\Views\Public\Summaries\PageSummaryResource;
use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(PageSummaryResource::class)
    ->toImplement(PageItemInterface::class);

test('getItem returns ok', function (Page $page) {
    $actual = (new PageSummaryResource)->getItem($page);

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(3)
        ->toMatchArray([
            'content' => $page->getMetaDescription(),
            'title' => $page->getTitle(),
            'url' => $page->getUrl(),
        ]);
})->with('pages');
