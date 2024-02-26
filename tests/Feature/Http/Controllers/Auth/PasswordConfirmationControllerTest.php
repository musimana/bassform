<?php

use App\Http\Controllers\Auth\PasswordConfirmationController;
use App\Http\Resources\Views\Auth\Metadata\PasswordConfirmMetadataResource;
use App\Models\User;

test('TEMPLATE_PASSWORD_CONFIRM Vue page component exists', function () {
    $template = (new ReflectionClassConstant(
        PasswordConfirmationController::class,
        'TEMPLATE_PASSWORD_CONFIRM'
    ))->getValue();

    expect($template)->toBeString();

    $this->assertFileExists(resource_path('js/Pages/' . $template . '.vue'));
});

test('show renders the confirm password view', function (User $user) {
    $user->save();
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
        ->toHaveCorrectHtmlHead(PasswordConfirmationController::TEMPLATE_PASSWORD_CONFIRM)
        ->toHaveCorrectHtmlBody()
        ->toHaveCorrectPropsAuth(
            PasswordConfirmationController::TEMPLATE_PASSWORD_CONFIRM,
            [],
            (new PasswordConfirmMetadataResource)->getItem()
        );
})->with('users');

test('store confirms passwords with valid data', function (User $user) {
    $user->save();
    $actual = $this->actingAs($user)->post(route('password.confirm.store'), [
        'password' => config('tests.default_password'),
    ]);

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('dashboard'));
})->with('users');

test('store doesn\'t confirm passwords with invalid data', function (User $user) {
    $user->save();
    $actual = $this->actingAs($user)->post(route('password.confirm.store'), [
        'password' => 'wrong-password',
    ]);

    $actual->assertSessionHasErrors();
})->with('users');
