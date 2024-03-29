<?php

use App\Http\Resources\Views\Auth\Metadata\ProfileEditMetadataResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;

arch('it implements the expected interface')
    ->expect(ProfileEditMetadataResource::class)
    ->toImplement(ConstantItemInterface::class);

test('getItem returns ok', function () {
    $actual = (new ProfileEditMetadataResource)->getItem();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(6)
        ->toMatchArray([
            'canonical' => url('profile'),
            'description' => 'Review and update your ' . config('app.name') . ' account.',
            'keywords' => '',
            'mustVerifyEmail' => false,
            'title' => 'Profile',
            'status' => null,
        ]);
});
