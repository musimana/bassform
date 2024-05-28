<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Tests\Browser\Traits\HasForm;

abstract class AuthPage extends Page
{
    use HasForm;

    /** Assert the page has loaded correctly. */
    public function assertHasLoadedCorrectly(Browser $browser, string $url): void
    {
        $browser
            ->waitForLocation($url, config('tests.dusk.wait_length'))
            ->assertUrlIs($url)
            ->assertScript('window.__VUE__')
            ->assertScript('document.readyState', 'complete');
    }

    /** Assert the page has rendered correctly. */
    public function assertHasRenderedCorrectly(Browser $browser, string $title): void
    {
        $browser
            ->assertTitle($title . ' - ' . config('app.name'))
            ->assertVisible('#app')
            ->assertVisible('main');
    }
}
