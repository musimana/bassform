<?php

use App\Http\Resources\Views\Auth\Metadata\PasswordConfirmMetadataResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;

arch('it implements the expected interface')
    ->expect(PasswordConfirmMetadataResource::class)
    ->toImplement(ConstantItemInterface::class);

test('getItem returns ok', function () {
    $actual = (new PasswordConfirmMetadataResource)->getItem();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->toMatchArray([
            'canonical' => url('confirm-password'),
            'description' => 'Confirm your password for ' . config('app.name') . ' to continue.',
            'keywords' => '',
            'title' => 'Confirm Password',
        ]);
});
