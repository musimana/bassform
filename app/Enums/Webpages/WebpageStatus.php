<?php

namespace App\Enums\Webpages;

enum WebpageStatus: int
{
    /* List of the webpage statuses available to the application. */
    case DRAFT = 1;
    case PUBLISHED = 2;

    /** Get the status's label. */
    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::PUBLISHED => 'Published',
        };
    }
}
