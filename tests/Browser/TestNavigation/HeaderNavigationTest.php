<?php

namespace Tests\Browser\TestNavigation;

use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Guest\Homepage;
use Tests\Browser\Pages\Guest\PageView;
use Tests\Browser\Pages\User\Login;
use Tests\Browser\Pages\User\Register;
use Tests\DuskTestCase;

class HeaderNavigationTest extends DuskTestCase
{
    use DatabaseTruncation;

    /** Test the header logo link works. */
    public function testHeaderLogoLink(): void
    {
        $page = Page::factory()->create();

        $this->browse(fn (Browser $browser) => $browser
            ->visit(new PageView($page))
            ->navigateViaHeader('@header-logo')

            ->on(new Homepage)
        );
    }

    /** Test the header title link works. */
    public function testHeaderTitleLink(): void
    {
        $page = Page::factory()->create();

        $this->browse(fn (Browser $browser) => $browser
            ->visit(new PageView($page))
            ->navigateViaHeader('@header-title')

            ->on(new Homepage)
        );
    }

    /** Test the header navbar login link works. */
    public function testNavbarLoginLink(): void
    {
        $this->browse(fn (Browser $browser) => $browser
            ->visit(new Homepage)
            ->navigateViaHeader('@nav-login')

            ->on(new Login)
        );
    }

    /** Test the header navbar logout link works. */
    public function testNavbarLogoutLink(): void
    {
        $user = User::factory()->create();

        $this->browse(fn (Browser $browser) => $browser
            ->loginAs($user)
            ->visit(new Homepage)
            ->assertAuthenticatedAs($user)
            ->navigateViaHeader('@nav-logout')

            ->on(new Homepage)
            ->assertGuest()
        );
    }

    /** Test the header navbar registration link works. */
    public function testNavbarRegistrationLink(): void
    {
        $this->browse(fn (Browser $browser) => $browser
            ->visit(new Homepage)
            ->navigateViaHeader('@nav-register')

            ->on(new Register)
        );
    }

    /** Test the header navbar about link works. */
    public function testNavbarAboutLink(): void
    {
        $page = Page::factory()->create([
            'title' => 'About',
            'meta_title' => 'About',
            'slug' => 'about',
        ]);

        $this->browse(fn (Browser $browser) => $browser
            ->visit(new Homepage)
            ->navigateViaHeader('@nav-about')

            ->on(new PageView($page))
        );
    }
}
