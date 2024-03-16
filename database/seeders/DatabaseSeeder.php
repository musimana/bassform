<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /** Seed the application's database. */
    public function run(): void
    {
        $this->call(PageSeeder::class);
        $this->call(NavbarSeeder::class);
        $this->call(UserSeeder::class);
    }
}
