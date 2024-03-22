<?php

use Illuminate\Testing\TestResponse;

/*
|--------------------------------------------------------------------------
| Expectation API Extention - toHaveCorrectHtmlHead
|--------------------------------------------------------------------------
|
| Method to extend Pest's Expectation API.
|
| Asserts that the given response contains all of the expected HTML <head>
| tag elements in the correct order.
|
| `$response->dump();` is useful for debugging.
|
*/

expect()->extend('toHaveCorrectHtmlHead', function (string $template) {
    $this->getContent()
        ->toBeString();

    (new TestResponse($this->value))
        ->assertSeeInOrder([
            '<!DOCTYPE html>',
            '<html lang="en" class="dark">',
            '<head>',
            '<meta charset="utf-8">',
            '<meta name="viewport" content="width=device-width, initial-scale=1">',
            '<title inertia>' . htmlspecialchars(config('app.name')) . '</title>',
            '<meta name="description" content="' . htmlspecialchars(config('metadata.description')) . '" inertia />',
            '<meta name="canonical" content="' . route('home') . '" inertia />',
            '<base href="' . route('home') . '">',
            '<meta name="robots" content="index, follow" />',
            '<meta name="author" content="' . htmlspecialchars(config('metadata.author')) . '" />',
            '<!-- Icons -->',
            '<link rel="icon" href="/favicon.ico" type="image/x-icon" />',
            '<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />',
            '<!-- Fonts -->',
            '<link rel="preconnect" href="https://fonts.bunny.net">',
            '<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />',
            '<!-- Scripts -->',
            '<script type="text/javascript">',
            'Ziggy',
            '</script>',
            '<script type="module" src="http://[::1]:',
            '/@vite/client"></script>',
            '<script type="module" src="http://[::1]:',
            '/resources/js/app.js"></script>',
            '<script type="module" src="http://[::1]:',
            '/resources/js/Pages/' . $template . '.vue"></script>',
            '</head>',
        ], false);

    return $this;
});
