<?php

use App\Models\User;

dataset('users', function () {
    return [
        'generic user' => [fn () => User::factory()->create()],
        'admin user' => [fn () => User::factory()->isAdmin()->create()],
    ];
});
