<?php

namespace App\Http\Resources\Views\Sitemaps;

use App\Interfaces\Resources\Indexes\ConstantIndexInterface;

final class SitemapResource implements ConstantIndexInterface
{
    /**
     * Get the content array for the sitemaps index resource.
     *
     * @return array<int, string>
     */
    public function getItems(): array
    {
        return array_merge(
            [url('sitemaps/pages.xml')],
        );
    }
}
