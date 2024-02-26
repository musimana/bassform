<?php

namespace Tests\Browser\TestContent\Sitemaps;

use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Sitemaps\SitemapIndex;
use Tests\DuskTestCase;

class SitemapIndexTest extends DuskTestCase
{
    use DatabaseTruncation;

    /** Test the sitemap index renders & behaves correctly. */
    public function testSitemapIndexContent(): void
    {
        $this->browse(fn (Browser $browser) => $browser
            ->visit(new SitemapIndex)
        );
    }
}
