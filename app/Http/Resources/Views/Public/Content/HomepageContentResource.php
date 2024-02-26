<?php

namespace App\Http\Resources\Views\Public\Content;

use App\Interfaces\Resources\Items\ConstantItemInterface;

class HomepageContentResource implements ConstantItemInterface
{
    /**
     * Get the content array for the site's homepage.
     *
     * @return array<string, array<int, array<string, string>>|string>
     */
    public function getItem(): array
    {
        return [
            'heading' => 'Getting Started',
            'subheading' => '',
            'bodytext' => '<p>VILT stack template app with server-side rendering (SSR) & Pest, created by Musimana.</p>',
            'items' => [],
        ];
    }
}
