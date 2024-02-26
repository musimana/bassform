<?php

namespace App\Interfaces\Resources\Items;

interface ArraysToItemInterface
{
    /**
     * Get an item resource array from the given input arrays.
     *
     * @param  array<string, mixed>  $arr1
     * @param  array<string, mixed>  $arr2
     * @return array<string, mixed>
     */
    public function getItem(array $arr1, array $arr2): array;
}
