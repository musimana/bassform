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
     * @return array{
     *  blocks: array<int, array{
     *      type: string,
     *      data: array<string, array<int, string>|string>,
     *  }>,
     *  bodytext: string,
     *  heading: string,
     *  subheading: string,
     * }
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
