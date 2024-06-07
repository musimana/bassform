<?php

namespace App\Http\Resources\Views\Auth\Metadata;

use App\Interfaces\Resources\Items\ConstantItemInterface;

final class SessionMetadataResource implements ConstantItemInterface
{
    /**
     * Get the metadata array for the session's status.
     *
     * @return array{status: bool}
     */
    public function getItem(): array
    {
        return [
            'status' => session('status'),
        ];
    }
}
