<?php

use App\Http\Resources\Views\Auth\Summaries\CreateEditSummaryResource;
use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(CreateEditSummaryResource::class)
    ->toImplement(PageItemInterface::class);

test('getItem returns ok', function (Page $page) {
    $actual = (new CreateEditSummaryResource)->getItem($page);

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(3)
        ->toMatchArray([
            'content' => $page->getMetaDescription(),
            'title' => $page->getTitle(),
            'url' => $page->getUrlEdit(),
        ]);
})->with('pages');
