<?php

namespace App\Http\Resources\Views\Public\Content;

use App\Http\Resources\Views\Public\Blocks\BlocksResource;
use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;

final class PageContentResource implements PageItemInterface
{
    /**
     * Get the content array for the given page's full public resource.
     *
     * @return array<string, array<int, array<int|string, mixed>>|string>>|string>
     */
    public function getItem(Page $page): array
    {
        return [
            'blocks' => (new BlocksResource)->getItems($page->blocks),
            'bodytext' => $page->getContent(),
            'heading' => $page->getTitle(),
            'subheading' => $page->getSubtitle(),
        ];
    }
}
