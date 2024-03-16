<?php

namespace Tests\Browser\TestNavigation;

use App\Models\Page;
use Database\Seeders\NavbarSeeder;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Guest\Homepage;
use Tests\Browser\Pages\Guest\PageView;
use Tests\Browser\Pages\User\Login;
use Tests\DuskTestCase;

final class HeaderNavigationTest extends DuskTestCase
{
    use DatabaseTruncation;

    /** Test the header logo link works. */
    public function testHeaderLogoLink(): void
    {
        $page = Page::factory()->aboutPage()->create();

        $this->browse(fn (Browser $browser) => $browser
            ->visit(new PageView($page))
            ->navigateViaHeader('@header-logo')

            ->on(new Homepage)
        );
    }

    /** Test the header title link works. */
    public function testHeaderTitleLink(): void
    {
        $page = Page::factory()->aboutPage()->create();

        $this->browse(fn (Browser $browser) => $browser
            ->visit(new PageView($page))
            ->navigateViaHeader('@header-title')

            ->on(new Homepage)
        );
    }

    /** Test the header navbar login link works. */
    public function testNavbarLoginLink(): void
    {
        Page::factory()->aboutPage()->create();

        $this->browse(fn (Browser $browser) => $browser
            ->visit(new Homepage)
            ->navigateViaHeader('@nav-login')

            ->on(new Login)
        );
    }

    /** Test the header navbar about link works. */
    public function testNavbarAboutLink(): void
    {
        (new NavbarSeeder)->run();
        $page = Page::factory()->aboutPage()->create();

        $this->browse(fn (Browser $browser) => $browser
            ->visit(new Homepage)
            ->navigateViaHeader('@nav-about')

            ->on(new PageView($page))
        );
    }
}
