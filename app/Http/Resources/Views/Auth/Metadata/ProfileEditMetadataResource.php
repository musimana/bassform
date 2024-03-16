<?php

namespace App\Http\Resources\Views\Auth\Metadata;

use App\Interfaces\Resources\Items\ConstantItemInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;

final class ProfileEditMetadataResource implements ConstantItemInterface
{
    /**
     * Get the metadata array for the edit profile page.
     *
     * @return array<string, bool|string>
     */
    public function getItem(): array
    {
        return array_merge(
            [
                'canonical' => route('profile.edit'),
                'description' => 'Review and update your ' . config('app.name') . ' account.',
                'keywords' => '',
                'mustVerifyEmail' => request()->user() instanceof MustVerifyEmail,
                'title' => 'Profile',
            ],
            (new SessionMetadataResource)->getItem()
        );
    }
}
