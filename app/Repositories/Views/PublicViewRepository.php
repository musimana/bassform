<?php

namespace App\Repositories\Views;

use App\Http\Resources\Views\DetailsViewResource;
use Inertia\Inertia;
use Inertia\Response;

final class PublicViewRepository
{
    /**
     * Render the given template after injecting the given data arrays.
     *
     * @param  array<string, mixed>  $content  = []
     * @param  array<string, mixed>  $metadata  = []
     */
    public function getViewDetails(string $template, array $content = [], array $metadata = []): Response
    {
        return Inertia::render(
            $template,
            (new DetailsViewResource)->getItem($content, $metadata)
        );
    }
}
