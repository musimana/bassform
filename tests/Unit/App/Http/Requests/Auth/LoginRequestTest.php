<?php

use App\Http\Requests\Auth\LoginRequest;
use App\Interfaces\Requests\RequestInterface;
use Illuminate\Validation\ValidationException;

beforeEach(function () {
    $this->subject = new LoginRequest;
});

arch('it implements the expected interface')
    ->expect(LoginRequest::class)
    ->toImplement(RequestInterface::class);

test('authorize returns ok', function () {
    $actual = $this->subject->authorize();

    $this->assertTrue($actual);
});

test('rules returns ok', function () {
    $actual = $this->subject->rules();

    $this->assertExactValidationRules([
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
        ],
        'password' => [
            'required',
            'string',
        ],
    ], $actual);
});

test('authenticate throws a validation error for empty requests', function () {
    $actual = fn () => $this->subject->authenticate();

    expect($actual)->toThrow(ValidationException::class);
});

test('ensureIsNotRateLimited throws a validation error for empty requests', function () {
    $actual = fn () => $this->subject->authenticate();

    expect($actual)->toThrow(ValidationException::class);
});

test('throttleKey returns ok')
    ->expect(fn () => $this->subject->throttleKey())
    ->toBeString();
