<?php

namespace App\Http\Resources\Views\Auth\Summaries;

use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;

final class CreateEditSummaryResource implements PageItemInterface
{
    /**
     * Get the resource as an array.
     *
     * @return array{content: string, title: string, url: string|false}
     */
    public function getItem(Page $page): array
    {
        return [
            'content' => $page->getMetaDescription(),
            'title' => $page->getTitle(),
            'url' => $page->getUrlAdminEdit(),
        ];
    }
}
