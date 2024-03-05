<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Component as BaseComponent;

class FooterNav extends BaseComponent
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
            ->assertSee(config('metadata.copyright'))
            ->assertPresent('@nav-footer-github');
    }
}
