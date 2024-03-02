<?php

namespace App\Http\Resources\Views\Navbars;

use App\Http\Resources\Views\Navbars\SubItems\SubItemsPagesResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Page;

class NavbarItemPagesResource implements ConstantItemInterface
{
    /**
     * Get the items for the main public navbar's archive item.
     *
     * @return array<string, array<int, array<string, string>>|string>
     */
    public function getItem(): array
    {
        $features_page = Page::where('slug', 'features')->first();

        return $features_page
            ? [
                'title' => $features_page->getTitle(),
                'url' => $features_page->getUrl(),
                'subItems' => (new SubItemsPagesResource)->getItems(),
            ]
            : [];
    }
}
