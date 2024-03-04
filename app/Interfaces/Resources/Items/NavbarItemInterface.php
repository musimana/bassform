<?php

namespace App\Interfaces\Resources\Items;

use App\Models\NavbarItem;

interface NavbarItemInterface
{
    /**
     * Get an item resource array from the given navbar item.
     *
     * @return array<string, mixed>
     */
    public function getItem(NavbarItem $navbar_item): array;
}
