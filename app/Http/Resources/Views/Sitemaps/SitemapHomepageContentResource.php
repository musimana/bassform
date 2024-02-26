<?php

namespace App\Http\Resources\Views\Sitemaps;

use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Page;

class SitemapHomepageContentResource implements ConstantItemInterface
{
    /**
     * Get the content array for the site homepage sitemap item.
     *
     * @return array<string, float|string>
     */
    public function getItem(): array
    {
        return [
            'loc' => route('home'),
            'lastmod' => date('Y-m-d', strtotime(Page::max('updated_at'))),
            'changefreq' => 'weekly',
            'priority' => 0.8,
        ];
    }
}
