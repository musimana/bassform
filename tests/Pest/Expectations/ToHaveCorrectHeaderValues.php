<?php

use App\Enums\Regex;

/*
|--------------------------------------------------------------------------
| Expectation API Extention - toHaveCorrectHeaderValues
|--------------------------------------------------------------------------
|
| Method to extend Pest's Expectation API.
|
| Asserts that the given HTTP headers array contains all of the expected
| values.
|
| `$response->dumpHeaders();` is useful for debugging.
|
*/

expect()->extend('toHaveCorrectHeaderValues', function () {
    $this
        ->toHaveKebabCaseKeys()
        ->toHaveKeys([
            'cache-control',
            'date',
            'content-type',
            'vary',
            'set-cookie',
        ]);

    expect($this->value['cache-control'])
        ->toBeArray()
        ->toHaveCount(1)
        ->toMatchArray(['no-cache, private']);

    expect($this->value['date'])
        ->toBeArray()
        ->toHaveCount(1);

    expect($this->value['date'][0])
        ->toBeString()
        ->toMatch(Regex::TIMESTAMP_COOKIE->value);

    expect($this->value['content-type'])
        ->toBeArray()
        ->toHaveCount(1)
        ->toMatchArray(['text/html; charset=UTF-8']);

    expect($this->value['vary'])
        ->toBeArray()
        ->toHaveCount(1)
        ->toMatchArray(['X-Inertia']);

    expect($this->value['set-cookie'])
        ->toBeArray()
        ->toHaveCount(2);

    expect($this->value['set-cookie'][0])
        ->toBeString()
        ->toMatch(Regex::cookieXsrf());

    expect($this->value['set-cookie'][1])
        ->toBeString()
        ->toMatch(Regex::cookieSession());

    return $this;
});
