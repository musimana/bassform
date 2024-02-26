<?php

namespace App\Http\Resources\Views\Auth\Metadata;

use App\Interfaces\Resources\Items\ConstantItemInterface;

class EmailVerifyMetadataResource implements ConstantItemInterface
{
    /**
     * Get the metadata array for the email verification page.
     *
     * @return array<string, bool|string>
     */
    public function getItem(): array
    {
        return array_merge(
            [
                'canonical' => route('verification.notice'),
                'description' => 'Verify the email address for your ' . config('app.name') . ' account.',
                'keywords' => '',
                'title' => 'Email Verification',
            ],
            (new SessionMetadataResource)->getItem()
        );
    }
}
