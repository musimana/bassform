<?php

use App\Models\Navbar;
use App\Models\NavbarItem;

dataset('navbars', function () {
    return [
        'no navbar records' => [fn () => Navbar::factory()->make()],
        'navbar without items' => [fn () => Navbar::factory()->create()],
        'navbar with simple item' => [
            fn () => Navbar::factory()
                ->has(NavbarItem::factory(), 'items')
                ->create(),
        ],
        'navbar with complex item' => [
            fn () => Navbar::factory()
                ->has(NavbarItem::factory()->has(NavbarItem::factory(2), 'children'), 'items')
                ->create(),
        ],
        'navbar with mixed items' => [
            fn () => Navbar::factory()
                ->has(NavbarItem::factory(2), 'items')
                ->has(NavbarItem::factory()->has(NavbarItem::factory(2), 'children'), 'items')
                ->create(),
        ],
    ];
});
