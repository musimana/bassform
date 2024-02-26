<?php

namespace Tests\Browser\TestContent\User;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\User\Dashboard;
use Tests\DuskTestCase;

class DashboardTest extends DuskTestCase
{
    use DatabaseTruncation;

    /** Test the day view renders & behaves correctly. */
    public function testDashboardContent(): void
    {
        $user = User::factory()->create();

        $this->browse(fn (Browser $browser) => $browser
            ->loginAs($user->id)
            ->visit(new Dashboard($user))
        );
    }
}
