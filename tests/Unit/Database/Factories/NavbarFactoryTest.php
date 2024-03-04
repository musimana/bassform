<?php

use App\Models\Navbar;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('makes navbar models')
    ->expect(fn () => Navbar::factory()->make(['title' => 'Test Title']))
    ->title->toEqual('Test Title');
