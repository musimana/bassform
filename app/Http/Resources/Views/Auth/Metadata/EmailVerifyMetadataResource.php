<?php

namespace App\Http\Resources\Views\Auth\Metadata;

use App\Interfaces\Resources\Items\ConstantItemInterface;

final class EmailVerifyMetadataResource implements ConstantItemInterface
{
    /**
     * Get the metadata array for the email verification page.
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
                'canonical' => route('verification.notice'),
                'description' => 'Verify the email address for your ' . config('app.name') . ' account.',
                'keywords' => '',
                'title' => 'Email Verification',
            ],
            (new SessionMetadataResource)->getItem()
        );
    }
}
