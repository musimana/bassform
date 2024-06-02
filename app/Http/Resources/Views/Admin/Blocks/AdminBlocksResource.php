<?php

namespace App\Http\Resources\Views\Admin\Blocks;

use App\Interfaces\Resources\Indexes\CollectionIndexInterface;
use App\Models\Block;
use Illuminate\Support\Collection;

final class AdminBlocksResource implements CollectionIndexInterface
{
    /**
     * Get the content blocks array for the given block collections.
     *
     * @return array<int, array<string, array<string, string>|int|string|false>>
     */
    public function getItems(Collection $collection): array
    {
        return $collection->map(
            fn (Block $block) => (new AdminBlockResource($block))->getItem()
        )->toArray();
    }
}
