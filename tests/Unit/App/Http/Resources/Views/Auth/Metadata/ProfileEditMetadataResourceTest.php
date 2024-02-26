<?php

use App\Http\Resources\Views\Auth\Metadata\ProfileEditMetadataResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use Illuminate\Http\Request;

arch('it implements the expected interface')
    ->expect(ProfileEditMetadataResource::class)
    ->toImplement(ConstantItemInterface::class);

arch('it has a getItem method')
    ->expect(ProfileEditMetadataResource::class)
    ->toHaveMethod('getItem');

arch('it\'s in use in the App namespace')
    ->expect(ProfileEditMetadataResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function () {
    $actual = (new ProfileEditMetadataResource)->getItem(new Request);

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
