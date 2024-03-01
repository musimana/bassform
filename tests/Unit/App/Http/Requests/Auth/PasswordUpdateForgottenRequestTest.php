<?php

use App\Http\Requests\Auth\PasswordUpdateForgottenRequest;
use App\Interfaces\Requests\RequestInterface;
use App\Models\User;

beforeEach(function () {
    $this->subject = $this->createFormRequest(
        PasswordUpdateForgottenRequest::class,
        ['user' => User::factory()->make()->toArray()]
    );
});

arch('it implements the expected interface')
    ->expect(PasswordUpdateForgottenRequest::class)
    ->toImplement(RequestInterface::class);

arch('it has a rules method')
    ->expect(PasswordUpdateForgottenRequest::class)
    ->toHaveMethod('rules');

arch('it\'s in use in the App namespace')
    ->expect(PasswordUpdateForgottenRequest::class)
    ->toBeUsedIn('App');

test('rules returns ok', function () {
    $actual = $this->subject->rules();

    $this->assertValidationRules([
        'email' => [
            'required',
            'string',
            'email',
            'max:255',
        ],
        'password' => [
            'required',
            'string',
            'min:14',
            'confirmed',
        ],
        'token' => [
            'required',
            'string',
        ],
    ], $actual);
});