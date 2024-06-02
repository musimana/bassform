<?php

namespace App\Enums\Blocks;

enum BlockType: string
{
    /* List of the content blocks available to the application. */
    case STACK = 'stack';
    case TABS = 'tabs';
    case UNKNOWN = 'unknown';
}
