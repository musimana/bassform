<?php

namespace App\Interfaces\Resources\Items;

use App\Models\Page;

interface PageItemInterface
{
    /**
     * Get an item resource array from the given page.
     *
     * @return array<string, mixed>
     */
    public function getItem(Page $page): array;
}
