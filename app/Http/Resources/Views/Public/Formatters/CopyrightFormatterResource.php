<?php

namespace App\Http\Resources\Views\Public\Formatters;

use App\Interfaces\Resources\Formatters\ConstantStringFormatterInterface;

final class CopyrightFormatterResource implements ConstantStringFormatterInterface
{
    /** Get the copyright message string for the site. */
    public function getValue(): string
    {
        return config('metadata.copyright');
    }
}
