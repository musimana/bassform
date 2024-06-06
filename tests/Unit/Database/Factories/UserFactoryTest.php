<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('makes user models')
    ->expect(fn () => User::factory()->make(['email' => 'test@example.com']))
    ->email->toEqual('test@example.com')
    ->email_verified_at->not->toBeNull()
    ->is_admin->toBeFalse()
    ->password->toBeString()
    ->remember_token->toBeString();

it('makes admin user models')
    ->expect(fn () => User::factory()->isAdmin()->make(['email' => 'test@example.com']))
    ->email->toEqual('test@example.com')
    ->is_admin->toBeTrue();

it('makes unverified user models')
    ->expect(fn () => User::factory()->unverified()->make(['email' => 'test@example.com']))
    ->email->toEqual('test@example.com')
    ->email_verified_at->toBeNull();

it('makes unverified admin user models')
    ->expect(fn () => User::factory()->unverified()->isAdmin()->make(['email' => 'test@example.com']))
    ->email->toEqual('test@example.com')
    ->email_verified_at->toBeNull()
    ->is_admin->toBeTrue();

it('makes admin unverified user models')
    ->expect(fn () => User::factory()->isAdmin()->unverified()->make(['email' => 'test@example.com']))
    ->email->toEqual('test@example.com')
    ->email_verified_at->toBeNull()
    ->is_admin->toBeTrue();
