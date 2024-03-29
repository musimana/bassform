<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ProfileDeleteRequest;
use App\Http\Requests\Auth\ProfileStoreRequest;
use App\Http\Requests\Auth\ProfileUpdateRequest;
use App\Http\Resources\Models\UserModelResource;
use App\Http\Resources\Views\Auth\Metadata\DashboardMetadataResource;
use App\Http\Resources\Views\Auth\Metadata\ProfileCreateMetadataResource;
use App\Http\Resources\Views\Auth\Metadata\ProfileEditMetadataResource;
use App\Models\User;
use App\Repositories\Views\AuthViewRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;

final class ProfileController extends Controller
{
    const TEMPLATE_DASHBOARD = 'Profile/ProfileDashboard';

    const TEMPLATE_PROFILE_EDIT = 'Profile/ProfileEdit';

    const TEMPLATE_REGISTER = 'Auth/AuthRegister';

    /** Display the authenticated user's dashboard. */
    public function index(): Response
    {
        return (new AuthViewRepository)->getViewDetails(
            self::TEMPLATE_DASHBOARD,
            [],
            (new DashboardMetadataResource)->getItem()
        );
    }

    /** Display the registration view. */
    public function create(): RedirectResponse|Response
    {
        return auth()->check()
            ? to_route(config('metadata.user_homepage'))
            : (new AuthViewRepository)->getViewDetails(
                self::TEMPLATE_REGISTER,
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
            self::TEMPLATE_PROFILE_EDIT,
            [],
            (new ProfileEditMetadataResource)->getItem()
        );
    }

    /** Update the authenticated user's profile information. */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return to_route('profile.edit');
    }

    /** Delete the authenticated user's account. */
    public function destroy(ProfileDeleteRequest $request): RedirectResponse
    {
        $user = $request->user();

        auth()->logout();

        $user->forceDelete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('home');
    }
}
