<?php

use App\Models\Navbar;
use App\Models\NavbarItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('runs successfully', function () {
    expect(Navbar::count())->toBe(0);

    $this->artisan('db:seed', ['Database\Seeders\NavbarSeeder'])
        ->expectsOutputToContain('INFO  Seeding database.')
        ->expectsOutputToContain('Database\Seeders\NavbarSeeder')
        ->expectsOutputToContain('DONE')
        ->assertSuccessful();

    expect(Navbar::count())->toBe(1);
    expect(NavbarItem::count())->toBe(4);
});
