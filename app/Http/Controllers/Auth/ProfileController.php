<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Webpages\WebpageTemplate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileDeleteRequest;
use App\Http\Requests\Auth\ProfileStoreRequest;
use App\Http\Requests\Auth\ProfileUpdateRequest;
use App\Http\Resources\Models\UserModelResource;
use App\Http\Resources\Views\Auth\Content\DashboardContentResource;
use App\Http\Resources\Views\Auth\Metadata\DashboardMetadataResource;
use App\Http\Resources\Views\Auth\Metadata\ProfileCreateMetadataResource;
use App\Http\Resources\Views\Auth\Metadata\ProfileEditMetadataResource;
use App\Models\User;
use App\Repositories\Views\AuthViewRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class ProfileController extends Controller
{
    /** Display the authenticated user's dashboard. */
    public function index(): Response
    {
        return (new AuthViewRepository)->getViewDetails(
            WebpageTemplate::PROFILE_DASHBOARD->value,
            (new DashboardContentResource)->getItem(),
            (new DashboardMetadataResource)->getItem()
        );
    }

    /** Display the registration view. */
    public function create(): RedirectResponse|Response
    {
        return auth()->check()
            ? to_route(config('metadata.user_homepage'))
            : (new AuthViewRepository)->getViewDetails(
                WebpageTemplate::AUTH_REGISTER->value,
                [],
                (new ProfileCreateMetadataResource)->getItem()
            );
    }

    /** Handle an incoming registration request. */
    public function store(ProfileStoreRequest $request): RedirectResponse
    {
        if (!auth()->check()) {
            /** @var User $user */
            $user = (new UserModelResource)->storeItem($request);

            event(new Registered($user));
            auth()->login($user);
        }

        return to_route(config('metadata.user_homepage'));
    }

    /** Display the authenticated user's profile form. */
    public function edit(): Response
    {
        return (new AuthViewRepository)->getViewDetails(
            WebpageTemplate::PROFILE_EDIT->value,
            [],
            (new ProfileEditMetadataResource)->getItem()
        );
    }

    /**
     * Update the authenticated user's profile information.
     *
     * @throws HttpException
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if (!$request->user()) {
            abort(401);
        }

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return to_route('profile.edit');
    }

    /**
     * Delete the authenticated user's account.
     *
     * @throws HttpException
     */
    public function destroy(ProfileDeleteRequest $request): RedirectResponse
    {
        if (!$user = $request->user()) {
            abort(401);
        }

        auth()->logout();

        $user->forceDelete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('home');
    }
}
