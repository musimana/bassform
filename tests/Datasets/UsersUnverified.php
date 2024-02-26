<?php

use App\Models\User;

dataset('users-unverified', function () {
    return ['generic user' => [fn () => User::factory()->unverified()->create()]];
});
