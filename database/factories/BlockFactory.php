<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Block>
 */
class BlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['stack', 'tabs']);
        $page = Page::inRandomOrder()->first() ?? Page::factory()->create();
        $blocks_count = count($page->blocks);
        $display_order = $blocks_count ? $blocks_count + 1 : 0;
        $data = $type === 'tabs' ? json_encode(['tabs' => ['Tab One', 'Tab Two']]) : null;

        return [
            'type' => $type,
            'parent_type' => Page::class,
            'parent_id' => $page->id,
            'display_order' => $display_order,
            'data' => $data,
        ];
    }
}
