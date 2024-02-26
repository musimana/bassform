<?php

use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia as Assert;

/*
|--------------------------------------------------------------------------
| Expectation API Extention - toHaveCorrectPropsAuth
|--------------------------------------------------------------------------
|
| Method to extend Pest's Expectation API.
|
| Asserts that the given response has passed all of the expected props
| to the Vue page component correctly.
|
| `$response->dump();` is useful for debugging.
|
*/

expect()->extend('toHaveCorrectPropsAuth', function (
    string $template,
    array $content = [],
    array $metadata = []
) {
    (new TestResponse($this->value))
        ->assertInertia(fn (Assert $page) => $page
            ->component($template)
            ->has('content', count($content))
            ->has('metadata', fn (Assert $page) => $page
                ->where('canonical', $metadata['canonical'] ?? '')
                ->where('description', $metadata['description'] ?? '')
                ->where('keywords', $metadata['keywords'] ?? '')
                ->where('title', $metadata['title'] ?? '')
                ->etc()
            )
        );

    return $this;
});
