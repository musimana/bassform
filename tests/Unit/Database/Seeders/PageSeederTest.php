<?php

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('runs successfully', function () {
    expect(Page::count())->toBe(0);

    $this->artisan('db:seed', ['Database\Seeders\PageSeeder'])
        ->expectsOutputToContain('INFO  Seeding database.')
        ->expectsOutputToContain('Database\Seeders\PageSeeder')
        ->expectsOutputToContain('DONE')
        ->assertSuccessful();
});
