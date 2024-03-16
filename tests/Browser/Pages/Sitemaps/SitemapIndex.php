<?php

namespace Tests\Browser\Pages\Sitemaps;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\SitemapPage;

final class SitemapIndex extends SitemapPage
{
    /** Get the URL for the page. */
    public function url(): string
    {
        return route('sitemap.index');
    }

    /** Assert that the browser is on the page. */
    public function assert(Browser $browser): void
    {
        $browser
            ->assertHasLoadedCorrectly($this->url())
            ->assertHasCorrectCookies()
            ->assertHasRenderedCorrectly()

            ->assertVisible('sitemapindex')
            ->assertVisible('sitemap')
            ->assertVisible('loc')
            ->pause(config('dusk.pause_length'));
    }
}
