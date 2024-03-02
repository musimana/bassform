<?php

namespace App\Http\Resources\Views\Navbars\SubItems;

use App\Http\Resources\Views\Public\Links\PageLinkResource;
use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use App\Models\Page;

class SubItemsPagesResource implements ConstantIndexInterface
{
    /**
     * Get the links for the navbar's pages item dropdown.
     *
     * @return array<int, array<string, string>>
     */
    public function getItems(): array
    {
        return Page::where('slug', '!=', 'about')
            ->where('slug', '!=', 'features')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn ($page) => (new PageLinkResource)->getItem($page))
            ->toArray();
    }
}
