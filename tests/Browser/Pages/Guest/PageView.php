<?php

namespace Tests\Browser\Pages\Guest;

use App\Models\Page as PageModel;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\StandardPage;

final class PageView extends StandardPage
{
    /** Instantiate the class. */
    public function __construct(
        private PageModel $page
    ) {
        parent::__construct();
    }

    /** Get the URL for the page. */
    public function url(): string
    {
        return route('page.show', $this->page->getPath());
    }

    /** Assert that the browser is on the page. */
    public function assert(Browser $browser): void
    {
        $browser
            ->assertHasLoadedCorrectly($this->url())
            ->assertHasCorrectCookies()
            ->assertHasRenderedCorrectly($this->page->getMetaTitle())

            ->pause(config('dusk.pause_length'));
    }
}
