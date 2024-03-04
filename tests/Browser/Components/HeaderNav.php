<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Component as BaseComponent;

class HeaderNav extends BaseComponent
{
    /** Get the root selector for the component. */
    public function selector(): string
    {
        return 'header';
    }

    /** Assert that the browser page contains the component. */
    public function assert(Browser $browser): void
    {
        $browser
            ->assertVisible($this->selector())
            ->assertVisible('@header-logo')
            ->assertVisible('@header-title')
            ->assertSeeLink(config('app.name'))
            ->assertSeeIn('h1', config('app.name'));
    }

    /**
     * Get the element shortcuts for the component.
     *
     * @return array<string, string>
     */
    public function elements(): array
    {
        return [
            '@header-logo' => '#site-logo',
            '@header-title' => '#site-title',
            '@nav-about' => 'nav a[href="' . route('page.show', 'about') . '"]',
            '@nav-login' => 'nav a[href="' . route('login') . '"]',
            '@nav-logout' => 'nav a[href="' . route('logout') . '"]',
            '@nav-register' => 'nav a[href="' . route('register') . '"]',
            '@responsive-hamburger' => '#nav-hamburger',
        ];
    }

    /** Click the given navbar item, with handling for the responsive navbar. */
    public function clickNavItem(Browser $browser, string $selector): void
    {
        if (config('dusk.screen_width') < 1024) {
            $this->toggleMobileMenu($browser);
        }

        $browser->click($selector);
    }

    /** Click the given navbar item, with handling for the responsive navbar. */
    public function clickNavSubItem(Browser $browser, string $selector, string $route): void
    {
        if (config('dusk.screen_width') < 1024) {
            $this->toggleMobileMenu($browser);
        }

        $this->toggleNavItem($browser, $selector);

        $browser->click('nav a[href="' . $route . '"]');
    }

    /** Click the given navbar item, with handling for the responsive navbar. */
    public function toggleNavItem(Browser $browser, string $selector): void
    {
        if (config('dusk.screen_width') < 1024) {
            $this->toggleMobileMenu($browser);
        }

        $browser->click($selector);
    }

    /** Click the given navbar item, with handling for the responsive navbar. */
    public function toggleMobileMenu(Browser $browser): void
    {
        $browser->click('@responsive-hamburger');
    }
}
