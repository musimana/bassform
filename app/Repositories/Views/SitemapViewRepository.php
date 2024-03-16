<?php

namespace App\Repositories\Views;

use Illuminate\Contracts\View\View;

class SitemapViewRepository
{
    /**
     * Render the given template after injecting the given items array.
     *
     * @param  array<int, array<string, int|string>|string>  $items  = []
     */
    public function getView(string $template, array $items = []): View
    {
        return view($template, compact('items'));
    }
}
