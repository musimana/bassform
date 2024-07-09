<?php

namespace App\Http\Resources\Views\Admin\Blocks;

use App\Interfaces\Resources\Indexes\CollectionIndexInterface;
use App\Models\Block;
use App\Models\Page;
use Illuminate\Support\Collection;

final class AdminBlocksResource implements CollectionIndexInterface
{
    /** Instantiate the resource. */
    public function __construct(
        protected Collection $blocks = new Collection,
        protected Page $parent = new Page
    ) {}

    /**
     * Get the resource's blocks collection.
     *
     * @return Collection<int, Block>
     */
    public function getCollection(): Collection
    {
        return $this->blocks;
    }

    /**
     *
     * @return array<int, array{
     *  id: int|false,
     *  type: string,
     *  data: array<string, array<int, string>|string>,
     *  schema: array{label: string, inputs: array<int, bool|int|string>}
     * }>
     */
    public function getItems(Collection $collection): array
    {
        return $collection->map(
            fn (Block $block) => (new AdminBlockResource($block))->getItem()
        )->toArray();
    }
}
