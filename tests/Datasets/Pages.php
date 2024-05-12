<?php

use App\Models\Page;

dataset('pages', function () {
    return [
        'generic page' => [fn () => Page::factory()->create()],
        'homepage' => [fn () => Page::factory()->homePage()->create()],
        'about page' => [fn () => Page::factory()->aboutPage()->create()],
    ];
});
