<?php

namespace Tests\Browser\Pages\User;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\StandardPage;

final class Dashboard extends StandardPage
{
    /** Instantiate the class. */
    public function __construct(
        private User $user
    ) {
        parent::__construct();
    }

    /** Get the URL for the page. */
    public function url(): string
    {
        return route('dashboard');
    }

    /** Assert that the browser is on the page. */
    public function assert(Browser $browser): void
    {
        $browser
            ->assertHasLoadedCorrectly($this->url())
            ->assertHasCorrectCookies()
            ->assertHasRenderedCorrectly('Dashboard')

            ->assertAuthenticatedAs($this->user)
            ->pause(config('tests.dusk.pause_length'));
    }
}
