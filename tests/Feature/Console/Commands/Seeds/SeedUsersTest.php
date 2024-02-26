<?php

use App\Models\User;

/** @see App\Console\Commands\Seeds\SeedUsers */
it('runs successfully', function () {
    $user_count_initial = User::count();

    $this->artisan('seed:users')
        ->expectsOutputToContain('✓ COMPLETED')
        ->assertSuccessful();

    expect(User::count())->toBe($user_count_initial + 1);
});

/** @see App\Console\Commands\Seeds\SeedUsers */
it('runs successfully with an argument', function () {
    $user_count_initial = User::count();
    $user_count = 30;

    $this->artisan('seed:users ' . $user_count)
        ->expectsOutputToContain('✓ COMPLETED')
        ->assertSuccessful();

    expect(User::count())->toBe($user_count_initial + $user_count);
});

/** @see App\Console\Commands\Seeds\SeedUsers */
it('runs successfully with option verbose', function () {
    $user_count_initial = User::count();

    $this->artisan('seed:users', ['--verbose' => true])
        ->expectsOutputToContain('✓ COMPLETED')
        ->assertSuccessful();

    expect(User::count())->toBe($user_count_initial + 1);
});
