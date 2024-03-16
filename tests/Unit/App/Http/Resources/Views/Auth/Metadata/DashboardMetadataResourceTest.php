<?php

use App\Http\Resources\Views\Auth\Metadata\DashboardMetadataResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;

arch('it implements the expected interface')
    ->expect(DashboardMetadataResource::class)
    ->toImplement(ConstantItemInterface::class);

test('getItem returns ok', function () {
    $actual = (new DashboardMetadataResource)->getItem();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->toMatchArray([
            'canonical' => url('dashboard'),
            'description' => 'Account dashboard for your ' . config('app.name') . ' account.',
            'keywords' => '',
            'title' => 'Dashboard',
        ]);
});
