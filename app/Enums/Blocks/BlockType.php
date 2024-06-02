<?php

namespace App\Enums\Blocks;

use App\Http\Resources\Formatters\LaravelVersionFormatterResource;
use App\Http\Resources\Formatters\PhpVersionFormatterResource;

enum BlockType: string
{
    /* List of the content blocks available to the application. */
    case STACK = 'stack';
    case TABS = 'tabs';
    case UNKNOWN = 'unknown';

    /**
     * Get an array of the block type's static data.
     *
     * @return array<string, string>
     */
    public function staticData(): array
    {
        return match ($this) {
            self::STACK => [
                'html' => view('partials.static-blocks.stack', [
                    'laravel_version' => (new LaravelVersionFormatterResource)->getValue(),
                    'php_version' => (new PhpVersionFormatterResource)->getValue(),
                ])->render(),
            ],
            self::UNKNOWN => ['html' => ''],
            default => [],
        };
    }
}
