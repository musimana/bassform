<?php

use App\Enums\Webpages\WebpageTemplate;
use App\Http\Controllers\Auth\PasswordForgottenController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetLinkRequest;
use App\Http\Requests\Auth\PasswordUpdateForgottenRequest;
use App\Http\Resources\Views\Auth\Metadata\PasswordForgotMetadataResource;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

arch('it extends the expected abstract controller')
    ->expect(PasswordForgottenController::class)
    ->toExtend(Controller::class);

test('create renders the reset password link view', function () {
    $route = route('password.request');
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
        ->toHaveCorrectHtmlHead(WebpageTemplate::AUTH_PASSWORD_FORGOT->value)
        ->toHaveCorrectHtmlBody()
        ->toHaveCorrectPropsAuth(
            WebpageTemplate::AUTH_PASSWORD_FORGOT->value,
            [],
            (new PasswordForgotMetadataResource)->getItem()
        );
});

test('store validates requests with a form request')
    ->assertActionUsesFormRequest(
        PasswordForgottenController::class,
        'store',
        PasswordResetLinkRequest::class
    );

test('store sends a requested reset password link', function (User $user) {
    Notification::fake();

    $this->post(route('password.email'), ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class);
})->with('users');

test('store throws a validation error if email is missing', function () {
    $actual = $this->post(route('password.email'), [
        'not_email' => 'test@example.com',
    ]);

    $actual
        ->assertSessionHasErrors(['email' => 'The email field is required.'])
        ->assertStatus(302);
});

test('store throws a validation error if email isn\'t a string', function () {
    $actual = $this->post(route('password.email'), [
        'email' => 0,
    ]);

    $actual
        ->assertSessionHasErrors(['email' => 'The email field must be a string.'])
        ->assertStatus(302);
});

test('store throws a validation error if email isn\'t a valid email', function () {
    $actual = $this->post(route('password.email'), [
        'email' => 'test@',
    ]);

    $actual
        ->assertSessionHasErrors(['email' => 'The email field must be a valid email address.'])
        ->assertStatus(302);
});

test('store throws a validation error if email is >255 characters', function () {
    $actual = $this->post(route('password.email'), [
        'email' => str_pad('test@example.com', 256, 'a', STR_PAD_LEFT),
    ]);

    $actual
        ->assertSessionHasErrors(['email' => 'The email field must not be greater than 255 characters.'])
        ->assertStatus(302);
});

test('store throws a validation error if email is unknown', function () {
    $actual = $this->post(route('password.email'), [
        'email' => 'test@example',
    ]);

    $actual
        ->assertSessionHasErrors(['email' => 'We can\'t find a user with that email address.'])
        ->assertStatus(302);
});

test('edit renders the forgotten password update view', function (User $user) {
    Notification::fake();

    $this->post(route('password.email'), ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
        $route = route('password.reset', $notification->token);
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
            ->toHaveCorrectHtmlHead(WebpageTemplate::AUTH_PASSWORD_RESET->value)
            ->toHaveCorrectHtmlBody()
            ->toHaveCorrectPropsAuth(
                WebpageTemplate::AUTH_PASSWORD_RESET->value,
                [],
                [
                    'canonical' => $route,
                    'description' => 'Reset your ' . config('app.name') . ' account password.',
                    'keywords' => '',
                    'email' => null,
                    'title' => 'Reset Password',
                    'token' => null,
                ]
            );

        return true;
    });
})->with('users');

test('update validates requests with a form request')
    ->assertActionUsesFormRequest(
        PasswordForgottenController::class,
        'update',
        PasswordUpdateForgottenRequest::class
    );

test('update resets passwords with a valid token given', function () {
    testNotifiedUpdate($this);
});

test('update throws a validation error if email is missing', function (User $user) {
    testNotifiedUpdateValidationErrorEmail($this, [
        'not_email' => $user->email,
    ]);
})->with('users');

test('update throws a validation error if email isn\'t a string', function () {
    testNotifiedUpdateValidationErrorEmail($this, [
        'email' => 0,
    ]);
});

test('update throws a validation error if email isn\'t a valid email', function () {
    testNotifiedUpdateValidationErrorEmail($this, [
        'email' => 'test@',
    ]);
});

test('update throws a validation error if email is >255 characters', function () {
    testNotifiedUpdateValidationErrorEmail($this, [
        'email' => str_pad('test@example.com', 256, 'a', STR_PAD_LEFT),
    ]);
});
