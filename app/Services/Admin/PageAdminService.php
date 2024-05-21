<?php

namespace App\Services\Admin;

use App\Models\Page;
use Illuminate\Support\Collection;

final class PageAdminService
{
    /** Update the given page model with the given collection. */
    public static function update(Page $page, Collection $collection): bool
    {
        $page_array = $collection->except(['blocks']);

        $page_array_mutated = [];

        foreach ($page_array as $field => $value) {
            $key_formatted = strtolower(strval(preg_replace('/(?<!^)[A-Z]/', '_$0', $field)));
            $page_array_mutated[$key_formatted] = $value;
        }

        $page->fill($page_array_mutated);

        if (!$page->save()) {
            return false;
        }

        return true;
    }
}
