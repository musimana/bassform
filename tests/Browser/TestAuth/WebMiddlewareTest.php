<?php

namespace Tests\Browser\TestAuth;

use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Assert;
use Tests\Browser\Pages\Admin\Page\AdminEditPage;
use Tests\Browser\Pages\Guest\Homepage;
use Tests\Browser\Pages\User\Dashboard;
use Tests\Browser\Pages\User\Login;
use Tests\DuskTestCase;

final class WebMiddlewareTest extends DuskTestCase
{
    use DatabaseTruncation;

    /** Test the standard guest middleware works correctly. */
    public function testGuestMiddleware(): void
    {
        $this->browse(fn (Browser $browser) => $browser
            ->visit(new Homepage)
            ->assertGuest()
            ->screenshotWholePage('homepage-guest')

            ->visit('/dashboard')
            ->on(new Login)
            ->assertGuest()

            ->visit('/logout')
            ->on(new Login)
            ->assertGuest()
        );
    }

    /** Test the standard auth middleware works correctly. */
    public function testUserMiddleware(): void
    {
        $page = Page::factory()->create();
        $user = User::factory()->create([
            'email' => 'test.user@example.com',
            'name' => 'Test User',
        ]);

        Assert::assertTrue($user->email === 'test.user@example.com');
        Assert::assertTrue($user->name === 'Test User');
        Assert::assertTrue(!$user->hasRole('admin'));

        $this->browse(fn (Browser $browser) => $browser
            ->assertGuest()
            ->visit('/dashboard')
            ->on(new Login)
            ->loginAsUser($user->email)

            ->on(new Dashboard($user))
            ->screenshotWholePage('dashboard-user-' . str_replace(['@', '.'], '_', $user->email))

            ->visit($page->getUrlAdminEdit())
            ->assertSee('404')
            ->assertSee('NOT FOUND')
            ->screenshotWholePage('cms-user-denied')

            ->visit(new Homepage)
            ->assertAuthenticatedAs($user)
            ->screenshotWholePage('homepage-user')

            ->visit('/logout')
            ->on(new Homepage)
            ->assertGuest()
        );
    }

    /** Test the admin auth middleware works correctly. */
    public function testAdminMiddleware(): void
    {
        $page = Page::factory()->create();
        $user = User::factory()->isAdmin()->create([
            'email' => 'test.admin@example.com',
            'name' => 'Test Admin',
        ]);

        Assert::assertTrue($user->email === 'test.admin@example.com');
        Assert::assertTrue($user->name === 'Test Admin');
        Assert::assertTrue($user->hasRole('admin'));

        $this->browse(fn (Browser $browser) => $browser
            ->visit(new Login)
            ->assertGuest()
            ->loginAsUser($user->email)

            ->on(new Dashboard($user))
            ->assertAuthenticatedAs($user)
            ->screenshotWholePage('dashboard-admin-' . str_replace(['@', '.'], '_', $user->email))

            ->visit(new AdminEditPage($page))
            ->assertAuthenticatedAs($user)
            ->screenshotWholePage('admin-edit-page')

            ->visit('/logout')
            ->on(new Homepage)
            ->assertGuest()
        );
    }
}
