<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Views\Public\Content\HomepageContentResource;
use App\Http\Resources\Views\Public\Metadata\HomepageMetadataResource;
use App\Repositories\Views\PublicViewRepository;
use Inertia\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class HomepageController extends Controller
{
    /**
     * Display the public homepage.
     *
     * @throws HttpException
     */
    public function __invoke(): Response
    {
        $content_resource = new HomepageContentResource;

        if (!$template = $content_resource->getTemplate()) {
            abort(404);
        }

        return (new PublicViewRepository)->getViewDetails(
            $template->value,
            $content_resource->getItem(),
            (new HomepageMetadataResource)->getItem()
        );
    }
}
