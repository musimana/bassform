<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordUpdateRequest;
use Illuminate\Http\RedirectResponse;

final class ProfilePasswordController extends Controller
{
    /** Update the authenticated user's password. */
    public function update(PasswordUpdateRequest $request): RedirectResponse
    {
        $inputs = $request->validated();

        $request->user()->update([
            'password' => bcrypt($inputs['password']),
        ]);

        return back();
    }
}
