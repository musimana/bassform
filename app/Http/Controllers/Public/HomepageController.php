<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Content\HomepageContentResource;
use App\Repositories\Public\PublicViewRepository;
use Inertia\Response;

class HomepageController extends Controller
{
    const TEMPLATE_PUBLIC_INDEX = 'Public/PublicHomepage';

    /** Display the public homepage. */
    public function __invoke(): Response
    {
        return (new PublicViewRepository)->getPublicView(
            self::TEMPLATE_PUBLIC_INDEX,
            (new HomepageContentResource)->get()
        );
    }
}
