<?php

namespace App\Http\Resources\Views;

use App\Interfaces\Resources\Items\ArraysToItemInterface;

final class DetailsViewResource implements ArraysToItemInterface
{
    /**
     * Get the resource as an array.
     *
     * @param  array<string, mixed>  $content  = []
     * @param  array<string, mixed>  $metadata  = []
     * @return array<string, mixed>
     */
    public function getItem(array $content = [], array $metadata = []): array
    {
        return [
            'content' => $content,
            'metadata' => (new MetadataViewResource)->getItem($metadata),
        ];
    }
}
