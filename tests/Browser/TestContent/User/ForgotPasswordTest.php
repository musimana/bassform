<?php

namespace Tests\Browser\TestContent\User;

use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\User\ForgotPassword;
use Tests\DuskTestCase;

final class ForgotPasswordTest extends DuskTestCase
{
    use DatabaseTruncation;

    /** Test the forgot password view renders & behaves correctly. */
    public function testForgotPasswordContent(): void
    {
        $this->browse(fn (Browser $browser) => $browser
            ->visit(new ForgotPassword)
        );
    }
}
