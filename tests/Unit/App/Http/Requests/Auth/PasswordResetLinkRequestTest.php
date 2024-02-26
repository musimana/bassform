<?php

use App\Http\Requests\Auth\PasswordResetLinkRequest;
use App\Interfaces\Requests\RequestInterface;
use App\Models\User;

beforeEach(function () {
    $this->subject = $this->createFormRequest(
        PasswordResetLinkRequest::class,
        ['user' => User::factory()->make()->toArray()]
    );
});

arch('it implements the expected interface')
    ->expect(PasswordResetLinkRequest::class)
    ->toImplement(RequestInterface::class);

arch('it has a rules method')
    ->expect(PasswordResetLinkRequest::class)
    ->toHaveMethod('rules');

arch('it\'s in use in the App namespace')
    ->expect(PasswordResetLinkRequest::class)
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
    ], $actual);
});
