<?php

namespace App\Http\Resources\Views\Public\Content;

use App\Enums\Blocks\BlockType;
use App\Enums\Webpages\WebpageTemplate;
use App\Interfaces\Resources\Items\ConstantItemInterface;
use App\Models\Block;
use App\Models\Page;

final class HomepageContentResource implements ConstantItemInterface
{
    /** Instantiate the resource. */
    public function __construct(
        protected Page $page = new Page
    ) {
        if (!$this->page->id) {
            $this->page = Page::query()
                ->isHomepage()
                ->with('blocks')
                ->first()
                ?? new Page;
        }

        if (!$this->getTemplate()) {
            $this->setDefaultModel();
        }
    }

    /**
     * Get the content array for the site's homepage.
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

    /** Get the template for the resource. */
    public function getTemplate(): ?WebpageTemplate
    {
        return $this->page->getTemplate();
    }

    /** Set the resource's page to the default homepage model. */
    public function setDefaultModel(): void
    {
        $this->page = new Page([
            'template' => WebpageTemplate::PUBLIC_INDEX->value,
            'slug' => 'home',
            'title' => config('app.name'),
            'meta_description' => config('metadata.description'),
            'in_sitemap' => false,
            'is_homepage' => true,
        ]);

        $this->page->blocks = collect([
            new Block([
                'type' => BlockType::HEADER_LOGO->value,
                'parent_type' => Page::class,
                'parent_id' => $this->page->id,
                'display_order' => 0,
                'data' => (string) json_encode([
                    'heading' => config('app.name'),
                    'subheading' => config('metadata.description'),
                ]),
            ]),
        ]);
    }
}
