<?php

namespace App\Http\Resources\Views\Public\Blocks;

use App\Interfaces\Resources\Indexes\CollectionIndexInterface;
use App\Models\Block;
use Illuminate\Support\Collection;

final class BlocksResource implements CollectionIndexInterface
{
    /**
     * Get the content blocks array for the given block collections.
     *
     * @return array<int, array{type: string, data: array<string, array<int, string>|string>}>
     */
    public function getItems(Collection $collection): array
    {
        return $collection->map(
            fn (Block $block) => (new BlockResource($block))->getItem()
        )->toArray();
    }
}
