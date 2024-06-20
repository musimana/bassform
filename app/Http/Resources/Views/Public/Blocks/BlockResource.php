<?php

namespace App\Http\Resources\Views\Public\Blocks;

use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Block;

final class BlockResource implements ConstantItemInterface
{
    /** Instantiate the resource. */
    public function __construct(
        protected Block $block = new Block
    ) {}

    /**
     * Get the content array for the resource's block.
     *
     * @return array{type: string, data: array<string, array<int, string>|string>}
     */
    public function getItem(): array
    {
        return [
            'type' => $this->block->getType()->value,
            'data' => $this->block->getData(),
        ];
    }
}
