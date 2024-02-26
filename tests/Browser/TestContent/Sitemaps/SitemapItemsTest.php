<?php

namespace Tests\Browser\TestContent\Sitemaps;

use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Sitemaps\SitemapItem;
use Tests\DuskTestCase;

class SitemapItemsTest extends DuskTestCase
{
    use DatabaseTruncation;

    /** Test the sitemap item view for pages renders & behaves correctly. */
    public function testSitemapItemPagesContent(): void
    {
        $this->browse(fn (Browser $browser) => $browser
            ->visit(new SitemapItem('pages'))
        );
    }
}
