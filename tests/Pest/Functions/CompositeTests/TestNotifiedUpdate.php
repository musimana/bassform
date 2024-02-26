<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

/*
|--------------------------------------------------------------------------
| Pest Global Helper Method - testNotifiedUpdate
|--------------------------------------------------------------------------
|
| Global helper method available to tests run with Pest.
|
| Test an email notification is sent successfully.
|
*/

function testNotifiedUpdate($subject)
{
    Notification::fake();

    $user = User::factory()->create();

    $subject->post(route('password.email'), ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($subject, $user) {
        $actual = $subject->post(route('password.store'), [
            'token' => $notification->token,
            'email' => $user->email,
            'password' => config('tests.default_password'),
            'password_confirmation' => config('tests.default_password'),
        ]);

        $actual->assertSessionHasNoErrors();

        return true;
    });
}
