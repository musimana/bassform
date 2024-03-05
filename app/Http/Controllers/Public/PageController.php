<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Views\Public\Content\PageContentResource;
use App\Http\Resources\Views\Public\Metadata\PageMetadataResource;
use App\Models\Page;
use App\Repositories\Views\PublicViewRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;

class PageController extends Controller
{
    /** Display the given page. */
    public function show(Page $page): Response
    {
        return (new PublicViewRepository)
            ->getViewDetails(
                $page->template,
                (new PageContentResource)->getItem($page),
                (new PageMetadataResource)->getItem($page)
            );
    }

    /** Display the given page. */
    public function store(Request $request, Page $page): RedirectResponse
    {
        if ($page->slug !== 'forms') {
            abort(404);
        }

        return back()
            ->with('status', 'Success')
            ->with('output', $request->all());
    }
}
