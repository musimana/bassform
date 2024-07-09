<?php

namespace App\Interfaces\Resources\Formatters;

interface ItemToJsonFormatterInterface
{
    /** Get the current JSON string for the resource. */
    public function getValue(): ?string;

    /** Get the validated JSON string for the resource. */
    public function getJsonValidated(): ?string;
}
