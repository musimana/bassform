<?php

use App\Http\Resources\Views\Auth\Metadata\EmailVerifyMetadataResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;

arch('it implements the expected interface')
    ->expect(EmailVerifyMetadataResource::class)
    ->toImplement(ConstantItemInterface::class);

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
