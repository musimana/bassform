<?php

namespace App\Interfaces\Resources\Formatters;

interface ConstantStringFormatterInterface
{
    /** Get the formatted string for the constant string value. */
    public function getValue(): string;
}
