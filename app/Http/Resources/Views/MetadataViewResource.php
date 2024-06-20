<?php

namespace App\Http\Resources\Views;

use App\Http\Resources\Formatters\CopyrightFormatterResource;
use App\Http\Resources\Views\Navbars\DesktopNavbarResource;
use App\Http\Resources\Views\Navbars\MobileNavbarResource;
use App\Interfaces\Resources\Items\ArrayToItemInterface;
use App\Models\Navbar;
use Illuminate\Support\Facades\Route;

final class MetadataViewResource implements ArrayToItemInterface
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
        $navbar = Navbar::with('items')->first();

        $standard_metadata = [
            'appName' => config('app.name'),
            'canLogin' => Route::has('login'),
            'canonical' => route('home'),
            'canRegister' => Route::has('register'),
            'copyright' => (new CopyrightFormatterResource)->getValue(),
            'description' => config('metadata.description'),
            'links' => config('metadata.social_links'),
            'navbarDesktop' => $navbar ? (new DesktopNavbarResource($navbar))->getItems() : [],
            'navbarMobile' => $navbar ? (new MobileNavbarResource($navbar))->getItems() : [],
            'title' => config('app.name'),
        ];

        return array_merge($standard_metadata, $metadata);
    }
}
