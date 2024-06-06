<?php

namespace App\Http\Resources\Views\Auth\Content;

use App\Http\Resources\Views\Auth\Summaries\CreateEditSummaryResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Page;

final class DashboardContentResource implements ConstantItemInterface
{
    /**
     * Get the content array for the site's homepage.
     *
     * @return array{items: array<int, array{content: string, title: string, url: string}>}
     */
    public function getItem(): array
    {
        $items = auth()->user()?->hasRole('admin') ? Page::get() : collect();

        return [
            'items' => $items
                ->map(fn ($page) => (new CreateEditSummaryResource)->getItem($page))
                ->toArray(),
        ];
    }
}
