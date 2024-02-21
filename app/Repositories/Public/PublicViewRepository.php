<?php

namespace App\Repositories\Public;

use App\Http\Resources\Views\ViewResource;
use Inertia\Inertia;
use Inertia\Response;

class PublicViewRepository
{
    /**
     * Render the given template after injecting the given data arrays.
     *
     * @param  array<string, mixed>  $content  = []
     * @param  array<string, mixed>  $metadata  = []
     */
    public function getPublicView(string $template, array $content = [], array $metadata = []): Response
    {
        return Inertia::render(
            $template,
            (new ViewResource)->get($content, $metadata)
        );
    }
}
