<?php

namespace App\Http\Resources\Views;

use Illuminate\Support\Facades\Route;

class ViewMetadataResource
{
    /**
     * Get a view metadata array for a view by combining the given metadata with the
     * app's default metadata. Keys in the given metadata array will override keys in
     * the default metadata array.
     *
     * @param  array<string, mixed>  $metadata  = []
     * @return array<string, mixed>
     */
    public function get(array $metadata): array
    {
        $standard_metadata = [
            'appName' => config('app.name'),
            'canLogin' => Route::has('login'),
            'canonical' => route('home'),
            'canRegister' => Route::has('register'),
            'copyright' => config('metadata.copyright'),
            'description' => config('metadata.description'),
            'github' => config('metadata.github'),
        ];

        return array_merge($standard_metadata, $metadata);
    }
}
