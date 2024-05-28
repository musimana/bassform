<?php

use App\Enums\Webpages\WebpageTemplate;

test('All WebpageTemplate template files exist', function (WebpageTemplate $template) {
    $this->assertFileExists($template->filepath());
})->with(fn () => WebpageTemplate::cases());
