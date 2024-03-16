<?php

namespace Tests\Browser\TestContent\User;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\User\ProfileEdit;
use Tests\DuskTestCase;

final class ProfileEditTest extends DuskTestCase
{
    use DatabaseTruncation;

    /** Test the day view renders & behaves correctly. */
    public function testProfileEditContent(): void
    {
        $user = User::factory()->create();

        $this->browse(fn (Browser $browser) => $browser
            ->loginAs($user->id)
            ->visit(new ProfileEdit($user))
        );
    }
}
