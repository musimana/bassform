<?php

namespace App\Traits;

trait FakesDatabaseValues
{
    /** Get a faked long HTML string. */
    public function getFakeTextHtml(int $min_elements = 1, int $max_elements = 5, string $element = 'p'): string
    {
        /** @var array<int, string> $content_array */
        $content_array = fake()->paragraphs(fake()->numberBetween($min_elements, $max_elements));

        return '<' . $element . '>'
            . implode('</' . $element . '><' . $element . '>', $content_array)
            . '</' . $element . '>';
    }

    /** Get a faked string. */
    public function getFakeString(int $min_words = 1, int $max_words = 5): string
    {
        /** @var string $title */
        $title = fake()->words(fake()->numberBetween($min_words, $max_words), true);

        return substr($title, 0, 255);
    }
}
