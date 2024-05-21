<?php

use App\Http\Requests\Auth\ProfileUpdateRequest;
use App\Interfaces\Requests\RequestInterface;
use App\Models\User;
use Illuminate\Validation\Rule;

beforeEach(function () {
    $this->subject = $this->createFormRequest(
        ProfileUpdateRequest::class,
        ['user' => User::factory()->make()->toArray()]
    );
});

arch('it implements the expected interface')
    ->expect(ProfileUpdateRequest::class)
    ->toImplement(RequestInterface::class);

test('rules returns ok', function () {
    $actual = $this->subject->rules();

    $this->assertExactValidationRules([
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
            Rule::unique(User::class)->ignore(0),
        ],
    ], $actual);
});
