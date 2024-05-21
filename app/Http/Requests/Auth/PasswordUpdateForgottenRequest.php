<?php

namespace App\Http\Requests\Auth;

use App\Interfaces\Requests\RequestInterface;
use Illuminate\Foundation\Http\FormRequest;

final class PasswordUpdateForgottenRequest extends FormRequest implements RequestInterface
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:14', 'max:255', 'confirmed'],
            'token' => ['required', 'string'],
        ];
    }
}
