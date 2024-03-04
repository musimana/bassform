<?php

namespace App\Http\Resources\Views\Navbars;

use App\Interfaces\Resources\Items\NavbarItemInterface;
use App\Models\NavbarItem;

class NavbarItemLinksResource implements NavbarItemInterface
{
    /**
     * Get the content array for the given page's public link.
     *
     * @return array<string, string|array<string, string>>
     */
    public function getItem(NavbarItem $navbar_item): array
    {
        $title = $navbar_item->getTitle();

        if (!$title) {
            return [];
        }

        $sub_items = array_filter(
            $navbar_item->children->map(fn ($subitem) => self::getItem($subitem))->toArray(),
            fn ($subitem) => $subitem !== []
        );

        return $sub_items
            ? [
                'title' => $title,
                'url' => $navbar_item->getUrl(),
                'subItems' => array_filter(
                    $navbar_item->children->map(fn ($subitem) => self::getItem($subitem))->toArray(),
                    fn ($subitem) => $subitem !== []
                ),
            ]
            : [
                'title' => $title,
                'url' => $navbar_item->getUrl(),
            ];
    }
}
