<?php

use App\Http\Controllers\Auth\ProfilePasswordController;
use App\Http\Requests\Auth\PasswordUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('update validates requests with a form request')
    ->assertActionUsesFormRequest(
        ProfilePasswordController::class,
        'update',
        PasswordUpdateRequest::class
    );

test('update can update the auth user\'s password', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->from(route('profile.edit'))
        ->patch(route('profile.password.update'), [
            'current_password' => config('tests.default_password'),
            'password' => 'ten4characters',
            'password_confirmation' => 'ten4characters',
        ]);

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('profile.edit'));

    $this->assertTrue(Hash::check('ten4characters', $user->refresh()->password));
})->with('users');

test('update throws a validation error if current password missing', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->from(route('profile.edit'))
        ->patch(route('profile.password.update'), [
            'password' => 'ten4characters',
            'password_confirmation' => 'ten4characters',
        ]);

    $actual
        ->assertSessionHasErrors(['current_password' => 'The current password field is required.'])
        ->assertRedirect(route('profile.edit'));

    $this->assertTrue(Hash::check(config('tests.default_password'), $user->refresh()->password));
})->with('users');

test('update throws a validation error if current password isn\'t a string', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->from(route('profile.edit'))
        ->patch(route('profile.password.update'), [
            'current_password' => 0,
            'password' => 'ten4characters',
            'password_confirmation' => 'ten4characters',
        ]);

    $actual
        ->assertSessionHasErrors(['current_password' => 'The current password field must be a string.'])
        ->assertRedirect(route('profile.edit'));

    $this->assertTrue(Hash::check(config('tests.default_password'), $user->refresh()->password));
})->with('users');

test('update throws a validation error if password isn\'t correct', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->from(route('profile.edit'))
        ->patch(route('profile.password.update'), [
            'current_password' => 'wrong-password',
            'password' => 'ten4characters',
            'password_confirmation' => 'ten4characters',
        ]);

    $actual
        ->assertSessionHasErrors(['current_password' => 'The password is incorrect.'])
        ->assertRedirect(route('profile.edit'));

    $this->assertTrue(Hash::check(config('tests.default_password'), $user->refresh()->password));
})->with('users');

test('update throws a validation error for invalid data', function (array $password_array, array $expected) {
    $route = route('profile.edit');
    $user = User::factory()->create();
    $password_array = ['current_password' => config('tests.default_password'), ...$password_array];

    $actual = $this
        ->actingAs($user)
        ->assertAuthenticated()
        ->from($route)
        ->patch(route('profile.password.update'), $password_array);

    $actual
        ->assertSessionHasErrors($expected)
        ->assertRedirect($route);

    $this->assertTrue(Hash::check(config('tests.default_password'), $user->refresh()->password));
})->with('password-arrays-update-invalid');
