<?php

use App\Models\User;
use App\Services\LogoutService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('logout logs the authenticated user out', function (User $user) {
    $this->actingAs($user)->get(route('home'));
    $this->assertAuthenticated();

    LogoutService::logout();

    $this->assertGuest();
})->with('users');
