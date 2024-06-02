<?php

namespace App\Http\Resources\Views\Admin\Pages;

use App\Http\Resources\Views\Admin\Blocks\AdminBlocksResource;
use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;

final class CreateEditPageResource implements PageItemInterface
{
    /**
     * Get the content array for the given page's full public resource.
     *
     * @return array<string, array<int, array<int|string, mixed>>|bool|int|string>
     */
    public function getItem(Page $page): array
    {
        return [
            'id' => $page->id,
            'blocks' => (new AdminBlocksResource)->getItems($page->blocks),
            'content' => $page->getContent(),
            'subtitle' => $page->getSubtitle(),
            'title' => $page->getTitle(),
            'metaTitle' => $page->getMetaTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'inSitemap' => $page->isInSitemap(),
        ];
    }
}
