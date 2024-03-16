<?php

namespace App\Http\Resources\Views\Auth\Metadata;

use App\Interfaces\Resources\Items\ConstantItemInterface;

final class PasswordConfirmMetadataResource implements ConstantItemInterface
{
    /**
     * Get the metadata array for the password confirmation page.
     *
     * @return array<string, string>
     */
    public function getItem(): array
    {
        return [
            'canonical' => route('password.confirm'),
            'description' => 'Confirm your password for ' . config('app.name') . ' to continue.',
            'keywords' => '',
            'title' => 'Confirm Password',
        ];
    }
}
