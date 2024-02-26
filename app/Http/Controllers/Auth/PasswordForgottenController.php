<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetLinkRequest;
use App\Http\Requests\Auth\PasswordUpdateForgottenRequest;
use App\Http\Resources\Views\Auth\Metadata\PasswordForgotMetadataResource;
use App\Http\Resources\Views\Auth\Metadata\PasswordResetMetadataResource;
use App\Repositories\Views\AuthViewRepository;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Response;

class PasswordForgottenController extends Controller
{
    const TEMPLATE_PASSWORD_FORGOT = 'Auth/AuthPasswordForgot';

    const TEMPLATE_PASSWORD_RESET = 'Auth/AuthPasswordReset';

    /** Display the password reset link request view. */
    public function create(): Response
    {
        return (new AuthViewRepository)->getViewDetails(
            self::TEMPLATE_PASSWORD_FORGOT,
            [],
            (new PasswordForgotMetadataResource)->getItem()
        );
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws ValidationException
     */
    public function store(PasswordResetLinkRequest $request): RedirectResponse
    {
        $inputs = $request->validated();
        $status = Password::sendResetLink(['email' => $inputs['email']]);

        if ($status == Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    /** Display the password reset view. */
    public function edit(): Response
    {
        return (new AuthViewRepository)->getViewDetails(
            self::TEMPLATE_PASSWORD_RESET,
            [],
            (new PasswordResetMetadataResource)->getItem()
        );
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws ValidationException
     */
    public function update(PasswordUpdateForgottenRequest $request): RedirectResponse
    {
        $inputs = $request->validated();

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($inputs) {
                $user->forceFill([
                    'password' => bcrypt($inputs['password']),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
