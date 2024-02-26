<?php

namespace App\Http\Resources\Views;

use App\Interfaces\Resources\Items\ArraysToItemInterface;

class IndexViewResource implements ArraysToItemInterface
{
    /**
     * Get the public index content array for the given data arrays.
     *
     * @param  array<string, array<int, array<string, string>>|string>  $content
     * @param  array<string, mixed>  $metadata
     * @return array<string, array<string, mixed>>
     */
    public function getItem(array $content, array $metadata): array
    {
        return [
            'content' => $content,
            'metadata' => (new MetadataViewResource)->getItem($metadata),
        ];
    }
}
