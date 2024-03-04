<?php

use App\Models\NavbarItem;

dataset('navbar-item-ghosts', function () {
    return [
        'navbar item without children' => [fn () => NavbarItem::factory()->make()],
        'navbar item with child' => [
            fn () => NavbarItem::factory()
                ->has(NavbarItem::factory(), 'children')
                ->make(),
        ],
        'navbar item with children' => [
            fn () => NavbarItem::factory()
                ->has(NavbarItem::factory(2), 'children')
                ->make(),
        ],
    ];
});
