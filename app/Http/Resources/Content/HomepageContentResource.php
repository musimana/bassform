<?php

namespace App\Http\Resources\Content;

class HomepageContentResource
{
    /**
     * Get the resource as an array.
     *
     * @return array<string, string>
     */
    public function get(): array
    {
        return [
            'bodytext' => '<p>VILT stack template app with server-side rendering (SSR) & Pest, created by Musimana.</p>',
        ];
    }
}
