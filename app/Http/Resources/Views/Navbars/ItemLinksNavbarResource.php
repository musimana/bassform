<?php

namespace App\Http\Resources\Views\Navbars;

use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\NavbarItem;

final class ItemLinksNavbarResource implements ConstantItemInterface
{
    /** Instantiate the resource. */
    public function __construct(
        protected NavbarItem $navbar_item = new NavbarItem
    ) {}

    /**
     * Get the content array for the given page's public link.
     *
     * @return array{}|array{
     *  title: string,
     *  url: string|null,
     *  subItems: array<int, array{title: string, url: string}>
     * }
     */
    public function getItem(): array
    {
        $title = $this->navbar_item->getTitle();
        $url = $this->navbar_item->getUrl();

        if (!$title) {
            return [];
        }

        $sub_items = array_filter(
            $this->navbar_item->children->map(
                fn ($sub_item) => [
                    'title' => $sub_item->getTitle(),
                    'url' => $sub_item->getUrl(),
                ]
            )->toArray(),
            fn ($sub_item) => $sub_item['title'] && $sub_item['url']
        );

        return [
            'title' => $title,
            'url' => $url,
            'subItems' => $sub_items,
        ];
    }
}
