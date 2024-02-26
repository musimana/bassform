<?php

use App\Http\Resources\Views\Public\Formatters\CopyrightMessageResource;
use App\Interfaces\Resources\Formatters\ConstantStringFormatterInterface;

arch('it implements the expected interface')
    ->expect(CopyrightMessageResource::class)
    ->toImplement(ConstantStringFormatterInterface::class);

arch('it has a getValue method')
    ->expect(CopyrightMessageResource::class)
    ->toHaveMethod('getValue');

arch('it\'s in use in the App namespace')
    ->expect(CopyrightMessageResource::class)
    ->toBeUsedIn('App');

test('getValue returns ok', function () {
    $actual = (new CopyrightMessageResource)->getValue();

    expect($actual)
        ->toBeString()
        ->toEqual(config('metadata.copyright'));
});
