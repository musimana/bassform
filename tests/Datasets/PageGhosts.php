<?php

use App\Models\Page;

dataset('page-ghosts', function () {
    return [
        'new model' => [fn () => new Page],
        'page ghost min record' => [fn () => Page::factory()->make()],
        'page ghost max random record' => [fn () => Page::factory()->dummy()->make()],
        'page ghost draft' => [fn () => Page::factory()->draft()->make()],
        'homepage ghost' => [fn () => Page::factory()->dummy()->homePage()->make()],
        'privacy page ghost' => [fn () => Page::factory()->dummy()->privacyPage()->make()],
    ];
});
