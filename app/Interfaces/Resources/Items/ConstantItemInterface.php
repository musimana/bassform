<?php

namespace App\Interfaces\Resources\Items;

interface ConstantItemInterface
{
    /**
     * Get an item resource array for a static item.
     *
     * @return array<string, mixed>
     */
    public function getItem(): array;
}
