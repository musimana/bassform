<?php

namespace App\Http\Resources\Views\Navbars;

use App\Interfaces\Resources\Items\NavbarItemInterface;
use App\Models\NavbarItem;

final class ItemLinksNavbarResource implements NavbarItemInterface
{
    /**
     * Get the content array for the given page's public link.
     *
     * @return array<string, null|string|array<string, null|string>>
     */
    public function getItem(NavbarItem $navbar_item): array
    {
        // * @return array{}|array{title: string, url: ?string}|array{title: string, url: ?string, subItems: array{title: string, url: ?string}}
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
                'subItems' => $sub_items,
            ]
            : [
                'title' => $title,
                'url' => $navbar_item->getUrl(),
            ];
    }
}
