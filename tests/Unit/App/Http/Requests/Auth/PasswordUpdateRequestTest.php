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

test('rules returns ok', function () {
    $actual = $this->subject->rules();

    $this->assertExactValidationRules([
        'current_password' => [
            'required',
            'string',
            'current_password',
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
