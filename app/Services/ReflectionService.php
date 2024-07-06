<?php

namespace App\Services;

use ReflectionClass;

final class ReflectionService
{
    /**
     * Get the class name for the given class.
     *
     * @param  class-string  $class
     */
    public static function getClassName(string $class): ?string
    {
        return (new ReflectionClass($class))->getShortName();
    }
}
