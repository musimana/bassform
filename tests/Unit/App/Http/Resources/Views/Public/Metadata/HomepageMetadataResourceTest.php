<?php

use App\Http\Resources\Views\Public\Metadata\HomepageMetadataResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use Illuminate\Support\Facades\Vite;

arch('it implements the expected interface')
    ->expect(HomepageMetadataResource::class)
    ->toImplement(ConstantItemInterface::class);

test('getItem returns ok', function () {
    $actual = (new HomepageMetadataResource)->getItem();

    expect($actual)
        ->toHaveCamelCaseKeys()
        ->toHaveCount(1)
        ->toMatchArray([
            'openGraphImage' => Vite::asset(config('metadata.open_graph_image')),
        ]);
});
