<?php

namespace App\Http\Resources\Views\Sitemaps;

use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use App\Models\Page;

class PagesSitemapResource implements ConstantIndexInterface
{
    /**
     * Get the content array for the pages sitemap index resource.
     *
     * @return array<int, array<string, int|string>>
     */
    public function getItems(): array
    {
        return array_merge(
            [
                (new HomepageSitemapResource)->getItem(),
            ],
            Page::query()
                ->inSitemap()
                ->get()
                ->map(fn ($page) => (new PageSitemapResource)->getItem($page))
                ->toArray(),
        );
    }
}
