<?php

namespace Database\Factories;

use App\Enums\Blocks\BlockType;
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
     * @return array<string, int|null|string>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(Block::typeValues());
        $page = Page::inRandomOrder()->first() ?? Page::factory()->create();
        $display_order = $page->blocks->count();

        return [
            'type' => $type,
            'parent_type' => Page::class,
            'parent_id' => $page->id,
            'display_order' => $display_order,
            'data' => null,
        ];
    }

    /** Indicate the type for the block model. */
    public function type(BlockType $block_type, ?string $json = null): static
    {
        return $this->state(fn (array $attributes) => array_merge([
            ...$attributes,
            'type' => $block_type->value,
            'data' => $json,
        ]));
    }
}
