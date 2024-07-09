<?php

namespace App\Services\Admin;

use App\Models\Page;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

final class PageAdminService
{
    /** Update the given page model with the given collection. */
    public static function update(Page $page, Collection $collection): bool
    {
        $blocks_array = $collection->only('blocks')->toArray();
        $page_array = $collection->except(['blocks']);

        $page_array_mutated = [];

        foreach ($page_array as $field => $value) {
            $key_formatted = strtolower(strval(preg_replace('/(?<!^)[A-Z]/', '_$0', $field)));
            $page_array_mutated[$key_formatted] = $value;
        }

        if (!$page->syncBlocks($blocks_array['blocks'] ?? [])) {
            Log::error('Failed to sync blocks for page: ' . strval($page->id));

            return false;
        }

        $page->fill($page_array_mutated);

        return $page->save();
    }
}
