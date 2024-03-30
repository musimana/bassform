<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Resources\Views\Public\Content\PageContentResource;
use App\Http\Resources\Views\Public\Metadata\PageMetadataResource;
use App\Models\Page;
use App\Repositories\Views\PublicViewRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class PageController extends Controller
{
    /**
     * Display the given page.
     *
     * @throws HttpException
     */
    public function show(Page $page): Response
    {
        if (!$page->template) {
            abort(404);
        }

        return (new PublicViewRepository)
            ->getViewDetails(
                $page->template,
                (new PageContentResource)->getItem($page),
                (new PageMetadataResource)->getItem($page)
            );
    }

    /**
     * Handle the form data posted to the given page.
     *
     * @throws HttpException
     */
    public function store(Request $request, Page $page): RedirectResponse
    {
        if ($page->slug !== 'forms') {
            abort(404);
        }

        if ($request->validate([
            'checkbox' => ['required', 'boolean'],
            'date' => ['nullable', 'date'],
            'datetime' => ['nullable', 'date'],
            'select' => ['required', 'string'],
            'text' => ['required', 'string', 'max:255'],
            'textarea' => ['nullable', 'string'],
        ]));

        $response = $request->except('pdfUpload');

        if ($request->hasFile('pdfUpload')) {
            if ($request->validate([
                'pdfUpload' => ['file', 'mimes:pdf', 'max:5120'],
            ]));

            $files = $request->file('pdfUpload');

            if (!is_array($files)) {
                $files = [$files];
            }

            if (!$generated_filename = $files[0]?->store('uploads/pdf')) {
                Log::error('ERROR | Failed to store uploaded PDF file for request:', $response);

                abort(500, 'Failed to store uploaded PDF file');
            }

            $response['upload'] = 'Stored as ' . $generated_filename;
        }

        return back()
            ->with('status', 'Success')
            ->with('output', $response);
    }
}
