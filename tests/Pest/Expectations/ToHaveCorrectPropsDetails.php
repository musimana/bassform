<?php

use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia as Assert;

/*
|--------------------------------------------------------------------------
| Expectation API Extention - toHaveCorrectPropsDetails
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

expect()->extend('toHaveCorrectPropsDetails', function (
    string $template,
    array $content = [],
    array $metadata = []
) {
    (new TestResponse($this->value))
        ->assertInertia(fn (Assert $page) => $page
            ->component($template)
            ->has('content', fn (Assert $page) => $page
                ->etc()
            )
            ->has('metadata', fn (Assert $page) => $page
                ->where('appName', $metadata['appName'] ?? '')
                ->where('canLogin', $metadata['canLogin'] ?? '')
                ->where('canonical', $metadata['canonical'] ?? '')
                ->where('canRegister', $metadata['canRegister'] ?? '')
                ->where('copyright', $metadata['copyright'] ?? '')
                ->where('description', $metadata['description'] ?? '')
                ->has('links', fn (Assert $page) => $page
                    ->where('github', $metadata['links']['github'] ?? '')
                )
                ->where('title', $metadata['title'] ?? '')
                ->etc()
            )
        );

    return $this;
});
