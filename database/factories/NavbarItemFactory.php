<?php

namespace Database\Factories;

use App\Models\Navbar;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NavbarItem>
 */
class NavbarItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /** @var string $title */
        $title = fake()->words(fake()->numberBetween(1, 5), true);
        $url = url(Str::slug($title));
        $navbar = Navbar::inRandomOrder()->first() ?? Navbar::factory()->create();
        $items_count = count($navbar->items);
        $display_order = $items_count ? $items_count + 1 : 0;

        return [
            'navbar_id' => $navbar->id,
            'title' => ucwords($title),
            'url' => $url,
            'display_order' => $display_order,
        ];
    }
}
