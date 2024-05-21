<?php

use App\Http\Requests\Auth\ProfileStoreRequest;
use App\Interfaces\Requests\RequestInterface;
use App\Models\User;

beforeEach(function () {
    $this->subject = $this->createFormRequest(
        ProfileStoreRequest::class,
        ['user' => User::factory()->make()->toArray()]
    );
});

arch('it implements the expected interface')
    ->expect(ProfileStoreRequest::class)
    ->toImplement(RequestInterface::class);

test('rules returns ok', function () {
    $actual = $this->subject->rules();

    $this->assertValidationRules([
        'name' => [
            'required',
            'string',
            'max:255',
        ],
        'email' => [
            'required',
            'string',
            'lowercase',
            'email',
            'max:255',
            'unique:App\Models\User',
        ],
        'password' => [
            'required',
            'string',
            'min:14',
            'max:255',
            'confirmed',
        ],
    ], $actual);
});
