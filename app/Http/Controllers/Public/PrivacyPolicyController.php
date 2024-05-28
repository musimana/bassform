<?php

namespace App\Http\Controllers\Public;

use App\Enums\Webpages\WebpageTemplate;
use App\Http\Controllers\Controller;
use App\Http\Resources\Views\Public\Content\PageContentResource;
use App\Http\Resources\Views\Public\Metadata\PageMetadataResource;
use App\Models\Page;
use App\Repositories\Views\PublicViewRepository;
use Inertia\Response;

final class PrivacyPolicyController extends Controller
{
    /** Display the public privacy policy page. */
    public function __invoke(): Response
    {
        $page = Page::where('slug', 'privacy')->first() ?? Page::factory()->privacyPage()->make();
        $template = $page?->template ?? WebpageTemplate::PUBLIC_CONTENT->value;

        return (new PublicViewRepository)->getViewDetails(
            $template,
            (new PageContentResource)->getItem($page),
            (new PageMetadataResource)->getItem($page)
        );
    }
}
