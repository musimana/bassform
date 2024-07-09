<?php

namespace App\Interfaces\Resources\Indexes;

use Illuminate\Support\Collection;

interface VariableCollectionIndexInterface
{
    /**
     * Get the resource's collection.
     *
     * @return Collection<int, mixed>
     */
    public function getCollection(): Collection;

    /**
     * Get the resource's collection as an array.
     *
     * @return array<int, mixed>
     */
    public function getItems(): array;

    /**
     * Set resource's collection to match the given array.
     *
     * @param  array<int, mixed>  $array  = []
     */
    public function setItems(array $array = []): void;
}
