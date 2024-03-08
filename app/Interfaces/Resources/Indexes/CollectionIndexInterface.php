<?php

namespace App\Interfaces\Resources\Indexes;

use Illuminate\Database\Eloquent\Collection;

interface CollectionIndexInterface
{
    /**
     * Get an array of item resource arrays for the static index.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getItems(Collection $collection): array;
}
