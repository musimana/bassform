<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
final class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /** @var string $title */
        $title = fake()->words(3, true);

        /** @var array<int, string> $content_array */
        $content_array = fake()->paragraphs(5);

        /** @var array<int, string> $meta_keywords_array */
        $meta_keywords_array = fake()->words(5);

        return [
            'slug' => urlencode(str_replace(' ', '-', $title)),
            'title' => ucwords($title),
            'subtitle' => fake()->words(5, true),
            'content' => '<p>' . implode('</p><p>', $content_array) . '</p>',
            'meta_title' => ucwords($title),
            'meta_description' => fake()->words(24, true),
            'meta_keywords' => implode(', ', $meta_keywords_array),
            'template' => 'Public/PublicContent',
            'is_homepage' => 0,
        ];
    }

    /**
     * Indicate that the model's slug should be the given slug.
     *
     * @return static
     */
    public function fixedSlug(string $slug)
    {
        return $this->state(fn (array $attributes) => [
            'slug' => $slug,
        ]);
    }

    /**
     * Indicate that the model should match the project's default About page.
     *
     * @return static
     */
    public function aboutPage()
    {
        return $this->state(fn (array $attributes) => [
            ...$attributes,
            'slug' => 'about',
            'title' => 'About',
            'subtitle' => config('app.name'),
            'content' => '',
            'meta_title' => 'About',
        ]);
    }
}
