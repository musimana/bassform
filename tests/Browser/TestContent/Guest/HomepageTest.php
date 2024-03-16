<?php

namespace Tests\Browser\TestContent\Guest;

use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Guest\Homepage;
use Tests\DuskTestCase;

final class HomepageTest extends DuskTestCase
{
    use DatabaseTruncation;

    /** Test the homepage renders & behaves correctly. */
    public function testHomepageContent(): void
    {
        $this->browse(fn (Browser $browser) => $browser
            ->visit(new Homepage)
        );
    }
}
