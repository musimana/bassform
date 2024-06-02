<?php

namespace Database\Factories;

use App\Models\Navbar;
use App\Traits\FakesDatabaseValues;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NavbarItem>
 */
final class NavbarItemFactory extends Factory
{
    use FakesDatabaseValues;

    /**
     * Define the model's default state.
     *
     * @return array<string, int|string>
     */
    public function definition(): array
    {
        $title = $this->getFakeString(1, 3);
        $url = url(Str::slug($title));
        $navbar = Navbar::inRandomOrder()->first() ?? Navbar::factory()->create();
        $items_count = count($navbar->items);
        $display_order = $items_count ? $items_count : 0;

        return [
            'navbar_id' => $navbar->id,
            'title' => ucwords($title),
            'url' => $url,
            'display_order' => $display_order,
        ];
    }
}
