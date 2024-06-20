<?php

namespace App\Http\Resources\Views\Navbars;

use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use App\Models\Navbar;

final class MobileNavbarResource implements ConstantIndexInterface
{
    /** Instantiate the resource. */
    public function __construct(
        protected Navbar $navbar = new Navbar
    ) {}

    /**
     * Get the items for the main public navbar.
     *
     * @return array<int, array{
     *  title: string,
     *  url: string,
     * }>
     */
    public function getItems(): array
    {
        $navbar_items = $this->navbar->items
            ->map(fn ($navbar_item) => (new ItemLinksNavbarResource($navbar_item))->getItem())
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
                $navbar_items_filtered = [
                    ...$navbar_items_filtered,
                    ...$navbar_item['subItems'],
                ];
            }
        }

        return $navbar_items_filtered;
    }
}
