<?php

namespace Tests\Browser\TestContent\Admin;

use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use PHPUnit\Framework\Assert;
use Tests\Browser\Pages\Admin\Page\AdminEditPage;
use Tests\DuskTestCase;

final class PageAdminTest extends DuskTestCase
{
    use DatabaseTruncation;

    /** Test the admin page edit view renders & behaves correctly. */
    public function testAdminPageEdit(): void
    {
        $initial_array = [
            'in_sitemap' => 0,
            'meta_description' => 'Old meta-description.',
            'title' => 'Old Title',
        ];

        $expected_array = [
            'title' => 'New Title',
            'metaDescription' => 'New description.',
            'inSitemap' => ['type' => 'checkbox'],
        ];

        $page = Page::factory()->create($initial_array);
        $user = User::factory()->isAdmin()->create();

        Assert::assertTrue($page->title === $initial_array['title']);
        Assert::assertTrue($page->meta_description === $initial_array['meta_description']);
        Assert::assertFalse($page->in_sitemap);

        $this->browse(fn (Browser $browser) => $browser
            ->loginAs($user)

            ->visit(new AdminEditPage($page))
            ->screenshotWholePage('admin-pages-edit-blank')
            ->completeForm('form', $expected_array)
            ->screenshotWholePage('admin-pages-edit-filled')
            ->submitForm('form')
        );
    }
}
