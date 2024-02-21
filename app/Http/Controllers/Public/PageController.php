<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Content\PageContentResource;
use App\Models\Page;
use App\Repositories\Public\PublicViewRepository;
use Inertia\Response;

class PageController extends Controller
{
    /** Display the given page. */
    public function show(Page $page): Response
    {
        return (new PublicViewRepository)
            ->getPublicView(
                $page->template,
                (new PageContentResource)->get()
            );
    }
}
