<?php

namespace Tests\Browser\TestContent\Guest;

use App\Models\Page;
use Database\Seeders\PageSeeder;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Assert;
use Tests\Browser\Pages\Guest\PageView;
use Tests\DuskTestCase;

final class PrivacyPageTest extends DuskTestCase
{
    use DatabaseTruncation;

    /** Test the privacy page renders & behaves correctly. */
    public function testPrivacyPageContentWithoutPageModel(): void
    {
        $page = Page::factory()->privacyPage()->make();

        $this->browse(fn (Browser $browser) => $browser
            ->visit(new PageView($page))
            ->assertSee(strtoupper($page->getTitle()))
        );
    }

    /** Test the privacy page renders & behaves correctly with a page model. */
    public function testPrivacyPageContentWithPageModel(): void
    {
        (new PageSeeder)->run();
        $page = Page::where('slug', 'privacy')->first() ?? Page::factory()->privacyPage()->create();
        Assert::assertEquals(Page::where('slug', 'privacy')->count(), 1);

        $this->browse(fn (Browser $browser) => $browser
            ->visit(new PageView($page))
        );
    }
}
