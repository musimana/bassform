<?php

namespace App\Http\Resources\Views\Auth\Metadata;

use App\Interfaces\Resources\Items\ConstantItemInterface;
use Illuminate\Support\Facades\Route;

final class ProfileCreateMetadataResource implements ConstantItemInterface
{
    /**
     * Get the metadata array for the user registration page.
     *
     * @return array{
     *  canonical: string,
     *  description: string,
     *  keywords: string,
     *  title: string,
     * }
     */
    public function getItem(): array
    {
        return [
            'canonical' => Route::has('register') ? route('register') : '',
            'description' => 'Register an account for ' . config('app.name') . ' to explore the solutions in more depth.',
            'keywords' => '',
            'title' => 'Register',
        ];
    }
}
