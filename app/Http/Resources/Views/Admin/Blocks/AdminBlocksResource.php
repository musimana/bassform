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
     * Get the resource's blocks collection as an array.
     *
     * @return array<int, array{
     *  id: int|false,
     *  type: string,
     *  data: array<string, array<int, string>|string>,
     *  schema: array{label: string, inputs: array<int, bool|int|string>}
     * }>
     */
    public function getItems(): array
    {
        return $this->blocks->map(
            fn (Block $block) => (new AdminBlockResource($block))->getItem()
        )->toArray();
    }

    /**
     * Set the resource's blocks collection to match the given blocks array.
     *
     * @param  array<int, array{
     *  id: int|false,
     *  type: string,
     *  data: array<string, array<int, string>|string>|string,
     *  schema: array{label: string, inputs: array<int, array<string, bool|int|string>>}
     * }>  $blocks_array  = []
     */
    public function setItems(array $blocks_array = []): void
    {
        $this->blocks = collect();

        foreach ($blocks_array as $display_order => $block_array) {
            $data = is_array($block_array['data']) ? $block_array['data'] : [];

            $this->blocks->push(
                (new AdminBlockResource(new Block([
                    'id' => $block_array['id'],
                    'parent_type' => $this->parent::class,
                    'parent_id' => $this->parent->id,
                    'type' => $block_array['type'],
                    'display_order' => $display_order,
                ])))->getModel($data)
            );
        }
    }
}
