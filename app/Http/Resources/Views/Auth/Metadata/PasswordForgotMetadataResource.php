<?php

namespace App\Http\Resources\Views\Auth\Metadata;

use App\Interfaces\Resources\Items\ConstantItemInterface;

final class PasswordForgotMetadataResource implements ConstantItemInterface
{
    /**
     * Get the metadata array for the password reset token request page.
     *
     * @return array{
     *  canonical: string,
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
                'canonical' => route('password.request'),
                'description' => 'Request a password reset token for your ' . config('app.name') . ' account.',
                'keywords' => '',
                'title' => 'Forgot Password',
            ],
            (new SessionMetadataResource)->getItem()
        );
    }
}
