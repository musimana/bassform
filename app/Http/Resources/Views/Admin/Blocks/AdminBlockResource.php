<?php

namespace App\Http\Resources\Views\Admin\Blocks;

use App\Http\Resources\Views\Public\Blocks\BlockDataResource;
use App\Http\Resources\Views\Public\Blocks\BlockResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Block;

final class AdminBlockResource implements ConstantItemInterface
{
    /** Instantiate the resource. */
    public function __construct(
        protected Block $block = new Block
    ) {}

    /**
     * Get the content array for the resource's block.
     *
     * @return array{
     *  id: int|false,
     *  type: string,
     *  data: array<string, array<int, string>|string>,
     *  schema: array{label: string, inputs: array<int, array<string, bool|int|string>>}
     * }
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

    /**
     * Get the content array for the resource's block.
     *
     * @param  array<string, array<int, array<string, string>|string>|string>|null  $data  = null
     */
    public function getModel(?array $data = null): Block|false
    {
        return $this->block = $this->block->fill([
            'data' => (new BlockDataResource($this->block->getType(), $data))->getJsonValidated(),
        ]);
    }
}
