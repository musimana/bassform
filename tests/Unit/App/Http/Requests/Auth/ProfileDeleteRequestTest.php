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
