<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Views\Auth\Metadata\LoginMetadataResource;
use App\Models\User;

test('TEMPLATE_LOGIN Vue page component exists', function () {
    $template = (new ReflectionClassConstant(
        AuthenticatedSessionController::class,
        'TEMPLATE_LOGIN'
    ))->getValue();

    expect($template)->toBeString();

    $this->assertFileExists(resource_path('js/Pages/' . $template . '.vue'));
});

test('create renders the login view', function () {
    $route = route('login');
    $actual = $this->get($route);
    $session = session()->all();
    $headers = $actual->headers->all();

    $actual
        ->assertStatus(200)
        ->assertSessionHasNoErrors()
        ->assertViewIs('app');

    expect($session)->toHaveCorrectSessionValues($route);

    expect($headers)->toHaveCorrectHeaderValues();

    expect($actual)
        ->toHaveCorrectHtmlHead(AuthenticatedSessionController::TEMPLATE_LOGIN)
        ->toHaveCorrectHtmlBody()
        ->toHaveCorrectPropsAuth(
            AuthenticatedSessionController::TEMPLATE_LOGIN,
            [],
            (new LoginMetadataResource)->getItem()
        );
});

test('store validates requests with a form request')
    ->assertActionUsesFormRequest(
        AuthenticatedSessionController::class,
        'store',
        LoginRequest::class
    );

test('store authenticates users ok', function (User $user) {
    $actual = $this->post(route('login.store'), [
        'email' => $user->email,
        'password' => config('tests.default_password'),
    ]);

    $this->assertAuthenticated();

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect(config('metadata.user_homepage'));
})->with('users');

test('store throws a validation error for invalid data', function (array $password_array, array $expected) {
    $route = route('login');
    User::factory()->create();

    if (($password_array['password'] ?? false) === 'ten4characters') {
        $password_array['password'] = config('tests.default_password');
    }

    $actual = $this
        ->from($route)
        ->post(route('login.store'), $password_array);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors($expected)
        ->assertRedirect($route);
})->with('authenticated-session-arrays-store-invalid');

test('store throws a validation error if email isn\'t correct', function () {
    $actual = $this
        ->from(route('login'))
        ->post(route('login.store'), [
            'email' => 'unknown_email@example.com',
            'password' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['email' => 'These credentials do not match our records.'])
        ->assertRedirect(route('login'));
});

test('edit logs out users with a get request', function (User $user) {
    $actual = $this->actingAs($user)->get(route('logout.edit'));

    $this->assertGuest();

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('home'));
})->with('users');

test('destroy logs out users with a post request', function (User $user) {
    $actual = $this->actingAs($user)->post(route('logout'));

    $this->assertGuest();

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('home'));
})->with('users');
