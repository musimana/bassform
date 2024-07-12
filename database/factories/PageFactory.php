<?php

namespace Database\Factories;

use App\Enums\Blocks\BlockType;
use App\Enums\Webpages\WebpageStatus;
use App\Enums\Webpages\WebpageTemplate;
use App\Traits\FakesDatabaseValues;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
final class PageFactory extends Factory
{
    use FakesDatabaseValues;

    /**
     * Define the model's default state.
     *
     * @return array<string, bool|int|string|null>
     */
    public function definition(): array
    {
        $title = $this->getFakeString();

        return [
            'webpage_status_id' => WebpageStatus::PUBLISHED->value,
            'slug' => urlencode(str_replace(' ', '-', $title)),
            'title' => ucwords($title),
            'meta_description' => null,
            'meta_keywords' => null,
            'open_graph_id' => null,
            'template' => WebpageTemplate::PUBLIC_CONTENT->value,
            'in_sitemap' => true,
            'is_homepage' => false,
        ];
    }

    /** Indicate that the model should match the project's default About page. */
    public function aboutPage(): static
    {
        return $this->state(fn (array $attributes) => array_merge([
            ...$attributes,
            'slug' => 'about',
            'title' => 'About',
            'meta_description' => config('metadata.description'),
        ]));
    }

    /** Indicate that the model should use faked data with all fields filled. */
    public function dummy(): static
    {
        return $this->state(fn (array $attributes) => array_merge([
            ...$attributes,
            'meta_description' => $this->getFakeString(20, 30),
        ]));
    }

    /** Indicate that the model should match the project's default homepage. */
    public function homePage(): static
    {
        return $this->state(fn (array $attributes) => array_merge([
            ...$attributes,
            'slug' => 'home',
            'title' => config('app.name'),
            'meta_description' => config('metadata.description'),
            'in_sitemap' => false,
            'is_homepage' => true,
        ]));
    }

    /** Indicate that the model should match the project's default Privacy page. */
    public function privacyPage(): static
    {
        return $this->state(fn (array $attributes) => array_merge([
            ...$attributes,
            'slug' => 'privacy',
            'title' => 'Privacy Policy',
            'meta_description' => BlockType::PRIVACY_POLICY->schema()['description'],
        ]));
    }
}
