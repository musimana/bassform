<?php

namespace App\Http\Controllers\Public;

use App\Enums\Webpages\WebpageTemplate;
use App\Http\Controllers\Controller;
use App\Http\Resources\Views\Public\Content\HomepageContentResource;
use App\Http\Resources\Views\Public\Metadata\HomepageMetadataResource;
use App\Repositories\Views\PublicViewRepository;
use Inertia\Response;

final class HomepageController extends Controller
{
    /** Display the public homepage. */
    public function __invoke(): Response
    {
        return (new PublicViewRepository)->getViewDetails(
            WebpageTemplate::PUBLIC_INDEX->value,
            (new HomepageContentResource)->getItem(),
            (new HomepageMetadataResource)->getItem()
        );
    }
}
