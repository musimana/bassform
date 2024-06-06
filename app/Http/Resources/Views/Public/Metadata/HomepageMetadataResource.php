<?php

namespace App\Http\Resources\Views\Public\Metadata;

use App\Interfaces\Resources\Items\ConstantItemInterface;
use Illuminate\Support\Facades\Vite;

final class HomepageMetadataResource implements ConstantItemInterface
{
    /**
     * Get the metadata array for the site homepage.
     *
     * @return array{openGraphImage: string}
     */
    public function getItem(): array
    {
        return [
            'openGraphImage' => Vite::asset(config('metadata.open_graph_image')),
        ];
    }
}
