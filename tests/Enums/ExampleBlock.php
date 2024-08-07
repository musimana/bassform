<?php

namespace Tests\Enums;

use App\Enums\Blocks\BlockType;
use App\Models\Block;

enum ExampleBlock: string
{
    /* List of the example content blocks available for tests. */
    case HEADER_LOGO = 'header-logo';
    case PANEL_LINKS = 'panel-links';
    case PRIVACY_POLICY = 'privacy-policy';
    case SECTION_DIVIDER = 'section-divider';
    case STACK = 'stack';
    case TABS = 'tabs';
    case WYSIWYG = 'wysiwyg';
    case UNKNOWN = 'unknown';

    /**
     * Get an array of the block type's static data.
     *
     * @return array<string, array<int, array<string, string>|string>|string>|null
     */
    public function exampleData(): ?array
    {
        return match ($this) {
            self::HEADER_LOGO => [
                'heading' => 'Heading',
                'subheading' => 'Sub-Heading',
            ],
            self::PANEL_LINKS => [
                'title' => 'Panel Links Title',
                'items' => [
                    [
                        'title' => 'Panel 1 Title',
                        'description' => 'Panel 1 Title Description',
                        'url' => 'http://example.com',
                    ],
                    [
                        'title' => 'Panel 2 Title',
                        'description' => 'Panel 2 Title Description',
                        'url' => 'http://example.com/test',
                    ],
                ],
            ],
            self::TABS => [
                'tabs' => ['Tab One', 'Tab Two'],
                'tabContents' => ['<p>Tab one content.</p>', '<p>Tab two content.</p>'],
            ],
            self::WYSIWYG => ['html' => '<p>test</p>'],
            self::UNKNOWN => BlockType::from($this->value)->staticData(),
            default => null,
        };
    }

    /** Get a JSON encoded string of the block type's static data. */
    public function exampleDataJson(): ?string
    {
        $data = $this->exampleData();

        return $data !== null
            ? (string) json_encode($data)
            : null;
    }

    /**
     * Get an array of the block type's expected data.
     *
     * @return array{
     *  type: string,
     *  data: array<string, array<int, array<string, string>|string>|string>|null,
     * }
     */
    public function expectedData(): array
    {
        return [
            'type' => $this->value,
            'data' => $this->exampleData(),
        ];
    }

    /** Get a stored example block model of this block's type. */
    public function exampleModel(?string $parent_type = null, ?int $parent_id = null): Block
    {
        $attributes = $parent_type && $parent_id
            ? [
                'parent_type' => $parent_type,
                'parent_id' => $parent_id,
            ]
            : [];

        return Block::factory()->type(
            BlockType::from($this->value),
            $this->exampleDataJson(),
        )->create($attributes);
    }

    /** Get an unstored example block model of this block's type. */
    public function exampleModelGhost(): Block
    {
        return Block::factory()->type(
            BlockType::from($this->value),
            $this->exampleDataJson(),
        )->make();
    }
}
