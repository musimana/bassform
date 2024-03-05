<?php

namespace Tests\Browser\TestContent\Guest;

use App\Models\Page;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Guest\PageView;
use Tests\DuskTestCase;

class AboutPageTest extends DuskTestCase
{
    use DatabaseTruncation;

    /** Test the about page renders & behaves correctly. */
    public function testAboutPageContent(): void
    {
        $this->artisan('db:seed', ['Database\Seeders\PageSeeder']);

        $page = Page::where('slug', 'about')->firstOrFail();

        $this->browse(fn (Browser $browser) => $browser
            ->visit(new PageView($page))
        );
    }
}
