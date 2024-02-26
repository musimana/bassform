<?php

namespace App\Http\Resources\Views\Navbars;

use App\Interfaces\Resources\Indexes\ConstantIndexInterface;

class NavbarItemsResource implements ConstantIndexInterface
{
    /**
     * Get the items for the main public navbar.
     *
     * @return array<int, array<string, array<int, array<string, string>>|string>>
     */
    public function getItems(): array
    {
        return [
            (new NavbarItemAboutResource)->getItem(),
            (new NavbarItemPagesResource)->getItem(),
        ];
    }
}
