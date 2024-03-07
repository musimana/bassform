<?php

namespace App\Http\Resources\Views\Blocks;

use App\Interfaces\Resources\Items\PageItemInterface;
use App\Models\Page;

class TabsBlockResource implements PageItemInterface
{
    /**
     * Get the tabs array for the given page.
     *
     * @return array<string, array<int, string>>
     */
    public function getItem(Page $page): array
    {
        return $page->slug === 'controls'
            ? ['tabs' => ['Pop-ups', 'Buttons']]
            : [];
    }
}
