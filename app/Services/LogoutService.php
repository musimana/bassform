<?php

namespace App\Services;

use Illuminate\Http\RedirectResponse;

final class LogoutService
{
    /** Destroy an authenticated session. */
    public static function logout(): RedirectResponse
    {
        auth()->guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('home');
    }
}
