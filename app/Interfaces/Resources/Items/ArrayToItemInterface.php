<?php

namespace App\Interfaces\Resources\Items;

interface ArrayToItemInterface
{
    /**
     * Get an item resource array from the given array.
     *
     * @param  array<string, mixed>  $arr
     * @return array<string, mixed>
     */
    public function getItem(array $arr): array;
}
