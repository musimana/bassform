<?php

namespace Tests\Browser\Pages\User;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\AuthPage;

final class Register extends AuthPage
{
    /** Get the URL for the page. */
    public function url(): string
    {
        return route('register');
    }

    /** Assert that the browser is on the page. */
    public function assert(Browser $browser): void
    {
        $browser
            ->assertHasLoadedCorrectly($this->url())
            ->assertHasCorrectCookies()
            ->assertHasRenderedCorrectly('Register')

            ->assertGuest()
            ->pause(config('tests.dusk.pause_length'));
    }
}
