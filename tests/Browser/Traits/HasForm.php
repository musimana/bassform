<?php

namespace Tests\Browser\Traits;

use Laravel\Dusk\Browser;
use Tests\Browser\Components\Form;

trait HasForm
{
    /**
     * Use the given attributes to complete the form with the given selector.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function completeForm(Browser $browser, string $selector, array $attributes = []): void
    {
        $browser->within(
            new Form($selector),
            fn (Browser $browser) => $browser->completeForm($attributes)
        );
    }

    /** Submit the form with the given selector. */
    public function submitForm(Browser $browser, string $selector): void
    {
        $browser->within(
            new Form($selector),
            fn (Browser $browser) => $browser->submitForm()
        );
    }
}
