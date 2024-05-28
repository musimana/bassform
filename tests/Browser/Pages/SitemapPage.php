<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

abstract class SitemapPage extends Page
{
    /** Assert the page has loaded correctly. */
    public function assertHasLoadedCorrectly(Browser $browser, string $url): void
    {
        $browser
            ->waitForLocation($url, config('tests.dusk.wait_length'))
            ->assertUrlIs($url);
    }

    /** Assert the page has rendered correctly. */
    public function assertHasRenderedCorrectly(Browser $browser): void
    {
        $browser
            ->assertSee(route('home'));
    }
}
