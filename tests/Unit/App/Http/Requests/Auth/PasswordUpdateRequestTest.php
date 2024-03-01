<?php

use App\Http\Requests\Auth\PasswordUpdateRequest;
use App\Interfaces\Requests\RequestInterface;
use App\Models\User;

beforeEach(function () {
    $this->subject = $this->createFormRequest(
        PasswordUpdateRequest::class,
        ['user' => User::factory()->make()->toArray()]
    );
});

arch('it implements the expected interface')
    ->expect(PasswordUpdateRequest::class)
    ->toImplement(RequestInterface::class);

arch('it has a rules method')
    ->expect(PasswordUpdateRequest::class)
    ->toHaveMethod('rules');

arch('it\'s in use in the App namespace')
    ->expect(PasswordUpdateRequest::class)
    ->toBeUsedIn('App');

test('rules returns ok', function () {
    $actual = $this->subject->rules();

    $this->assertValidationRules([
        'current_password' => [
            'required',
            'string',
            'current_password',
        ],
        'password' => [
            'required',
            'string',
            'min:14',
            'confirmed',
        ],
    ], $actual);
});