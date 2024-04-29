<?php

use App\Http\Resources\Views\Admin\Pages\CreateEditPageResource;
use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(CreateEditPageResource::class)
    ->toImplement(PageItemInterface::class);

test('getItem returns ok')
    ->expect(fn () => (new CreateEditPageResource)->getItem(new Page))
    ->toHaveCamelCaseKeys()
    ->toHaveCount(6)
    ->toMatchArray([
        'blocks' => [],
        'subtitle' => '',
        'title' => '',
        'metaTitle' => '',
        'metaDescription' => '',
        'inSitemap' => '',
    ]);
