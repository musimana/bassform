<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Webpages\WebpageTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Views\Auth\Metadata\LoginMetadataResource;
use App\Repositories\Views\AuthViewRepository;
use App\Services\LogoutService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

final class AuthenticatedSessionController extends Controller
{
    /** Display the login view. */
    public function create(): RedirectResponse|Response
    {
        if (auth()->check()) {
            return to_route(config('metadata.user_homepage'));
        }

        return (new AuthViewRepository)->getViewDetails(
            WebpageTemplate::AUTH_LOGIN->value,
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

        return redirect()->intended(config('metadata.user_homepage'));
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
