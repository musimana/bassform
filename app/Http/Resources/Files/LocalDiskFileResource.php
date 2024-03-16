<?php

namespace App\Http\Resources\Files;

use App\Interfaces\Resources\Storables\StringsToStringStorableInterface;
use Exception;
use Illuminate\Support\Facades\Storage;

final class LocalDiskFileResource implements StringsToStringStorableInterface
{
    /**
     * Get the content string of the given filepath if it exists or return the given
     * content string.
     */
    public static function getValue(string $filepath, string $disk = 'local', string $content = ''): string
    {
        return Storage::disk($disk)->get($filepath) ?? $content;
    }

    /**
     * Store the given content string at the given filepath if it doesn't exist &
     * return the content of the file.
     *
     * @throws Exception
     */
    public static function storeValue(string $filepath, string $disk = 'local', string $content = ''): string
    {
        $content = self::getValue($filepath, $disk, $content);

        if (!Storage::disk($disk)->put($filepath, trim($content) . "\n")) {
            throw new Exception('ERROR | Failed to store file for ' . $filepath);
        }

        return $content;
    }
}
