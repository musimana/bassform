<?php

use App\Enums\Webpages\WebpageTemplate;
use App\Http\Resources\Views\Auth\Metadata\EmailVerifyMetadataResource;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

test('show renders the email verification view', function (User $user) {
    $route = route('verification.notice');
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
        ->toHaveCorrectHtmlHead(WebpageTemplate::AUTH_EMAIL_VERIFY->value)
        ->toHaveCorrectHtmlBody()
        ->toHaveCorrectPropsAuth(
            WebpageTemplate::AUTH_EMAIL_VERIFY->value,
            [],
            (new EmailVerifyMetadataResource)->getItem()
        );
})->with('users-unverified');

test('store sends email verification notifications', function (User $user) {
    $actual = $this
        ->actingAs($user)
        ->post(route('verification.send'));

    $actual
        ->assertStatus(302)
        ->assertSessionHasNoErrors()
        ->assertSessionHas('status', 'verification-link-sent');
})->with('users-unverified');

test('store doesn\'t send email verification notifications to verified users', function (User $user) {
    $user->markEmailAsVerified();

    $actual = $this
        ->actingAs($user)
        ->post(route('verification.send'));

    $actual
        ->assertStatus(302)
        ->assertSessionHasNoErrors()
        ->assertSessionMissing('status');
})->with('users-unverified');

test('edit renders the email verification view & can verify emails', function (User $user) {
    Event::fake();

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1($user->email)]
    );

    $actual = $this->actingAs($user)->get($verificationUrl);

    Event::assertDispatched(Verified::class);
    expect($user->fresh()?->hasVerifiedEmail())->toBeTrue();

    $actual
        ->assertSessionHasNoErrors()
        ->assertRedirect(config('metadata.user_homepage') . '?verified=1');
})->with('users-unverified');

test('edit renders the email verification view, but doesn\'t verify emails when invalid hash given', function (User $user) {
    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1('wrong-email')]
    );

    $this->actingAs($user)->get($verificationUrl);

    expect($user->fresh()?->hasVerifiedEmail())->toBeFalse();
})->with('users-unverified');
