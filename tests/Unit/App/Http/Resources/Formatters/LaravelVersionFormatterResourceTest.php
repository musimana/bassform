<?php

use App\Http\Resources\Formatters\LaravelVersionFormatterResource;
use App\Interfaces\Resources\Formatters\ConstantStringFormatterInterface;
use Illuminate\Foundation\Application;

arch('it implements the expected interface')
    ->expect(LaravelVersionFormatterResource::class)
    ->toImplement(ConstantStringFormatterInterface::class);

test('getValue returns ok with valid inputs', function () {
    $actual = (new LaravelVersionFormatterResource())->getValue();

    expect($actual)
        ->toBeString()
        ->toEqual(substr(Application::VERSION, 0, strpos(Application::VERSION, '.') ?: null) . '.x');
});
