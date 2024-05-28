<?php

namespace Tests\Browser\Pages\Admin\Page;

use App\Models\Page;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\AdminPage;

final class AdminEditPage extends AdminPage
{
    /** Instantiate the class. */
    public function __construct(
        private Page $page
    ) {
    }

    /** Get the URL for the page. */
    public function url(): string
    {
        return $this->page->getUrlEdit();
    }

    /** Assert that the browser is on the page. */
    public function assert(Browser $browser): void
    {
        $browser
            ->assertHasLoadedCorrectly($this->url())
            ->assertHasCorrectCookies()
            ->assertHasRenderedCorrectly($this->page->getTitle())

            ->pause(config('tests.dusk.pause_length'));
    }
}
