<?php

namespace Tests\Browser\Pages\User;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\AuthPage;

final class ForgotPassword extends AuthPage
{
    /** Get the URL for the page. */
    public function url(): string
    {
        return route('password.request');
    }

    /** Assert that the browser is on the page. */
    public function assert(Browser $browser): void
    {
        $browser
            ->assertHasLoadedCorrectly($this->url())
            ->assertHasCorrectCookies()
            ->assertHasRenderedCorrectly('Forgot Password')

            ->pause(config('dusk.pause_length'));
    }
}
