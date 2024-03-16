<?php

namespace App\Http\Resources\Views\Public\Metadata;

use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;

final class PageMetadataResource implements PageItemInterface
{
    /**
     * Get the public view metadata array for the given page.
     *
     * @return array<string, string>
     */
    public function getItem(Page $page): array
    {
        return [
            'canonical' => $page->getUrl(),
            'description' => $page->getMetaDescription(),
            'title' => $page->getMetaTitle(),
        ];
    }
}
