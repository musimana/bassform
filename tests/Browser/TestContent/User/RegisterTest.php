<?php

namespace Tests\Browser\TestContent\User;

use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\User\Register;
use Tests\DuskTestCase;

final class RegisterTest extends DuskTestCase
{
    use DatabaseTruncation;

    /** Test the register view renders & behaves correctly. */
    public function testRegisterContent(): void
    {
        $this->browse(fn (Browser $browser) => $browser
            ->visit(new Register)
        );
    }
}
