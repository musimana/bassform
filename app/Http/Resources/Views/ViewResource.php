<?php

namespace App\Http\Resources\Views;

class ViewResource
{
    /**
     * Get the resource as an array.
     *
     * @param  array<string, mixed>  $content  = []
     * @param  array<string, mixed>  $metadata  = []
     * @return array<string, mixed>
     */
    public function get(array $content = [], array $metadata = []): array
    {
        return [
            'content' => $content,
            'metadata' => (new ViewMetadataResource)->get($metadata),
        ];
    }
}
