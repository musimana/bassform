<?php

namespace App\Http\Resources\Views\Navbars;

use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use App\Models\Navbar;

class NavbarItemsResource implements ConstantIndexInterface
{
    /**
     * Get the items for the main public navbar.
     *
     * @return array<int, array<string, array<int, array<string, string>>|string>>
     */
    public function getItems(): array
    {
        $navbar_items = Navbar::first()?->items ?? collect();

        return $navbar_items
            ->map(fn ($page) => (new NavbarItemLinksResource)->getItem($page))
            ->toArray();
    }
}
