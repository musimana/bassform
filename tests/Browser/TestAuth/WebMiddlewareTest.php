<?php

namespace Tests\Browser\TestAuth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Assert;
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
        $user = User::factory()->create([
            'email' => 'test.user@example.com',
            'name' => 'Test User',
        ]);

        Assert::assertTrue($user->email === 'test.user@example.com');
        Assert::assertTrue($user->name === 'Test User');

        $this->browse(fn (Browser $browser) => $browser
            ->assertGuest()
            ->visit('/dashboard')
            ->on(new Login)
            ->loginAsUser($user->email)

            ->on(new Dashboard($user))
            ->screenshotWholePage('dashboard-user-' . str_replace(['@', '.'], '_', $user->email))

            ->visit(new Homepage)
            ->assertAuthenticatedAs($user)
            ->screenshotWholePage('homepage-user')

            ->visit('/logout')
            ->on(new Homepage)
            ->assertGuest()
        );
    }
}
