<?php

namespace App\Http\Controllers\Public;

use App\Enums\Webpages\WebpageTemplate;
use App\Http\Controllers\Controller;
use App\Http\Resources\Views\Sitemaps\PagesSitemapResource;
use App\Http\Resources\Views\Sitemaps\SitemapResource;
use App\Repositories\Views\SitemapViewRepository;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class SitemapController extends Controller
{
    /** Get the view for the app's sitemap. */
    public function index(): View
    {
        return (new SitemapViewRepository)->getView(
            WebpageTemplate::SITEMAP_INDEX->value,
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
                WebpageTemplate::SITEMAP_ITEMS->value,
                (new PagesSitemapResource)->getItems()
            );
        }

        abort(404);
    }
}
