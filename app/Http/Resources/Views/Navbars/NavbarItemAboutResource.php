<?php

namespace App\Http\Resources\Views\Navbars;

use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Page;

class NavbarItemAboutResource implements ConstantItemInterface
{
    /**
     * Get the items for the main public navbar's about page item.
     *
     * @return array<string, string>
     */
    public function getItem(): array
    {
        $about_page = Page::where('slug', 'about')->first();

        return $about_page
            ? [
                'title' => $about_page->getTitle(),
                'url' => $about_page->getUrl(),
            ]
            : [];
    }
}
