<?php

use App\Http\Controllers\Auth\ProfileController;
use App\Http\Requests\Auth\ProfileDeleteRequest;
use App\Http\Requests\Auth\ProfileUpdateRequest;
use App\Http\Resources\Views\Auth\Content\DashboardContentResource;
use App\Http\Resources\Views\Auth\Metadata\DashboardMetadataResource;
use App\Http\Resources\Views\Auth\Metadata\ProfileEditMetadataResource;
use App\Models\User;

test('TEMPLATE_DASHBOARD Vue page component exists', function () {
    $template = (new ReflectionClassConstant(
        ProfileController::class,
        'TEMPLATE_DASHBOARD'
    ))->getValue();

    expect($template)->toBeString();

    $this->assertFileExists(resource_path('js/Pages/' . $template . '.vue'));
});

test('TEMPLATE_PROFILE_EDIT Vue page component exists', function () {
    $template = (new ReflectionClassConstant(
        ProfileController::class,
        'TEMPLATE_PROFILE_EDIT'
    ))->getValue();

    expect($template)->toBeString();

    $this->assertFileExists(resource_path('js/Pages/' . $template . '.vue'));
});

test('index renders the profile dashboard view', function (User $user) {
    $route = route('dashboard');
    $actual = $this->actingAs($user)->get($route);
    $session = session()->all();
    $headers = $actual->headers->all();

    $actual
        ->assertStatus(200)
        ->assertSessionHasNoErrors()
        ->assertViewIs('app');

    expect($session)->toHaveCorrectSessionValues($route);

    expect($headers)->toHaveCorrectHeaderValues();

    expect($actual)
        ->toHaveCorrectHtmlHead(ProfileController::TEMPLATE_DASHBOARD)
        ->toHaveCorrectHtmlBody()
        ->toHaveCorrectPropsAuth(
            ProfileController::TEMPLATE_DASHBOARD,
            (new DashboardContentResource)->getItem(),
            (new DashboardMetadataResource)->getItem()
        );
})->with('users');

test('edit renders the profile update view', function (User $user) {
    $route = route('profile.edit');
    $actual = $this->actingAs($user)->get($route);
    $session = session()->all();
    $headers = $actual->headers->all();

    $actual
        ->assertStatus(200)
        ->assertSessionHasNoErrors()
        ->assertViewIs('app');

    expect($session)->toHaveCorrectSessionValues($route);

    expect($headers)->toHaveCorrectHeaderValues();

    expect($actual)
        ->toHaveCorrectHtmlHead(ProfileController::TEMPLATE_PROFILE_EDIT)
        ->toHaveCorrectHtmlBody()
        ->toHaveCorrectPropsAuth(
            ProfileController::TEMPLATE_PROFILE_EDIT,
            [],
            (new ProfileEditMetadataResource)->getItem()
        );
})->with('users');

test('update validates requests with a form request')
    ->assertActionUsesFormRequest(
        ProfileController::class,
        'update',
        ProfileUpdateRequest::class
    );

test('update can update the auth user\'s profile info', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('profile.edit'));

    $user->refresh();

    $this->assertSame('Test User', $user->name);
    $this->assertSame('test@example.com', $user->email);
    $this->assertNull($user->email_verified_at);
})->with('users');

test('update leaves email verification status unchanged when the email address is unchanged', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => 'Test User',
            'email' => $user->email,
        ]);

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('profile.edit'));

    $this->assertNotNull($user->refresh()->email_verified_at);
})->with('users');

test('update throws a validation error if name missing', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->patch(route('profile.update'), [
            'email' => $user->email,
        ]);

    $actual
        ->assertSessionHasErrors(['name' => 'The name field is required.'])
        ->assertStatus(302);
})->with('users');

test('update throws a validation error if name isn\'t a string', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => 0,
            'email' => $user->email,
        ]);

    $actual
        ->assertSessionHasErrors(['name' => 'The name field must be a string.'])
        ->assertStatus(302);
})->with('users');

test('update throws a validation error if name >255 characters', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => str_pad('Test User', 256, 'a'),
            'email' => $user->email,
        ]);

    $actual
        ->assertSessionHasErrors(['name' => 'The name field must not be greater than 255 characters.'])
        ->assertStatus(302);
})->with('users');

test('update throws a validation error if email missing', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => 'Test User',
        ]);

    $actual
        ->assertSessionHasErrors(['email' => 'The email field is required.'])
        ->assertStatus(302);
})->with('users');

test('update throws a validation error if email isn\'t a string', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => 'Test User',
            'email' => 0,
        ]);

    $actual
        ->assertSessionHasErrors(['email' => 'The email field must be a string.'])
        ->assertStatus(302);
})->with('users');

test('update throws a validation error if email isn\'t a valid email', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => 'Test User',
            'email' => 'test@',
        ]);

    $actual
        ->assertSessionHasErrors(['email' => 'The email field must be a valid email address.'])
        ->assertStatus(302);
})->with('users');

test('update throws a validation error if new email already taken', function (User $user) {
    User::factory()->create(['email' => 'taken_email@example.com']);

    $actual = $this
        ->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => 'Test User',
            'email' => 'taken_email@example.com',
        ]);

    $actual
        ->assertSessionHasErrors(['email' => 'The email has already been taken.'])
        ->assertStatus(302);
})->with('users');

test('update throws a validation error if email >255 characters', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => 'Test User',
            'email' => str_pad($user->email, 256, 'a', STR_PAD_LEFT),
        ]);

    $actual
        ->assertSessionHasErrors(['email' => 'The email field must not be greater than 255 characters.'])
        ->assertStatus(302);
})->with('users');

test('destroy validates requests with a form request')
    ->assertActionUsesFormRequest(
        ProfileController::class,
        'destroy',
        ProfileDeleteRequest::class
    );

test('destroy can delete the auth user\'s account', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->delete(route('profile.destroy'), [
            'password' => config('tests.default_password'),
        ]);

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('home'));

    $this->assertGuest();
    $this->assertNull($user->fresh());
    $this->assertModelMissing($user);
})->with('users');

test('destroy throws a validation error if password missing', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->from(route('profile.edit'))
        ->delete(route('profile.destroy'), [
            'not_password' => config('tests.default_password'),
        ]);

    $this->assertAuthenticated();

    $actual
        ->assertSessionHasErrors(['password' => 'The password field is required.'])
        ->assertRedirect(route('profile.edit'));

    $this->assertNotNull($user->fresh());
})->with('users');

test('destroy throws a validation error if password isn\'t a string', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->from(route('profile.edit'))
        ->delete(route('profile.destroy'), [
            'password' => 0,
        ]);

    $this->assertAuthenticated();

    $actual
        ->assertSessionHasErrors(['password' => 'The password field must be a string.'])
        ->assertRedirect(route('profile.edit'));

    $this->assertNotNull($user->fresh());
})->with('users');

test('destroy throws a validation error if password isn\'t correct', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->from(route('profile.edit'))
        ->delete(route('profile.destroy'), [
            'password' => 'wrong old password',
        ]);

    $this->assertAuthenticated();

    $actual
        ->assertSessionHasErrors(['password' => 'The password is incorrect.'])
        ->assertRedirect(route('profile.edit'));

    $this->assertNotNull($user->fresh());
})->with('users');
