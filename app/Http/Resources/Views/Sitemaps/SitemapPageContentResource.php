<?php

namespace App\Http\Resources\Views\Sitemaps;

use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;

class SitemapPageContentResource implements PageItemInterface
{
    /**
     * Get the content array for the given page's sitemap item.
     *
     * @return array<string, float|string>
     */
    public function getItem(Page $page): array
    {
        $updated_at = strtotime($page->updated_at);
        $lastmod = $updated_at ? date('Y-m-d', $updated_at) : strval(config('metadata.first_published_year')) . '-01-01';

        return [
            'loc' => $page->getUrl(),
            'lastmod' => $lastmod,
            'changefreq' => 'weekly',
            'priority' => 0.8,
        ];
    }
}
