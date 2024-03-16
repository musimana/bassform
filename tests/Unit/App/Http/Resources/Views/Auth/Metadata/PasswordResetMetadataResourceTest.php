<?php

use App\Http\Resources\Views\Auth\Metadata\PasswordResetMetadataResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use Illuminate\Http\Request;

arch('it implements the expected interface')
    ->expect(PasswordResetMetadataResource::class)
    ->toImplement(ConstantItemInterface::class);

test('getItem returns ok', function () {
    $actual = (new PasswordResetMetadataResource)->getItem(new Request);

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(6)
        ->toMatchArray([
            'canonical' => url('reset-password'),
            'description' => 'Reset your ' . config('app.name') . ' account password.',
            'keywords' => '',
            'email' => null,
            'title' => 'Reset Password',
            'token' => null,
        ]);
});
