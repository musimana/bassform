<?php

namespace App\Http\Resources\Views\Auth\Metadata;

use App\Interfaces\Resources\Items\ConstantItemInterface;
use Illuminate\Support\Facades\Route;

final class LoginMetadataResource implements ConstantItemInterface
{
    /**
     * Get the metadata array for the login page.
     *
     * @return array{
     *  canonical: string,
     *  canResetPassword: bool,
     *  description: string,
     *  keywords: string,
     *  title: string,
     *  status: bool,
     * }
     */
    public function getItem(): array
    {
        return array_merge(
            [
                'canonical' => route('login'),
                'canResetPassword' => Route::has('password.request'),
                'description' => 'Login to your ' . config('app.name') . ' account to explore the solutions in more detail.',
                'keywords' => '',
                'title' => 'Login',
            ],
            (new SessionMetadataResource)->getItem()
        );
    }
}
