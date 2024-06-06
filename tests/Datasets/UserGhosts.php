<?php

use App\Models\User;

dataset('user-ghosts', function () {
    return [
        'generic user' => [fn () => User::factory()->make()],
        'admin user' => [fn () => User::factory()->isAdmin()->make()],
    ];
});
