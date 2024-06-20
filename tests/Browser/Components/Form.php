<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Component as BaseComponent;

final class Form extends BaseComponent
{
    /** Instantiate the class. */
    public function __construct(
        private string $selector
    ) {}

    /** Get the root selector for the component. */
    public function selector(): string
    {
        return $this->selector;
    }

    /** Assert that the browser page contains the component. */
    public function assert(Browser $browser): void
    {
        $browser->assertVisible($this->selector());
    }

    /**
     * Get the element shortcuts for the component.
     *
     * @return array<string, string>
     */
    public function elements(): array
    {
        return [
            '@button-submit' => 'button[type="submit"]',
        ];
    }

    /**
     * Complete the form.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function completeForm(Browser $browser, array $attributes = []): void
    {
        foreach ($attributes as $key => $value) {
            $type = is_array($value) ? $value['type'] : '';
            $selector = 'input[name="' . $key . '"]';

            $browser
                ->assertPresent($selector)
                ->scrollIntoView($selector);

            match ($type) {
                'checkbox' => $browser->check($selector),
                default => $browser->typeSlowly($selector, $value),
            };
        }
    }

    /** Submit the form. */
    public function submitForm(Browser $browser): void
    {
        $browser->scrollIntoView('@button-submit')->click('@button-submit');
    }
}
