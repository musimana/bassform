<?php

namespace App\Interfaces\Resources\Storables;

interface StringsToStringStorableInterface
{
    /** Get a formatted string from the given strings. */
    public static function getValue(string $string1, string $string2): string;

    /** Store & return a formatted string from the given strings. */
    public static function storeValue(string $string1, string $string2): string;
}
