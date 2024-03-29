<?php

namespace App\Http\Resources\Views\Sitemaps;

use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Page;

final class HomepageSitemapResource implements ConstantItemInterface
{
    /**
     * Get the content array for the site homepage sitemap item.
     *
     * @return array<string, float|string>
     */
    public function getItem(): array
    {
        $lastmod = strtotime(strval(Page::max('updated_at')));

        return [
            'loc' => route('home'),
            'lastmod' => $lastmod ? date('Y-m-d', $lastmod) : '2024-03-01',
            'changefreq' => 'weekly',
            'priority' => 0.8,
        ];
    }
}
