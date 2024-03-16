<?php

namespace App\Http\Requests\Auth;

use App\Interfaces\Requests\RequestInterface;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

final class ProfileStoreRequest extends FormRequest implements RequestInterface
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'min:14', 'confirmed'],
        ];
    }
}
