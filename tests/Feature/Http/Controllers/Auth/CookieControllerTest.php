<?php

use App\Http\Controllers\Auth\CookieController;
use App\Http\Controllers\Controller;

arch('it extends the expected abstract controller')
    ->expect(CookieController::class)
    ->toExtend(Controller::class);

test('store returns correctly for valid data', function (bool $remember) {
    $route_from = route('home');
    $route_to = route('cookies.store');
    expect(session()->has('cookies.acknowledged'))->toBeFalse();

    $actual = $this
        ->from($route_from)
        ->post($route_to, [
            'remember' => $remember,
        ]);

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect($route_from);

    expect(session('cookies.acknowledged'))->toBeTrue();
})->with([
    'remember true' => true,
    'remember false' => false,
]);

test('store throws a validation errors for invalid data', function (array $payload, string $expected) {
    $route_from = route('home');
    $route_to = route('cookies.store');
    expect(session()->has('cookies.acknowledged'))->toBeFalse();

    $actual = $this
        ->from($route_from)
        ->post($route_to, $payload);

    $actual
        ->assertSessionHasErrors(['remember' => $expected])
        ->assertRedirect($route_from);

    expect(session()->has('cookies.acknowledged'))->toBeFalse();
})->with([
    'remember missing' => [['not_remember' => true], 'The remember field is required.'],
    'remember wrong type' => [['remember' => 'string'], 'The remember field must be true or false.'],
]);
