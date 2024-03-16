<?php

use App\Http\Resources\Views\Auth\Metadata\ProfileCreateMetadataResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;

arch('it implements the expected interface')
    ->expect(ProfileCreateMetadataResource::class)
    ->toImplement(ConstantItemInterface::class);

test('getItem returns ok', function () {
    $actual = (new ProfileCreateMetadataResource)->getItem();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(4)
        ->toMatchArray([
            'canonical' => url('register'),
            'description' => 'Register an account for ' . config('app.name') . ' to explore the solutions in more depth.',
            'keywords' => '',
            'title' => 'Register',
        ]);
});
