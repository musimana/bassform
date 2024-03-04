<?php

use App\Http\Resources\Models\NavbarModelResource;
use App\Interfaces\Resources\Readonlys\NavbarReadonlyInterface;
use App\Models\Navbar;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(NavbarModelResource::class)
    ->toImplement(NavbarReadonlyInterface::class);

arch('it has a getItem method')
    ->expect(NavbarModelResource::class)
    ->toHaveMethod('getItem');

test('getItem returns ok with valid inputs', function (Navbar $navbar) {
    expect(Navbar::count())->toBe(0);

    $actual = (new NavbarModelResource($navbar))->getItem();

    expect($actual)
        ->toBeInstanceOf(Navbar::class)
        ->id->toEqual($navbar->id)
        ->title->toEqual($navbar->title)
        ->created_at->toEqual(null)
        ->updated_at->toEqual(null)
        ->deleted_at->toEqual(null);

    expect(Navbar::count())->toBe(0);
})->with('navbar-ghosts');
