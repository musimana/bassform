<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Tests\Browser\Components\FooterNav;
use Tests\Browser\Components\HeaderNav;
use Tests\Browser\Traits\HasSocialLinks;

abstract class StandardPage extends Page
{
    use HasSocialLinks;

    /** Instantiate the class. */
    public function __construct(
        protected FooterNav $footer = new FooterNav
    ) {
    }

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
            ->assertVisible('header')
            ->assertVisible('nav')
            ->assertVisible('main');

        $this->footer->assert($browser);
    }

    /** Click the given site header element selector, to navigate to the related link. */
    public function navigateViaHeader(Browser $browser, string $selector): void
    {
        $browser->within(
            new HeaderNav,
            fn (Browser $browser) => $browser->click($selector)
        );
    }

    /**
     * Click the given url in the given site header element selector's dropdown menu,
     * to navigate to the related link.
     */
    public function navigateViaHeaderDropdown(Browser $browser, string $selector, string $url): void
    {
        $browser->within(
            new HeaderNav,
            fn (Browser $browser) => $browser->clickNavSubItem($selector, $url)
        );
    }
}
