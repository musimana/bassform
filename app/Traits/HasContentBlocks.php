<?php

namespace App\Traits;

use App\Models\Block;
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
}
