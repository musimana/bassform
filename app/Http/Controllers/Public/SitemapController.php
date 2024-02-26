<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Views\Sitemaps\SitemapPagesContentResource;
use App\Http\Resources\Views\Sitemaps\SitemapsContentResource;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SitemapController extends Controller
{
    const TEMPLATE_SITEMAP_INDEX = 'sitemaps/default';

    const TEMPLATE_SITEMAP_ITEMS = 'sitemaps/items';

    /** Get the view for the app's sitemap. */
    public function index(): View
    {
        $sitemaps = (new SitemapsContentResource)->getItems();

        return view(self::TEMPLATE_SITEMAP_INDEX, compact('sitemaps'));
    }

    /**
     * Display the given sitemap.
     *
     * @throws HttpException
     */
    public function show(string $sitemap): View
    {
        $matches = [];

        if ($sitemap === 'pages') {
            $items = (new SitemapPagesContentResource)->getItems();

            return view(self::TEMPLATE_SITEMAP_ITEMS, compact('items'));
        }

        abort(404);
    }
}
