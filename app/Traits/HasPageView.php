<?php

namespace App\Traits;

use App\Enums\Webpages\WebpageStatus;
use App\Enums\Webpages\WebpageTemplate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * @method Builder|static published()
 * @method Builder|static inSitemap()
 * @method static Builder|static query()
 */
trait HasPageView
{
    use HasContentBlocks;

    /** Get the meta-description for the resource. */
    public function getMetaDescription(): string
    {
        return $this->meta_description ?? '';
    }

    /** Get the meta-keywords for the resource. */
    public function getMetaKeywords(): string
    {
        return $this->meta_keywords ?? '';
    }

    /** Get the webpage template for the resource. */
    public function getTemplate(): ?WebpageTemplate
    {
        return WebpageTemplate::tryFrom($this?->template ?? '');
    }

    /** Get the title for the resource. */
    public function getTitle(): string
    {
        return $this->title ?? '';
    }

    /** Returns true if the item is marked as being in the sitemap. */
    public function isInSitemap(): bool
    {
        return $this->in_sitemap ?? false;
    }

    /** Returns all models that should be in the sitemap (in_sitemap = 1). */
    public function scopeInSitemap(Builder|QueryBuilder $query): Builder|QueryBuilder
    {
        return $query->where(function ($query) {
            $query->where('in_sitemap', 1);
        });
    }

    /** Returns all models that are Published (webpage_status_id = 2). */
    public function scopePublished(Builder|QueryBuilder $query): Builder|QueryBuilder
    {
        return $query->where(function ($query) {
            $query->where('webpage_status_id', WebpageStatus::PUBLISHED->value);
        });
    }
}
