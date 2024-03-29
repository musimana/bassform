<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class ProfilePasswordController extends Controller
{
    /**
     * Update the authenticated user's password.
     *
     * @throws HttpException
     */
    public function update(PasswordUpdateRequest $request): RedirectResponse
    {
        if (!$request->user()) {
            abort(401);
        }

        $inputs = $request->validated();

        $request->user()->update([
            'password' => bcrypt($inputs['password']),
        ]);

        return back();
    }
}
