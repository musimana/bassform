<?php

namespace App\Traits;

use App\Http\Resources\Views\Admin\Blocks\AdminBlocksResource;
use App\Models\Block;
use App\Services\Admin\BlockAdminService;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasContentBlocks
{
    /**
     * The relationship for the resource's content blocks.
     *
     * @return HasMany<Block>
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class, 'parent_id')
            ->where('parent_type', self::class)
            ->orderBy('display_order');
    }

    /**
     * Sync the given content blocks array with the model's blocks.
     *
     * @param  array<int, array{
     *  id: int|false,
     *  type: string,
     *  data: array<string, array<int, string>|string>,
     *  schema: array{label: string, inputs: array<int, array<string, bool|int|string>>}
     * }>|null  $blocks_array
     */
    public function syncBlocks(?array $blocks_array): bool
    {
        $resource = new AdminBlocksResource(collect(), $this);
        $resource->setItems($blocks_array ?? []);

        return BlockAdminService::syncBlocks(
            $resource->getCollection(),
            $this->blocks
        );
    }
}
