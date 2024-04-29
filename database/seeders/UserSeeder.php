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
            User::factory()->create([
                'is_admin' => 1,
                'name' => config('mail.from.name'),
                'email' => config('mail.from.address'),
            ]);
        }

        // User::factory(32)->create();
    }
}
