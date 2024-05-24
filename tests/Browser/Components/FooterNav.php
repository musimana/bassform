<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Component as BaseComponent;

final class FooterNav extends BaseComponent
{
    /** Get the root selector for the component. */
    public function selector(): string
    {
        return 'footer';
    }

    /** Assert that the browser page contains the component. */
    public function assert(Browser $browser): void
    {
        $browser
            ->assertPresent($this->selector())
            ->assertSeeIn($this->selector(), config('metadata.copyright'));

        foreach (array_keys(config('metadata.social_links', [])) as $social_link) {
            $browser->assertPresent('@social-link-' . $social_link);
        }
    }
}
