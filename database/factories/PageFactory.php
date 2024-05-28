<?php

namespace Database\Factories;

use App\Enums\Webpages\WebpageTemplate;
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

        return [
            'slug' => urlencode(str_replace(' ', '-', $title)),
            'title' => ucwords($title),
            'subtitle' => fake()->words(5, true),
            'content' => '<p>' . implode('</p><p>', $content_array) . '</p>',
            'meta_title' => ucwords($title),
            'meta_description' => fake()->words(24, true),
            'template' => WebpageTemplate::PUBLIC_CONTENT->value,
        ];
    }

    /**
     * Indicate that the model should match the project's default About page.
     *
     * @return static
     */
    public function aboutPage()
    {
        return $this->state(fn (array $attributes) => array_merge([
            ...$attributes,
            'slug' => 'about',
            'title' => 'About',
            'subtitle' => config('app.name'),
            'content' => '',
            'meta_title' => 'About',
            'meta_description' => config('metadata.description'),
        ]));
    }

    /**
     * Indicate that the model should match the project's default homepage.
     *
     * @return static
     */
    public function homePage()
    {
        return $this->state(fn (array $attributes) => array_merge([
            ...$attributes,
            'slug' => 'home',
            'title' => config('app.name'),
            'subtitle' => config('metadata.description'),
            'content' => '',
            'meta_title' => config('app.name'),
            'meta_description' => config('metadata.description'),
            'template' => WebpageTemplate::PUBLIC_INDEX->value,
            'in_sitemap' => false,
            'is_homepage' => true,
        ]));
    }
}
