<?php

namespace Database\Factories;

use App\Enums\BlockType;
use App\Models\Block;
use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Block>
 */
final class BlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(Block::typeValues());
        $page = Page::inRandomOrder()->first() ?? Page::factory()->create();
        $blocks_count = $page->blocks->count();
        $display_order = $blocks_count ? $blocks_count + 1 : 0;
        $data = $type === BlockType::TABS->value ? json_encode(['tabs' => ['Tab One', 'Tab Two']]) : null;

        return [
            'type' => $type,
            'parent_type' => Page::class,
            'parent_id' => $page->id,
            'display_order' => $display_order,
            'data' => $data,
        ];
    }
}
