<?php

namespace App\Http\Resources\Views\Navbars;

use App\Http\Resources\Views\Navbars\SubItems\SubItemsPagesResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;

class NavbarItemPagesResource implements ConstantItemInterface
{
    /**
     * Get the items for the main public navbar's archive item.
     *
     * @return array<string, array<int, array<string, string>>|string>
     */
    public function getItem(): array
    {
        return [
            'title' => 'Pages',
            'url' => route('page.show', 'about'),
            'subItems' => (new SubItemsPagesResource)->getItems(),
        ];
    }
}
