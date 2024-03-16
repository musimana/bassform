<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Views\Sitemaps\PagesSitemapResource;
use App\Http\Resources\Views\Sitemaps\SitemapResource;
use App\Repositories\Views\SitemapViewRepository;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SitemapController extends Controller
{
    const TEMPLATE_SITEMAP_INDEX = 'sitemaps/default';

    const TEMPLATE_SITEMAP_ITEMS = 'sitemaps/items';

    /** Get the view for the app's sitemap. */
    public function index(): View
    {
        return (new SitemapViewRepository)->getView(
            self::TEMPLATE_SITEMAP_INDEX,
            (new SitemapResource)->getItems()
        );
    }

    /**
     * Display the given sitemap.
     *
     * @throws HttpException
     */
    public function show(string $sitemap): View
    {
        if ($sitemap === 'pages') {
            return (new SitemapViewRepository)->getView(
                self::TEMPLATE_SITEMAP_ITEMS,
                (new PagesSitemapResource)->getItems()
            );
        }

        abort(404);
    }
}
