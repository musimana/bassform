<?php

use App\Http\Resources\Views\Auth\Metadata\SessionMetadataResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;

arch('it implements the expected interface')
    ->expect(SessionMetadataResource::class)
    ->toImplement(ConstantItemInterface::class);

test('getItem returns ok', function () {
    $actual = (new SessionMetadataResource)->getItem();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(1)
        ->toMatchArray([
            'status' => null,
        ]);
});
