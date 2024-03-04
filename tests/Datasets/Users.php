<?php

use App\Models\User;

dataset('users', function () {
    return ['generic user' => [fn () => User::factory()->create()]];
});
