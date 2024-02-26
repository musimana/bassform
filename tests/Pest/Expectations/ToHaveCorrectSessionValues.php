<?php

/*
|--------------------------------------------------------------------------
| Expectation API Extention - toHaveCorrectSessionValues
|--------------------------------------------------------------------------
|
| Method to extend Pest's Expectation API.
|
| Asserts that the given session array contains all of the expected values.
|
| `$response->dumpSession();` is useful for debugging.
|
*/

expect()->extend('toHaveCorrectSessionValues', function (string $url) {
    $this
        ->toBeArray()
        ->toHaveCount(3)
        ->toHaveKeys(['_token', '_previous', '_flash']);

    expect($this->value['_token'])
        ->toBeString()
        ->toHaveLength(40);

    expect($this->value['_previous'])
        ->toBeArray()
        ->toHaveCount(1)
        ->toMatchArray([
            'url' => $url,
        ]);

    expect($this->value['_flash'])
        ->toBeArray()
        ->toHaveCount(2)
        ->toMatchArray([
            'old' => [],
            'new' => [],
        ]);

    return $this;
});
