<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Tests\Browser\Traits\HasForm;
use Tests\Browser\Traits\HasSocialLinks;

abstract class AdminPage extends Page
{
    use HasForm,
        HasSocialLinks;

    /**
     * Get the element shortcuts for the page.
     *
     * @return array<string, string>
     */
    public function elements(): array
    {
        return $this->getSelectorsSocialLinks();
    }

    /** Assert the page has loaded correctly. */
    public function assertHasLoadedCorrectly(Browser $browser, string $url): void
    {
        $browser
            ->waitForLocation($url, config('tests.wait_length'))
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
