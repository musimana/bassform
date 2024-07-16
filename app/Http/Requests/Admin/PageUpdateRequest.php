<?php

namespace App\Http\Requests\Admin;

use App\Enums\Webpages\WebpageStatus;
use App\Interfaces\Requests\RequestInterface;
use Illuminate\Foundation\Http\FormRequest;

final class PageUpdateRequest extends FormRequest implements RequestInterface
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'blocks' => ['nullable', 'max:5120'],
            'title' => ['required', 'string', 'max:255'],
            'metaDescription' => ['nullable', 'string', 'max:255'],
            'webpageStatusId' => ['required', 'integer', 'max:' . WebpageStatus::PUBLISHED->value],
            'inSitemap' => ['required', 'boolean'],
        ];
    }
}
