<?php

use App\Models\User;
use App\Services\ReflectionService;

test('getClassName returns ok', function (string $class, string|false $expected) {
    /** @var class-string $class */
    $actual = ReflectionService::getClassName($class);

    expect($actual)->toEqual($expected);
})->with([
    [User::class, 'User'],
]);
