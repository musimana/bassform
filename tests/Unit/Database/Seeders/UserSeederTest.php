<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('runs successfully', function () {
    expect(User::count())->toBe(0);

    $this->artisan('db:seed', ['Database\Seeders\UserSeeder'])
        ->expectsOutputToContain('INFO  Seeding database.')
        ->expectsOutputToContain('Database\Seeders\UserSeeder')
        ->expectsOutputToContain('DONE')
        ->assertSuccessful();

    expect(User::count())->toBe(1);
});
