<?php

namespace App\Http\Resources\Views\Public\Content;

use App\Http\Resources\Views\Public\Blocks\BlocksResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Page;

final class PageContentResource implements ConstantItemInterface
{
    /** Instantiate the resource. */
    public function __construct(
        protected Page $page = new Page
    ) {}

    /**
     * Get the full public item array for the resource's page.
     *
     * @return array{
     *  blocks: array<int, array{
     *      type: string,
     *      data: array<string, array<int, string>|string>,
     *  }>,
     * }
     */
    public function getItem(): array
    {
        return [
            'blocks' => (new BlocksResource)->getItems($this->page->blocks),
        ];
    }
}
