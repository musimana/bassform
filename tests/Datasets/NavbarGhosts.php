<?php

use App\Models\Navbar;
use App\Models\NavbarItem;

dataset('navbar-ghosts', function () {
    return [
        'navbar without items' => [fn () => Navbar::factory()->make()],
        'navbar with simple item' => [
            fn () => Navbar::factory()
                ->has(NavbarItem::factory(), 'items')
                ->make(),
        ],
        'navbar with complex item' => [
            fn () => Navbar::factory()
                ->has(NavbarItem::factory()->has(NavbarItem::factory(2), 'children'), 'items')
                ->make(),
        ],
        'navbar with mixed items' => [
            fn () => Navbar::factory()
                ->has(NavbarItem::factory(2), 'items')
                ->has(NavbarItem::factory()->has(NavbarItem::factory(2), 'children'), 'items')
                ->make(),
        ],
    ];
});
