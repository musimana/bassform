<?php

namespace App\Http\Resources\Views\Auth\Metadata;

use App\Interfaces\Resources\Items\ConstantItemInterface;

final class DashboardMetadataResource implements ConstantItemInterface
{
    /**
     * Get the metadata array for the dashboard page.
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
            'canonical' => route('dashboard'),
            'description' => 'Account dashboard for your ' . config('app.name') . ' account.',
            'keywords' => '',
            'title' => 'Dashboard',
        ];
    }
}
