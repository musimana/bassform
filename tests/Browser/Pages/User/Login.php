<?php

namespace Tests\Browser\Pages\User;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\AuthPage;

class Login extends AuthPage
{
    /** Get the URL for the page. */
    public function url(): string
    {
        return route('login');
    }

    /** Assert that the browser is on the page. */
    public function assert(Browser $browser): void
    {
        $browser
            ->assertHasLoadedCorrectly($this->url())
            ->assertHasCorrectCookies()
            ->assertHasRenderedCorrectly('Login')

            ->assertGuest()
            ->pause(config('dusk.pause_length'));
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array<string, string>
     */
    public function elements(): array
    {
        return [
            '@button-login' => 'button#button-login',
        ];
    }

    /** Login to the site. */
    public function loginAsUser(Browser $browser, string $email): void
    {
        $browser
            ->pause(config('dusk.pause_length'))
            ->typeSlowly('email', $email)
            ->typeSlowly('password', config('tests.default_password'))
            ->pause(config('dusk.pause_length'))
            ->screenshotWholePage('login-filled-' . str_replace(['@', '.'], '_', $email))
            ->click('@button-login')
            ->waitForLocation(route('dashboard'), config('dusk.wait_length'));
    }
}
