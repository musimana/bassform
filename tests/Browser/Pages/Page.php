<?php

namespace Tests\Browser\Pages;

use Illuminate\Support\Str;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;
use Tests\Browser\Components\HeaderNav;

abstract class Page extends BasePage
{
    /**
     * Get the global element shortcuts for the site.
     *
     * @return array<string, string>
     */
    public static function siteElements(): array
    {
        return [
            '@main' => 'main',
        ];
    }

    /** Assert the page has the correct cookies. */
    public function assertHasCorrectCookies(Browser $browser): void
    {
        $browser
            ->assertHasCookie(Str::slug(config('app.name'), '_') . '_session')
            ->assertHasCookie('XSRF-TOKEN');
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
