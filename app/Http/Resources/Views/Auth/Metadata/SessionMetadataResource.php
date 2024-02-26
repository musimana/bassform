<?php

namespace App\Http\Resources\Views\Auth\Metadata;

use App\Interfaces\Resources\Items\ConstantItemInterface;

class SessionMetadataResource implements ConstantItemInterface
{
    /**
     * Get the metadata array for the session's status.
     *
     * @return array<string, bool>
     */
    public function getItem(): array
    {
        return [
            'status' => session('status'),
        ];
    }
}
