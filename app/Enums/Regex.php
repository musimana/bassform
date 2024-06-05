<?php

namespace App\Enums;

use Illuminate\Support\Str;

enum Regex: string
{
    case TIMESTAMP_COOKIE = '/\w{3}, \d{2} \w{3} \d{4} \d{2}:\d{2}:\d{2} \w{3}/';

    /** Get the RegEx pattern string for the app's XSRF cookie. */
    public static function cookieXsrf(): string
    {
        return '/XSRF-TOKEN\=.+;\sexpires\='
            . self::valueWithoutRegexDelimiters(self::TIMESTAMP_COOKIE)
            . ';\sMax-Age\=7[0-29]{3};\spath\=\/;\ssamesite=lax/';
    }

    /** Get the RegEx pattern string for the app's session cookie. */
    public static function cookieSession(): string
    {
        $session_cookie_name = Str::slug(config('app.name'), '_') . '_session';

        return '/' . $session_cookie_name . '\=.+;\sexpires\='
            . self::valueWithoutRegexDelimiters(self::TIMESTAMP_COOKIE)
            . ';\sMax-Age\=7[0-29]{3};\spath\=\/;\shttponly;\ssamesite=lax/';
    }

    /** Get the inner regex pattern between the leading & trailing '/'. */
    public static function valueWithoutRegexDelimiters(self $regex): string
    {
        $delimiter_open = strpos($regex->value, '/');
        $delimiter_close = strrpos($regex->value, '/');

        if ($delimiter_open === 0 && $delimiter_close !== false && $delimiter_close !== 0) {
            return substr(
                substr($regex->value, 0, $delimiter_close),
                1
            );
        }

        return $regex->value;
    }
}
