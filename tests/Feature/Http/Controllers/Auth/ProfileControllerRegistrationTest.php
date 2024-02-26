<?php

use App\Http\Controllers\Auth\ProfileController;
use App\Http\Requests\Auth\ProfileStoreRequest;
use App\Http\Resources\Views\Auth\Metadata\ProfileCreateMetadataResource;
use App\Models\User;
use App\Providers\RouteServiceProvider;

beforeEach(function () {
    $this->user_count_initial = User::count();
});

test('TEMPLATE_REGISTER Vue page component exists', function () {
    $template = (new ReflectionClassConstant(
        ProfileController::class,
        'TEMPLATE_REGISTER'
    ))->getValue();

    expect($template)->toBeString();

    $this->assertFileExists(resource_path('js/Pages/' . $template . '.vue'));
});

test('create renders the registration view', function () {
    $route = route('register');
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
        ->toHaveCorrectHtmlHead(ProfileController::TEMPLATE_REGISTER)
        ->toHaveCorrectHtmlBody()
        ->toHaveCorrectPropsAuth(
            ProfileController::TEMPLATE_REGISTER,
            [],
            (new ProfileCreateMetadataResource)->getItem()
        );
});

test('store validates requests with a form request')
    ->assertActionUsesFormRequest(
        ProfileController::class,
        'store',
        ProfileStoreRequest::class
    );

test('store registers new user records', function () {
    $actual = $this
        ->post(route('register.store'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => config('tests.default_password'),
            'password_confirmation' => config('tests.default_password'),
        ]);

    $this->assertAuthenticated();

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect(RouteServiceProvider::HOME);

    expect(User::count())->toBe($this->user_count_initial + 1);
});

test('store throws a validation error if name is missing', function () {
    $actual = $this
        ->from(route('register'))
        ->post(route('register.store'), [
            'not_name' => 'Test User',
            'email' => 'test@example.com',
            'password' => config('tests.default_password'),
            'password_confirmation' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['name' => 'The name field is required.'])
        ->assertRedirect(route('register'));

    expect(User::count())->toBe($this->user_count_initial);
});

test('store throws a validation error if name isn\t a string', function () {
    $actual = $this
        ->from(route('register'))
        ->post(route('register.store'), [
            'name' => 0,
            'email' => 'test@example.com',
            'password' => config('tests.default_password'),
            'password_confirmation' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['name' => 'The name field must be a string.'])
        ->assertRedirect(route('register'));

    expect(User::count())->toBe($this->user_count_initial);
});

test('store throws a validation error if name >255 characters', function () {
    $actual = $this
        ->from(route('register'))
        ->post(route('register.store'), [
            'name' => str_pad('Test User', 256, 'a'),
            'email' => 'test@example.com',
            'password' => config('tests.default_password'),
            'password_confirmation' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['name' => 'The name field must not be greater than 255 characters.'])
        ->assertRedirect(route('register'));

    expect(User::count())->toBe($this->user_count_initial);
});

test('store throws a validation error if email is missing', function () {
    $actual = $this
        ->from(route('register'))
        ->post(route('register.store'), [
            'name' => 'Test User',
            'not_email' => 'test@example.com',
            'password' => config('tests.default_password'),
            'password_confirmation' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['email' => 'The email field is required.'])
        ->assertRedirect(route('register'));

    expect(User::count())->toBe($this->user_count_initial);
});

test('store throws a validation error if email isn\t a string', function () {
    $actual = $this
        ->from(route('register'))
        ->post(route('register.store'), [
            'name' => 'Test User',
            'email' => 0,
            'password' => config('tests.default_password'),
            'password_confirmation' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['email' => 'The email field must be a string.'])
        ->assertRedirect(route('register'));

    expect(User::count())->toBe($this->user_count_initial);
});

test('store throws a validation error if email isn\'t lowercase', function () {
    $actual = $this
        ->from(route('register'))
        ->post(route('register.store'), [
            'name' => 'Test User',
            'email' => 'TEST@example.com',
            'password' => config('tests.default_password'),
            'password_confirmation' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['email' => 'The email field must be lowercase.'])
        ->assertRedirect(route('register'));

    expect(User::count())->toBe($this->user_count_initial);
});

test('store throws a validation error if email isn\'t a valid email', function () {
    $actual = $this
        ->from(route('register'))
        ->post(route('register.store'), [
            'name' => 'Test User',
            'email' => 'test@',
            'password' => config('tests.default_password'),
            'password_confirmation' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['email' => 'The email field must be a valid email address.'])
        ->assertRedirect(route('register'));

    expect(User::count())->toBe($this->user_count_initial);
});

test('store throws a validation error if email >255 characters', function () {
    $actual = $this
        ->from(route('register'))
        ->post(route('register.store'), [
            'name' => 'Test User',
            'email' => str_pad('test@example.com', 256, 'a', STR_PAD_LEFT),
            'password' => config('tests.default_password'),
            'password_confirmation' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['email' => 'The email field must not be greater than 255 characters.'])
        ->assertRedirect(route('register'));

    expect(User::count())->toBe($this->user_count_initial);
});

test('store throws a validation error if email already taken', function (User $user) {
    $user->save();
    $actual = $this
        ->from(route('register'))
        ->post(route('register.store'), [
            'name' => 'Test User',
            'email' => $user->email,
            'password' => config('tests.default_password'),
            'password_confirmation' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['email' => 'The email has already been taken.'])
        ->assertRedirect(route('register'));
})->with('users');

test('store throws a validation error if password is missing', function () {
    $actual = $this
        ->from(route('register'))
        ->post(route('register.store'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'not_password' => config('tests.default_password'),
            'password_confirmation' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['password' => 'The password field is required.'])
        ->assertRedirect(route('register'));

    expect(User::count())->toBe($this->user_count_initial);
});

test('store throws a validation error if password isn\t a string', function () {
    $actual = $this
        ->from(route('register'))
        ->post(route('register.store'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 0,
            'password_confirmation' => config('tests.default_password'),
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['password' => 'The password field must be a string.'])
        ->assertRedirect(route('register'));

    expect(User::count())->toBe($this->user_count_initial);
});

test('store throws a validation error if password <14 characters', function () {
    $actual = $this
        ->from(route('register'))
        ->post(route('register.store'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors(['password' => 'The password field must be at least 14 characters.'])
        ->assertRedirect(route('register'));

    expect(User::count())->toBe($this->user_count_initial);
});

test('store throws a validation error if password isn\'t confirmed', function () {
    $actual = $this
        ->from(route('register'))
        ->post(route('register.store'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => config('tests.default_password'),
            'not_password_confirmation' => config('tests.default_password'),
        ]);

    $actual
        ->assertSessionHasErrors(['password' => 'The password field confirmation does not match.'])
        ->assertRedirect(route('register'));

    expect(User::count())->toBe($this->user_count_initial);

    $actual = $this
        ->from(route('register'))
        ->post(route('register.store'), [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => config('tests.default_password'),
            'password_confirmation' => 'password',
        ]);

    $actual
        ->assertSessionHasErrors(['password' => 'The password field confirmation does not match.'])
        ->assertRedirect(route('register'));

    expect(User::count())->toBe($this->user_count_initial);
});
