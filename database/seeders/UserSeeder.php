<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        $primary_user = User::where([['email', config('mail.from.address')]])->first();

        if (!$primary_user) {
            User::factory()->isAdmin()->create([
                'name' => config('mail.from.name', 'admin'),
                'email' => config('mail.from.address', 'admin@example.com'),
            ]);
        }

        // User::factory(32)->create();
    }
}
