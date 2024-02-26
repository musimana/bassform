<?php

namespace App\Interfaces\Resources\Indexes;

interface ConstantIndexInterface
{
    /**
     * Get an array of item resource arrays for the static index.
     *
     * @return array<int, mixed>
     */
    public function getItems(): array;
}
