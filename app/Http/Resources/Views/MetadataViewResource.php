<?php

namespace App\Http\Resources\Views;

use App\Http\Resources\Views\Navbars\DesktopNavbarResource;
use App\Http\Resources\Views\Navbars\MobileNavbarResource;
use App\Http\Resources\Views\Public\Formatters\CopyrightFormatterResource;
use App\Interfaces\Resources\Items\ArrayToItemInterface;
use Illuminate\Support\Facades\Route;

class MetadataViewResource implements ArrayToItemInterface
{
    /**
     * Get a view metadata array for a view by combining the given metadata with the
     * app's default metadata. Keys in the given metadata array will override keys in
     * the default metadata array.
     *
     * @param  array<string, mixed>  $metadata  = []
     * @return array<string, mixed>
     */
    public function getItem(array $metadata): array
    {
        $standard_metadata = [
            'appName' => config('app.name'),
            'canLogin' => Route::has('login'),
            'canonical' => route('home'),
            'canRegister' => Route::has('register'),
            'copyright' => (new CopyrightFormatterResource)->getValue(),
            'description' => config('metadata.description'),
            'links' => [
                'github' => config('metadata.social_links.github'),
            ],
            'navbarDesktop' => (new DesktopNavbarResource)->getItems(),
            'navbarMobile' => (new MobileNavbarResource)->getItems(),
            'title' => config('app.name'),
        ];

        return array_merge($standard_metadata, $metadata);
    }
}
