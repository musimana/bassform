<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Views\Auth\Metadata\LoginMetadataResource;
use App\Providers\RouteServiceProvider;
use App\Repositories\Views\AuthViewRepository;
use App\Services\LogoutService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

final class AuthenticatedSessionController extends Controller
{
    const TEMPLATE_LOGIN = 'Auth/AuthLogin';

    /** Display the login view. */
    public function create(): RedirectResponse|Response
    {
        if (auth()->check()) {
            return redirect(route('home'));
        }

        return (new AuthViewRepository)->getViewDetails(
            self::TEMPLATE_LOGIN,
            [],
            (new LoginMetadataResource)->getItem()
        );
    }

    /** Handle an incoming authentication request. */
    public function store(LoginRequest $request): RedirectResponse
    {
        if (!auth()->check()) {
            $request->authenticate();
            $request->session()->regenerate();
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /** Destroy an authenticated session via GET request. */
    public function edit(): RedirectResponse
    {
        return LogoutService::logout();
    }

    /** Destroy an authenticated session via POST request. */
    public function destroy(): RedirectResponse
    {
        return LogoutService::logout();
    }
}
