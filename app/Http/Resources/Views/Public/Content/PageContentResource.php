<?php

namespace App\Http\Resources\Views\Public\Content;

use App\Http\Resources\Views\Blocks\BlocksResource;
use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;

class PageContentResource implements PageItemInterface
{
    /**
     * Get the content array for the given page's full public resource.
     *
     * @return array<string, array<int, array<string, array<int, string>|string>>|string>
     */
    public function getItem(Page $page): array
    {
        return [
            'blocks' => (new BlocksResource)->getItems($page->blocks()),
            'bodytext' => $page->getContent(),
            'heading' => $page->getTitle(),
            'subheading' => $page->getSubtitle(),
        ];
    }
}
