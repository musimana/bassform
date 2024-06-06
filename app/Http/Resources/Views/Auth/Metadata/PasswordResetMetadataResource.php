<?php

namespace App\Http\Resources\Views\Auth\Metadata;

use App\Interfaces\Resources\Items\ConstantItemInterface;

final class PasswordResetMetadataResource implements ConstantItemInterface
{
    /**
     * Get the metadata array for the password reset page.
     *
     * @return array{
     *  canonical: string,
     *  description: string,
     *  email: string,
     *  keywords: string,
     *  title: string,
     *  token: object|string|null,
     * }
     */
    public function getItem(): array
    {
        return [
            'canonical' => route('password.reset', request()->route('token') ?? ''),
            'description' => 'Reset your ' . config('app.name') . ' account password.',
            'email' => request()->email,
            'keywords' => '',
            'title' => 'Reset Password',
            'token' => request()->route('token'),
        ];
    }
}
