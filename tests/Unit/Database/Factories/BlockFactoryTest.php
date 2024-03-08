<?php

use App\Models\Block;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('makes navbar block models')
    ->expect(fn () => Block::factory()->make(['type' => 'stack']))
    ->type->toEqual('stack');
