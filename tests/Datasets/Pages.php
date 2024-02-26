<?php

use App\Models\Page;

dataset('pages', function () {
    return [
        'generic page' => [fn () => Page::factory()->create()],
        'about page' => [fn () => Page::factory()->create([
            'slug' => 'about',
            'title' => 'About',
            'subtitle' => config('app.name'),
            'content' => '',
        ])],
    ];
});
