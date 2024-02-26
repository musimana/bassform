<?php

use App\Http\Requests\Auth\ProfileDeleteRequest;
use App\Interfaces\Requests\RequestInterface;
use App\Models\User;

beforeEach(function () {
    $this->subject = $this->createFormRequest(
        ProfileDeleteRequest::class,
        ['user' => User::factory()->make()->toArray()]
    );
});

arch('it implements the expected interface')
    ->expect(ProfileDeleteRequest::class)
    ->toImplement(RequestInterface::class);

arch('it has a rules method')
    ->expect(ProfileDeleteRequest::class)
    ->toHaveMethod('rules');

arch('it\'s in use in the App namespace')
    ->expect(ProfileDeleteRequest::class)
    ->toBeUsedIn('App');

test('rules returns ok', function () {
    $actual = $this->subject->rules();

    $this->assertValidationRules([
        'password' => [
            'required',
            'string',
            'current_password',
        ],
    ], $actual);
});
