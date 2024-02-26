<?php

use App\Http\Resources\Views\Auth\Metadata\EmailVerifyMetadataResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;

arch('it implements the expected interface')
    ->expect(EmailVerifyMetadataResource::class)
    ->toImplement(ConstantItemInterface::class);

arch('it has a getItem method')
    ->expect(EmailVerifyMetadataResource::class)
    ->toHaveMethod('getItem');

arch('it\'s in use in the App namespace')
    ->expect(EmailVerifyMetadataResource::class)
    ->toBeUsedIn('App');

test('getItem returns ok', function () {
    $actual = (new EmailVerifyMetadataResource)->getItem();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(5)
        ->toMatchArray([
            'canonical' => url('verify-email'),
            'description' => 'Verify the email address for your ' . config('app.name') . ' account.',
            'keywords' => '',
            'title' => 'Email Verification',
            'status' => null,
        ]);
});
