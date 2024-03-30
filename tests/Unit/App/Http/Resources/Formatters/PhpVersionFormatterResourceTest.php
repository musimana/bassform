<?php

use App\Http\Resources\Formatters\PhpVersionFormatterResource;
use App\Interfaces\Resources\Formatters\ConstantStringFormatterInterface;

arch('it implements the expected interface')
    ->expect(PhpVersionFormatterResource::class)
    ->toImplement(ConstantStringFormatterInterface::class);

test('getValue returns ok with valid inputs', function () {
    $actual = (new PhpVersionFormatterResource())->getValue();

    expect($actual)
        ->toBeString()
        ->toEqual(substr(PHP_VERSION, 0, strrpos(PHP_VERSION, '.')) . '.x');
});
