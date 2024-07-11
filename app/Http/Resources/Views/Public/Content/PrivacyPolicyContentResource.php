<?php

namespace App\Http\Resources\Views\Public\Content;

use App\Enums\Blocks\BlockType;
use App\Enums\Webpages\WebpageTemplate;
use App\Http\Resources\Views\Public\Metadata\PageMetadataResource;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Block;
use App\Models\Page;

final class PrivacyPolicyContentResource implements ConstantItemInterface
{
    /** Instantiate the resource. */
    public function __construct(
        protected Page $page = new Page,
    ) {
        if (!$this->page->id) {
            $this->page = Page::query()
                ->where('slug', 'privacy')
                ->with('blocks')
                ->first()
                ?? new Page;
        }

        if (!$this->getTemplate()) {
            $this->setDefaultModel();
        }
    }

    /**
     * Get the content array for the site's privacy page.
     *
     * @return array{
     *  blocks: array<int, array{
     *      type: string,
     *      data: array<string, array<int, string>|string>,
     *  }>,
     *  bodytext: string,
     *  heading: string,
     *  subheading: string,
     * }
     */
    public function getItem(): array
    {
        return (new PageContentResource($this->page))->getItem();
    }

    /**
     * Get the meta-data array for the site's privacy page.
     *
     * @return array{canonical: string, description: string, title: string}
     */
    public function getMetaData(): array
    {
        return (new PageMetadataResource)->getItem($this->page);
    }

    /** Get the template for the resource. */
    public function getTemplate(): ?WebpageTemplate
    {
        return $this->page->getTemplate();
    }

    /** Set the resource's page to the default privacy page model. */
    public function setDefaultModel(): void
    {
        $this->page = new Page([
            'template' => WebpageTemplate::PUBLIC_CONTENT->value,
            'slug' => 'privacy',
            'title' => 'Privacy Policy',
            'meta_title' => 'Privacy Policy',
            'meta_description' => 'Privacy policy for the ' . config('app.name') . ' website, which covers how this app handles your data.',
        ]);

        $this->page->blocks = collect([
            new Block([
                'type' => BlockType::SECTION_DIVIDER->value,
                'parent_type' => Page::class,
                'parent_id' => $this->page->id,
            ]),
            new Block([
                'type' => BlockType::PRIVACY_POLICY->value,
                'parent_type' => Page::class,
                'parent_id' => $this->page->id,
            ]),
        ]);

        $page = Page::factory()->privacyPage()->make();
    }
}
