<?php

namespace App\Http\Resources\Views\Public\Content;

use App\Http\Resources\Views\Public\Blocks\BlocksResource;
use App\Http\Resources\Views\Public\Summaries\PageSummaryResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Page;

final class HomepageContentResource implements ConstantItemInterface
{
    /**
     * Get the content array for the site's homepage.
     *
     * @return array<string, array<int, array<string, string>>|string>
     */
    public function getItem(): array
    {
        $page = Page::query()->isHomepage()->first();
        $items = Page::query()->isNotHomepage()->whereNot('slug', 'about')->get();

        return [
            'blocks' => $page?->blocks ? (new BlocksResource)->getItems($page->blocks) : [],
            'bodytext' => $page?->getContent() ?? '',
            'heading' => $page?->getTitle() ?? config('app.name'),
            'items' => $items
                ->map(fn ($page) => (new PageSummaryResource)->getItem($page))
                ->toArray(),
            'subheading' => $page?->getSubtitle() ?? '',
        ];
    }
}
