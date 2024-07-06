<?php

namespace App\Http\Resources\Views\Sitemaps;

use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use App\Models\Page;

final class PagesSitemapResource implements ConstantIndexInterface
{
    /**
     * Get the content array for the pages sitemap index resource.
     *
     * @return array<int, array{
     *  loc: string,
     *  lastmod: string,
     *  changefreq: string,
     *  priority: string
     * }>
     */
    public function getItems(): array
    {
        $static_pages = [];

        if (!Page::where([['is_homepage', true], ['in_sitemap', true]])->exists()) {
            $page = Page::factory()->homePage()->make(['updated_at' => Page::min('updated_at')]);
            $static_pages[] = (new PageSitemapResource($page, 'weekly', '1.0'))->getItem();
        }

        if (!Page::where([['slug', 'privacy'], ['in_sitemap', true]])->exists()) {
            $page = Page::factory()->privacyPage()->make(['updated_at' => Page::min('updated_at')]);
            $static_pages[] = (new PageSitemapResource($page, 'yearly', '0.1'))->getItem();
        }

        return array_merge(
            $static_pages,
            Page::query()
                ->inSitemap()
                ->get()
                ->map(fn ($page) => (new PageSitemapResource($page))->getItem())
                ->toArray(),
        );
    }
}
