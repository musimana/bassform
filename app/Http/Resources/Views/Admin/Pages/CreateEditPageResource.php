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
     * @return array{
     *  id: int|false,
     *  blocks: array<int, array{
     *      id: int|false,
     *      type: string,
     *      data: array<string, array<int, string>|string>,
     *      schema: array{label:string, inputs:array<int, bool|int|string>}
     *  }>,
     *  content: string,
     *  subtitle: string,
     *  title: string,
     *  metaTitle: string,
     *  metaDescription: string,
     *  inSitemap: bool,
     * }
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
