<?php

namespace Tests\Browser\Pages\Guest;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\StandardPage;

class Homepage extends StandardPage
{
    /** Get the URL for the page. */
    public function url(): string
    {
        return url('/') . '/';
    }

    /** Assert that the browser is on the page. */
    public function assert(Browser $browser): void
    {
        $browser
            ->assertHasLoadedCorrectly($this->url())
            ->assertHasCorrectCookies()
            ->assertHasRenderedCorrectly(config('app.name'))

            ->pause(config('dusk.pause_length'));
    }
}
