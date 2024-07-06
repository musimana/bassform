<?php

namespace App\Http\Resources\Views\Sitemaps;

use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Page;

final class PageSitemapResource implements ConstantItemInterface
{
    /** Instantiate the resource. */
    public function __construct(
        protected Page $page = new Page,
        protected string $changefreq = 'monthly',
        protected string $priority = '0.7'
    ) {}

    /**
     * Get the content array for the given page's sitemap item.
     *
     * @return array{
     *  loc: string,
     *  lastmod: string,
     *  changefreq: string,
     *  priority: string
     * }
     */
    public function getItem(): array
    {
        $updated_at = strtotime(strval($this->page->updated_at));
        $lastmod = $updated_at
            ? date('Y-m-d', $updated_at)
            : strval(config('metadata.first_published_year')) . '-01-01';

        return [
            'loc' => $this->page->getUrl(),
            'lastmod' => $lastmod,
            'changefreq' => $this->changefreq,
            'priority' => $this->priority,
        ];
    }
}
