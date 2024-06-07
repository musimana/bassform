<?php

namespace App\Repositories\Views;

use Illuminate\Contracts\View\View;

final class SitemapViewRepository
{
    /**
     * Render the given template after injecting the given items array.
     *
     * @param  array<int, array{
     *  loc: string,
     *  lastmod: string,
     *  changefreq: string,
     *  priority: float
     * }|string>  $items  = []
     */
    public function getView(string $template, array $items = []): View
    {
        return view($template, compact('items'));
    }
}
