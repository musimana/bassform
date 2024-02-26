<?php

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('makes page models')
    ->expect(fn () => Page::factory()->make(['title' => 'Test Title']))
    ->title->toEqual('Test Title');
