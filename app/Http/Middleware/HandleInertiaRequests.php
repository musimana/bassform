<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

final class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $cookies_acknowledged = session('cookies.acknowledged', false) || $request->cookie('consent-storage-granted', null);

        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'cookies' => [
                'acknowledged' => $cookies_acknowledged,
            ],
            'flash' => [
                'status' => session('status'),
                'output' => session('output'),
            ],
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];
    }
}
