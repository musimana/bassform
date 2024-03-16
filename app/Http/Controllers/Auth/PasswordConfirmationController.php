<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Views\Auth\Metadata\PasswordConfirmMetadataResource;
use App\Providers\RouteServiceProvider;
use App\Repositories\Views\AuthViewRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Response;

final class PasswordConfirmationController extends Controller
{
    const TEMPLATE_PASSWORD_CONFIRM = 'Auth/AuthPasswordConfirm';

    /** Show the confirm password view. */
    public function show(): Response
    {
        return (new AuthViewRepository)->getViewDetails(
            self::TEMPLATE_PASSWORD_CONFIRM,
            [],
            (new PasswordConfirmMetadataResource)->getItem()
        );
    }

    /** Confirm the user's password. */
    public function store(Request $request): RedirectResponse
    {
        if (!Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()->put('auth.password_confirmed_at', time());

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
