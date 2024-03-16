<?php

use App\Http\Resources\Views\Auth\Metadata\PasswordForgotMetadataResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;

arch('it implements the expected interface')
    ->expect(PasswordForgotMetadataResource::class)
    ->toImplement(ConstantItemInterface::class);

test('getItem returns ok', function () {
    $actual = (new PasswordForgotMetadataResource)->getItem();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(5)
        ->toMatchArray([
            'canonical' => url('forgot-password'),
            'description' => 'Request a password reset token for your ' . config('app.name') . ' account.',
            'keywords' => '',
            'title' => 'Forgot Password',
            'status' => null,
        ]);
});
