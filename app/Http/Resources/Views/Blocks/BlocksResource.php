<?php

namespace App\Http\Resources\Views\Blocks;

use App\Enums\Blocks\BlockType;
use App\Interfaces\Resources\Indexes\CollectionIndexInterface;
use App\Models\Block;
use Illuminate\Support\Collection;

final class BlocksResource implements CollectionIndexInterface
{
    /**
     * Get the content blocks array for the given block collections.
     *
     * @return array<int, array<int|string, mixed>>
     */
    public function getItems(Collection $collection): array
    {
        return $collection->map(
            fn (Block $block) => match ($block->type) {
                BlockType::STACK->value => (new StackBlockResource)->getItem(),
                default => $block->getDataArray() ?? [],
            }
        )->toArray();
    }
}
