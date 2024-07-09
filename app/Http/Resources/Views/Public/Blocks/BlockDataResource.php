<?php

namespace App\Http\Resources\Views\Public\Blocks;

use App\Enums\Blocks\BlockType;
use App\Interfaces\Resources\Formatters\ItemToJsonFormatterInterface;

final class BlockDataResource implements ItemToJsonFormatterInterface
{
    /** Instantiate the resource. */
    public function __construct(
        protected BlockType $block_type,
        /** @var array<string, array<int, array<string, string>|string>|string>|null $data */
        protected ?array $data
    ) {}

    public function getValue(): ?string
    {
        return $this->data
            ? (json_encode($this->data) ?: null)
            : null;
    }

    /** Get the validated JSON string of the block's data. */
    public function getJsonValidated(): ?string
    {
        $schema = $this->block_type->schema();

        if ($this->block_type === BlockType::UNKNOWN || $schema['inputsRepeatable']) {
            return $this->data ? (string) json_encode($this->data) : null;
        }

        $validated = [];

        foreach ($schema['inputs'] as $input) {
            $field = (string) $input['field'];
            $validated[$field] = $this->data[$field] ?? [];
        }

        $this->data = $validated;

        return $this->getValue();
    }
}
