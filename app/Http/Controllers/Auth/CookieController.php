<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class CookieController extends Controller
{
    /** Store the cookie acknowledgement request on the session. */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'remember' => ['required', 'boolean'],
        ]);

        session(['cookies.acknowledged' => true]);

        return $request->input('remember')
            ? back()
                ->with('status', 'Success')
                ->cookie('consent-storage-granted', true, 60 * 24 * 365)
            : back()->with('status', 'Success');
    }
}
