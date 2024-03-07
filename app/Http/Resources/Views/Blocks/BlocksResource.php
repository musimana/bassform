<?php

namespace App\Http\Resources\Views\Blocks;

use App\Models\Page;

class BlocksResource
{
    /**
     * Get the content blocks array for the blocks.
     *
     * @param  array<int, string>  $blocks
     * @return array<int, array<string, array<int, string>|string>>
     */
    public function getItems(array $blocks): array
    {
        $block_resources = [];

        foreach ($blocks as $block) {
            $resource = match ($block) {
                'stack' => (new StackBlockResource)->getItem(),
                'tabs' => (new TabsBlockResource)->getItem(Page::where('slug', 'controls')->first() ?? new Page),
                default => false,
            };

            if ($resource) {
                $block_resources[] = $resource;
            }
        }

        return $block_resources;
    }
}
