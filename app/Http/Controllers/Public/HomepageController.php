<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Views\Public\Content\HomepageContentResource;
use App\Http\Resources\Views\Public\Metadata\HomepageMetadataResource;
use App\Repositories\Views\PublicViewRepository;
use Inertia\Response;

final class HomepageController extends Controller
{
    const TEMPLATE_PUBLIC_INDEX = 'Public/PublicHomepage';

    /** Display the public homepage. */
    public function __invoke(): Response
    {
        return (new PublicViewRepository)->getViewDetails(
            self::TEMPLATE_PUBLIC_INDEX,
            (new HomepageContentResource)->getItem(),
            (new HomepageMetadataResource)->getItem()
        );
    }
}
