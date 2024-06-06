<?php

use App\Models\NavbarItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('makes navbar item models')
    ->expect(fn () => NavbarItem::factory()->make(['title' => 'Test Title', 'url' => 'http://example.com', 'display_order' => 3]))
    ->title->toEqual('Test Title')
    ->url->toEqual('http://example.com')
    ->display_order->toEqual(3);
