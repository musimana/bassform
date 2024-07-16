<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Views\Public\Content\PrivacyPolicyContentResource;
use App\Repositories\Views\PublicViewRepository;
use Inertia\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class PrivacyPolicyController extends Controller
{
    /**
     * Display the public privacy policy page.
     *
     * @throws HttpException
     */
    public function __invoke(): Response
    {
        $content_resource = new PrivacyPolicyContentResource;

        if (!$template = $content_resource->getTemplate()) {
            abort(404);
        }

        return (new PublicViewRepository)->getViewDetails(
            $template->value,
            $content_resource->getItem(),
            $content_resource->getMetaData()
        );
    }
}
