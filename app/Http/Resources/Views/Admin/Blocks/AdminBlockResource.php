<?php

namespace App\Http\Resources\Views\Admin\Blocks;

use App\Http\Resources\Views\Public\Blocks\BlockResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Block;

final class AdminBlockResource implements ConstantItemInterface
{
    /** Instantiate the resource. */
    public function __construct(
        protected Block $block = new Block
    ) {
    }

    /**
     * Get the content array for the resource's block.
     *
     * @return array{id: int|false, type: string, data: array<string, array<int, string>|string>, schema: array{label: string, inputs: array<int, bool|int|string>}}
     */
    public function getItem(): array
    {
        return array_merge(
            (new BlockResource($this->block))->getItem(),
            [
                'id' => $this->block->id ?? false,
                'schema' => $this->block->getType()->schema(),
            ],
        );
    }
}
