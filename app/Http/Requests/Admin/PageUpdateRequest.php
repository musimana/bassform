<?php

namespace App\Http\Requests\Admin;

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
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string', 'max:5120'],
            'metaTitle' => ['nullable', 'string', 'max:255'],
            'metaDescription' => ['nullable', 'string', 'max:255'],
            'inSitemap' => ['required', 'boolean'],
        ];
    }
}
