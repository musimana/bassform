<?php

namespace App\Http\Resources\Formatters;

use App\Interfaces\Resources\Formatters\ConstantStringFormatterInterface;

final class PhpVersionFormatterResource implements ConstantStringFormatterInterface
{
    /** Get the formatted string of the app's PHP version. */
    public function getValue(): string
    {
        $delimiter_position = strrpos(PHP_VERSION, '.');

        return $delimiter_position
            ? substr(PHP_VERSION, 0, $delimiter_position) . '.x'
            : PHP_VERSION;
    }
}
