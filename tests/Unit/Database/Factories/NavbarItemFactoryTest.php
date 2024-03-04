<?php

use App\Models\NavbarItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('makes navbar item models')
    ->expect(fn () => NavbarItem::factory()->make(['title' => 'Test Title']))
    ->title->toEqual('Test Title');
