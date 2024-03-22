<?php

use Illuminate\Support\Str;

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
    $session_cookie_name = Str::slug(config('app.name'), '_') . '_session';

    $regex_date = '\w{3}, \d{2} \w{3} \d{4} \d{2}:\d{2}:\d{2} \w{3}';
    $regex_xsrf_token = 'XSRF-TOKEN\=.+;\sexpires\=' . $regex_date . ';\sMax-Age\=7200;\spath\=\/;\ssamesite=lax';
    $regex_session_cookie = $session_cookie_name . '\=.+;\sexpires\=' . $regex_date . ';\sMax-Age\=7200;\spath\=\/;\shttponly;\ssamesite=lax';

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
        ->toMatch('/' . $regex_date . '/');

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
        ->toMatch('/' . $regex_xsrf_token . '/');

    expect($this->value['set-cookie'][1])
        ->toBeString()
        ->toMatch('/' . $regex_session_cookie . '/');

    return $this;
});
