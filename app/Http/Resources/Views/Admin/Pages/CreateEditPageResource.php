<?php

namespace App\Http\Resources\Views\Admin\Pages;

use App\Http\Resources\Views\Blocks\BlocksResource;
use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;

final class CreateEditPageResource implements PageItemInterface
{
    /**
     * Get the content array for the given page's full public resource.
     *
     * @return array<string, array<int, array<int|string, mixed>>|bool|string>
     */
    public function getItem(Page $page): array
    {
        return [
            'blocks' => (new BlocksResource)->getItems($page->blocks),
            'content' => $page->getContent(),
            'subtitle' => $page->getSubtitle(),
            'title' => $page->getTitle(),
            'metaTitle' => $page->getMetaTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'inSitemap' => Page::where('id', $page->id)->inSitemap()->exists(),
        ];
    }
}
