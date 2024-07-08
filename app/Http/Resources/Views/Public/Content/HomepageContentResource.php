<?php

namespace App\Http\Resources\Views\Public\Content;

use App\Http\Resources\Views\Public\Blocks\BlocksResource;
use App\Http\Resources\Views\Public\Summaries\PageSummaryResource;
use App\Enums\Webpages\WebpageTemplate;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Page;

final class HomepageContentResource implements ConstantItemInterface
{
    /**
     * Get the content array for the site's homepage.
     *
     * @return array{
     *  blocks: array<int, array{
     *      type: string,
     *      data: array<string, array<int, string>|string>,
     *  }>,
     *  bodytext: string,
     *  heading: string,
     *  items: array<int, array{content: string, title: string, url: string}>,
     *  subheading: string,
     * }
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

    /** Get the template for the resource. */
    public function getTemplate(): ?WebpageTemplate
    {
        return $this->page->getTemplate();
    }
}
