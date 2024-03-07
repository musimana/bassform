<?php

namespace App\Http\Resources\Views\Navbars;

use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use App\Models\Navbar;

class NavbarItemsMobileResource implements ConstantIndexInterface
{
    /**
     * Get the items for the main public navbar.
     *
     * @return array<int, array<string, string>>
     */
    public function getItems(): array
    {
        $navbar_items = Navbar::first()?->items ?? collect();
        $navbar_items = $navbar_items
            ->map(fn ($page) => (new NavbarItemLinksResource)->getItem($page))
            ->toArray();
        $navbar_items_filtered = [];

        foreach ($navbar_items as $navbar_item) {
            if ($navbar_item['url'] ?? false) {
                $navbar_items_filtered[] = [
                    'title' => $navbar_item['title'],
                    'url' => $navbar_item['url'],
                ];
            }

            if ($navbar_item['subItems'] ?? false) {
                /** @var array<int, array<string, string>> $navbar_items_filtered */
                $navbar_items_filtered = [
                    ...$navbar_items_filtered,
                    ...$navbar_item['subItems'],
                ];
            }
        }

        return $navbar_items_filtered;
    }
}
