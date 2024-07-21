<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

final class UserSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        $primary_user = User::where([['email', config('contacts.owner.address')]])->first();

        if (!$primary_user) {
            User::factory()->isAdmin()->create([
                'name' => config('contacts.owner.name'),
                'email' => config('contacts.owner.address'),
            ]);
        }

        // User::factory(32)->create();
    }
}
