<?php

use App\Http\Resources\Views\Auth\Metadata\LoginMetadataResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;

arch('it implements the expected interface')
    ->expect(LoginMetadataResource::class)
    ->toImplement(ConstantItemInterface::class);

arch('it has a getItem method')
    ->expect(LoginMetadataResource::class)
    ->toHaveMethod('getItem');

arch('it\'s in use in the App namespace')
    ->expect(LoginMetadataResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function () {
    $actual = (new LoginMetadataResource)->getItem();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(6)
        ->toMatchArray([
            'canonical' => url('login'),
            'canResetPassword' => true,
            'description' => 'Login to your ' . config('app.name') . ' account to explore the solutions in more detail.',
            'keywords' => '',
            'title' => 'Login',
            'status' => null,
        ]);
});
