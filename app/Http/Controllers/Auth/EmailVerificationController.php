<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Views\Auth\Metadata\EmailVerifyMetadataResource;
use App\Repositories\Views\AuthViewRepository;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

final class EmailVerificationController extends Controller
{
    const TEMPLATE_EMAIL_VERIFY = 'Auth/AuthEmailVerify';

    /** Display the email verification prompt. */
    public function show(): RedirectResponse|Response
    {
        return request()->user()?->hasVerifiedEmail()
            ? redirect()->intended(config('metadata.user_homepage'))
            : (new AuthViewRepository)->getViewDetails(
                self::TEMPLATE_EMAIL_VERIFY,
                [],
                (new EmailVerifyMetadataResource)->getItem()
            );
    }

    /** Send a new email verification notification, after a manual request by the user. */
    public function store(): RedirectResponse
    {
        if (request()->user()?->hasVerifiedEmail()) {
            return redirect()->intended(config('metadata.user_homepage'));
        }

        request()->user()?->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }

    /** Mark the authenticated user's email address as verified. */
    public function edit(EmailVerificationRequest $request): RedirectResponse
    {
        if (!$request->user()?->hasVerifiedEmail() && $request->user()?->markEmailAsVerified()) {
            /** @var MustVerifyEmail $user */
            $user = $request->user();
            event(new Verified($user));
        }

        return redirect()->intended(config('metadata.user_homepage') . '?verified=1');
    }
}
