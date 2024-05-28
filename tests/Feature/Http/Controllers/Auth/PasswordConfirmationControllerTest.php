<?php

use App\Enums\Webpages\WebpageTemplate;
use App\Http\Resources\Views\Auth\Metadata\PasswordConfirmMetadataResource;
use App\Models\User;

test('show renders the confirm password view', function (User $user) {
    $route = route('password.confirm');
    $actual = $this->actingAs($user)->get(route('password.confirm'));
    $session = session()->all();
    $headers = $actual->headers->all();

    $actual
        ->assertStatus(200)
        ->assertSessionHasNoErrors()
        ->assertViewIs('app');

    expect($session)->toHaveCorrectSessionValues($route);

    expect($headers)->toHaveCorrectHeaderValues();

    expect($actual)
        ->toHaveCorrectHtmlHead(WebpageTemplate::AUTH_PASSWORD_CONFIRM->value)
        ->toHaveCorrectHtmlBody()
        ->toHaveCorrectPropsAuth(
            WebpageTemplate::AUTH_PASSWORD_CONFIRM->value,
            [],
            (new PasswordConfirmMetadataResource)->getItem()
        );
})->with('users');

test('store confirms passwords with valid data', function (User $user) {
    $actual = $this->actingAs($user)->post(route('password.confirm.store'), [
        'password' => config('tests.default_password'),
    ]);

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('dashboard'));
})->with('users');

test('store doesn\'t confirm passwords with invalid data', function (User $user) {
    $actual = $this->actingAs($user)->post(route('password.confirm.store'), [
        'password' => 'wrong-password',
    ]);

    $actual->assertSessionHasErrors();
})->with('users');
