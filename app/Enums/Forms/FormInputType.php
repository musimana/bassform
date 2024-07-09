<?php

namespace App\Enums\Forms;

enum FormInputType: string
{
    /** List of the form inputs available to the application. */
    case TEXT = 'text';
    case TEXTAREA = 'textarea';
    case WYSIWYG = 'wysiwyg';

    /**
     * Get an array of the input type's schema.
     *
     * @return array<string, string>
     */
    public function schema(string $label, string $field = ''): array
    {
        return match ($this) {
            self::TEXT => [
                'field' => $field,
                'label' => $label,
                'type' => 'text',
            ],
            self::TEXTAREA => [
                'field' => $field,
                'label' => $label,
                'type' => 'textarea',
            ],
            self::WYSIWYG => [
                'field' => $field,
                'label' => $label,
                'type' => 'wysiwyg',
            ],
        };
    }
}
