<?php

use App\Http\Requests\Auth\LoginRequest;
use App\Interfaces\Requests\RequestInterface;

beforeEach(function () {
    $this->subject = new LoginRequest();
});

arch('it implements the expected interface')
    ->expect(LoginRequest::class)
    ->toImplement(RequestInterface::class);

arch('it has a rules method')
    ->expect(LoginRequest::class)
    ->toHaveMethod('rules');

arch('it\'s in use in the App namespace')
    ->expect(LoginRequest::class)
    ->toBeUsedIn('App');

test('authorize returns ok', function () {
    $actual = $this->subject->authorize();

    $this->assertTrue($actual);
});

test('rules returns ok', function () {
    $actual = $this->subject->rules();

    $this->assertValidationRules([
        'email' => [
            'required',
            'string',
            'email',
        ],
        'password' => [
            'required',
            'string',
        ],
    ], $actual);
});
