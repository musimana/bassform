<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('makes user models')
    ->expect(fn () => User::factory()->make(['email' => 'test@example.com']))
    ->email->toEqual('test@example.com');
