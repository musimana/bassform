<?php

namespace App\Http\Resources\Formatters;

use App\Interfaces\Resources\Formatters\ConstantStringFormatterInterface;
use Illuminate\Foundation\Application;

final class LaravelVersionFormatterResource implements ConstantStringFormatterInterface
{
    /** Get the formatted string of the app's Laravel version. */
    public function getValue(): string
    {
        $delimiter_position = strpos(Application::VERSION, '.');

        return $delimiter_position
            ? substr(Application::VERSION, 0, $delimiter_position) . '.x'
            : Application::VERSION;
    }
}
