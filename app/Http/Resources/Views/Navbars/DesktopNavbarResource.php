<?php

namespace App\Http\Resources\Views\Navbars;

use App\Interfaces\Resources\Indexes\ConstantIndexInterface;
use App\Models\Navbar;

final class DesktopNavbarResource implements ConstantIndexInterface
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
     *  subItems: array<int, array{title: string, url: string}>
     * }>
     */
    public function getItems(): array
    {
        return array_filter(
            $this->navbar->items
                ->map(fn ($navbar_item) => (new ItemLinksNavbarResource($navbar_item))->getItem())
                ->toArray(),
            fn ($navbar_item) => $navbar_item !== []
        );
    }
}
