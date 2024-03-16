<?php

use App\Http\Resources\Views\Public\Formatters\CopyrightFormatterResource;
use App\Interfaces\Resources\Formatters\ConstantStringFormatterInterface;

arch('it implements the expected interface')
    ->expect(CopyrightFormatterResource::class)
    ->toImplement(ConstantStringFormatterInterface::class);

test('getValue returns ok', function () {
    $actual = (new CopyrightFormatterResource)->getValue();

    expect($actual)
        ->toBeString()
        ->toEqual(config('metadata.copyright'));
});
