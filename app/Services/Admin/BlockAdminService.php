<?php

namespace App\Services\Admin;

use App\Models\Block;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;

final class BlockAdminService
{
    /**
     * Save the updated blocks and delete any existing blocks
     * which are missing from the new collection if supplied.
     *
     * Returns false on error or true otherwise.
     *
     * If the optional param is ommitted it behaves the same as
     * Laravel's syncWithoutDetaching for BelongsToMany relations.
     *
     * @param  Collection<int, Block>  $blocks_new
     * @param  EloquentCollection<int, Block>|null  $blocks_old  = null
     */
    public static function syncBlocks(Collection $blocks_new, ?EloquentCollection $blocks_old = null): bool
    {
        $blocks_old ??= new EloquentCollection;

        $outcomes = [
            ...$blocks_old->map(fn (Block $block) => $blocks_new->contains('id', $block->id) ?: $block->delete()),
            ...$blocks_new->map(fn (Block $block) => $block->save()),
        ];

        return (bool) !count(array_filter(
            $outcomes,
            fn (?bool $outcome) => !$outcome
        ));
    }
}
