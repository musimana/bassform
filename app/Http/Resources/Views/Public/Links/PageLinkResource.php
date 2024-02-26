<?php

namespace App\Http\Resources\Views\Public\Links;

use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;

class PageLinkResource implements PageItemInterface
{
    /**
     * Get the content array for the given page's public link.
     *
     * @return array<string, string>
     */
    public function getItem(Page $page): array
    {
        return [
            'title' => $page->getTitle(),
            'url' => $page->getUrl(),
        ];
    }
}
