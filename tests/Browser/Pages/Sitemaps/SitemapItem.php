<?php

namespace Tests\Browser\Pages\Sitemaps;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\SitemapPage;

final class SitemapItem extends SitemapPage
{
    /** Instantiate the class. */
    public function __construct(
        private string $sitemap
    ) {
    }

    /** Get the URL for the page. */
    public function url(): string
    {
        return route('sitemap.show', $this->sitemap);
    }

    /** Assert that the browser is on the page. */
    public function assert(Browser $browser): void
    {
        $browser
            ->assertHasLoadedCorrectly($this->url())
            ->assertHasCorrectCookies()
            ->assertHasRenderedCorrectly()

            ->assertVisible('urlset')
            ->assertVisible('url')
            ->pause(config('tests.dusk.pause_length'));
    }
}
