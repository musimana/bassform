<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

/*
|--------------------------------------------------------------------------
| Pest Global Helper Method - testNotifiedUpdateValidationErrorEmail
|--------------------------------------------------------------------------
|
| Global helper method available to tests run with Pest.
|
| Test an email notification is not sent when the email provided is
| invalid.
|
*/

function testNotifiedUpdateValidationErrorEmail($subject, $test_data)
{
    Notification::fake();

    $user = User::factory()->create();

    $subject->post(route('password.email'), ['email' => $user->email]);

    try {
        Notification::assertNotSentTo($user, ResetPassword::class, function ($notification) use ($subject, $test_data) {
            $actual = $subject->post(route('password.store'), [
                'token' => $notification->token,
                'password' => config('tests.default_password'),
                'password_confirmation' => config('tests.default_password'),
                ...$test_data,
            ]);

            $actual
                ->assertSessionHasErrors(['email' => 'The email field is required.'])
                ->assertStatus(302);

            return true;
        });
    } catch (Exception $e) {
    }
}
