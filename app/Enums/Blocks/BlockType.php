<?php

namespace App\Enums\Blocks;

use App\Enums\Forms\FormInputType;
use App\Http\Resources\Formatters\LaravelVersionFormatterResource;
use App\Http\Resources\Formatters\PhpVersionFormatterResource;

enum BlockType: string
{
    /* List of the content blocks available to the application. */
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
     * @return array<string, string>
     */
    public function staticData(): array
    {
        return match ($this) {
            self::PRIVACY_POLICY => [
                'html' => view('partials.body.privacy')->render(),
            ],
            self::STACK => [
                'html' => view('partials.static-blocks.stack', [
                    'laravel_version' => (new LaravelVersionFormatterResource)->getValue(),
                    'php_version' => (new PhpVersionFormatterResource)->getValue(),
                ])->render(),
            ],
            self::UNKNOWN => ['html' => ''],
            default => [],
        };
    }

    /**
     * Get an array of the block type's schema.
     *
     * @return array{
     *  label: string,
     *  description: string,
     *  inputs: array<int, array<string, string>>,
     *  inputsRepeatable: array<int, array<string, string>>,
     * }
     */
    public function schema(): array
    {
        $block_schema = match ($this) {
            self::HEADER_LOGO => [
                'label' => 'Header with Logo',
                'inputs' => [
                    FormInputType::TEXT->schema('Heading', 'heading'),
                    FormInputType::TEXTAREA->schema('Sub-Heading', 'subheading'),
                ],
            ],
            self::PANEL_LINKS => [
                'label' => 'Panel Links',
                'inputs' => [
                    FormInputType::TEXT->schema('Title', 'title'),
                ],
                'inputsRepeatable' => [
                    FormInputType::TEXT->schema('Panel Title', 'title'),
                    FormInputType::TEXTAREA->schema('Panel Description', 'description'),
                    FormInputType::TEXT->schema('Panel URL', 'url'),
                ],
            ],
            self::PRIVACY_POLICY => [
                'label' => 'Privacy Policy',
                'description' => 'Privacy policy for the ' . config('app.name')
                    . ' website, which covers how this app handles your data.',
            ],
            self::SECTION_DIVIDER => [
                'label' => 'Section Divider',
            ],
            self::STACK => [
                'label' => 'Application Stack',
            ],
            self::TABS => [
                'label' => 'Tabs',
                'inputsRepeatable' => [
                    FormInputType::TEXT->schema('Tab Label', 'label'),
                    FormInputType::WYSIWYG->schema('Tab Content', 'html'),
                ],
            ],
            self::WYSIWYG => [
                'label' => 'Custom',
                'inputs' => [
                    FormInputType::WYSIWYG->schema('Content', 'html'),
                ],
            ],
            default => [],
        };

        return [
            'label' => $block_schema['label'] ?? '{unknown}',
            'description' => $block_schema['description'] ?? '',
            'inputs' => $block_schema['inputs'] ?? [],
            'inputsRepeatable' => $block_schema['inputsRepeatable'] ?? [],
        ];
    }
}
