<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Views\Auth\Metadata\LoginMetadataResource;
use App\Models\User;
use App\Providers\RouteServiceProvider;

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
        ->assertRedirect(RouteServiceProvider::HOME);
})->with('users');

test('store throws a validation error if email is missing', function (User $user) {
    $actual = $this
        ->from(route('login'))
        ->post(route('login.store'), [
            'not_email' => $user->email,
            'password' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['email' => 'The email field is required.'])
        ->assertRedirect(route('login'));
})->with('users');

test('store throws a validation error if email isn\'t a string', function () {
    $actual = $this
        ->from(route('login'))
        ->post(route('login.store'), [
            'email' => 0,
            'password' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['email' => 'The email field must be a string.'])
        ->assertRedirect(route('login'));
});

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

test('store throws a validation error if email isn\'t a valid email', function () {
    $actual = $this
        ->from(route('login'))
        ->post(route('login.store'), [
            'email' => 'test@',
            'password' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['email' => 'The email field must be a valid email address.'])
        ->assertRedirect(route('login'));
});

test('store throws a validation error if email >255 characters', function (User $user) {
    $actual = $this
        ->from(route('login'))
        ->post(route('login.store'), [
            'email' => str_pad($user->email, 256, 'a', STR_PAD_LEFT),
            'password' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['email' => 'The email field must not be greater than 255 characters.'])
        ->assertRedirect(route('login'));
})->with('users');

test('store throws a validation error if password is missing', function (User $user) {
    $actual = $this
        ->from(route('login'))
        ->post(route('login.store'), [
            'email' => $user->email,
            'not_password' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['password' => 'The password field is required.'])
        ->assertRedirect(route('login'));
})->with('users');

test('store throws a validation error if password isn\'t a string', function (User $user) {
    $actual = $this
        ->from(route('login'))
        ->post(route('login.store'), [
            'email' => $user->email,
            'password' => 0,
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['password' => 'The password field must be a string.'])
        ->assertRedirect(route('login'));
})->with('users');

test('store throws a validation error if password isn\'t correct', function (User $user) {
    $actual = $this
        ->from(route('login'))
        ->post(route('login.store'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['email' => 'These credentials do not match our records.'])
        ->assertRedirect(route('login'));
})->with('users');

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
