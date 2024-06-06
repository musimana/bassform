<?php

namespace App\Http\Resources\Views\Public\Summaries;

use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;

final class PageSummaryResource implements PageItemInterface
{
    /**
     * Get the resource as an array.
     *
     * @return array{content: string, title: string, url: string}
     */
    public function getItem(Page $page): array
    {
        return [
            'content' => $page->getMetaDescription(),
            'title' => $page->getTitle(),
            'url' => $page->getUrl(),
        ];
    }
}
