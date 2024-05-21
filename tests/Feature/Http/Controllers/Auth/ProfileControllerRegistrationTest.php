<?php

use App\Http\Controllers\Auth\ProfileController;
use App\Http\Requests\Auth\ProfileStoreRequest;
use App\Http\Resources\Views\Auth\Metadata\ProfileCreateMetadataResource;
use App\Models\User;

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
        ->assertRedirect(config('metadata.user_homepage'));

    expect(User::count())->toBe($this->user_count_initial + 1);
});

test('store throws a validation error for invalid data', function (array $user_array, array $expected) {
    $route = route('register');

    $actual = $this
        ->from($route)
        ->post(route('register.store'), $user_array);

    $this->assertGuest();

    $actual
        ->assertSessionHasErrors($expected)
        ->assertRedirect($route);

    expect(User::count())->toBe($this->user_count_initial);
})->with('profile-arrays-store-invalid');

test('store throws a validation error if email already taken', function (User $user) {
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
