<?php

namespace App\Http\Resources\Views\Public\Content;

use App\Http\Resources\Views\Public\Summaries\PageSummaryResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Page;

class HomepageContentResource implements ConstantItemInterface
{
    /**
     * Get the content array for the site's homepage.
     *
     * @return array<string, array<int, array<string, string>>|string>
     */
    public function getItem(): array
    {
        $items = Page::whereNot('slug', 'about')->get();

        return [
            'heading' => config('app.name'),
            'bodytext' => '<p class="mb-8">' . config('metadata.description') . '</p>',
            'items' => $items
                ->map(fn ($page) => (new PageSummaryResource)->getItem($page))
                ->toArray(),
        ];
    }
}
