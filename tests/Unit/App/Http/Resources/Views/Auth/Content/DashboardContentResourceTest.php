<?php

use App\Http\Resources\Views\Auth\Content\DashboardContentResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

arch('it implements the expected interface')
    ->expect(DashboardContentResource::class)
    ->toImplement(ConstantItemInterface::class);

test('getItem returns ok', function () {
    $actual = (new DashboardContentResource)->getItem();

    expect($actual['items'])
        ->toBeArray()
        ->toBeEmpty();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(1)
        ->toMatchArray([
            'items' => [],
        ]);
});
