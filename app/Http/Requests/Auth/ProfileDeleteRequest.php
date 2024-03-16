<?php

namespace App\Http\Requests\Auth;

use App\Interfaces\Requests\RequestInterface;
use Illuminate\Foundation\Http\FormRequest;

final class ProfileDeleteRequest extends FormRequest implements RequestInterface
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'password' => ['required', 'string', 'current_password'],
        ];
    }
}
