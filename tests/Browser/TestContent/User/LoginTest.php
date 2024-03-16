<?php

namespace Tests\Browser\TestContent\User;

use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\User\Login;
use Tests\DuskTestCase;

final class LoginTest extends DuskTestCase
{
    use DatabaseTruncation;

    /** Test the day view renders & behaves correctly. */
    public function testLoginContent(): void
    {
        $this->browse(fn (Browser $browser) => $browser
            ->visit(new Login)
        );
    }
}
