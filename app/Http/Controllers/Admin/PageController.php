<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Webpages\WebpageTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageUpdateRequest;
use App\Http\Resources\Views\Admin\Pages\CreateEditPageResource;
use App\Http\Resources\Views\Public\Metadata\PageMetadataResource;
use App\Models\Page;
use App\Repositories\Views\AdminViewRepository;
use App\Services\Admin\PageAdminService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class PageController extends Controller
{
    /**
     * Display the edit view for the given page.
     *
     * @throws HttpException
     */
    public function edit(Page $page): Response
    {
        return (new AdminViewRepository)
            ->getViewCreateEdit(
                WebpageTemplate::ADMIN_CREATE_EDIT->value,
                (new CreateEditPageResource)->getItem($page),
                (new PageMetadataResource)->getItem($page)
            );
    }

    /**
     * Update the given page model with the given request.
     *
     * @throws HttpException
     */
    public function update(PageUpdateRequest $request, Page $page): RedirectResponse
    {
        if (!PageAdminService::update($page, collect($request->safe()))) {
            throw new HttpException(500, 'Failed to update page.');
        }

        return to_route('admin.page.edit', $page);
    }
}
