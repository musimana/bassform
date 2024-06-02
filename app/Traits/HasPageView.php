<?php

namespace App\Traits;

use App\Models\Block;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasPageView
{
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

    /** Get the meta-title for the resource. */
    public function getMetaTitle(): string
    {
        return ($this->meta_title && trim($this->meta_title) !== '') ? $this->meta_title : $this->getTitle();
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

    /**
     * The relationship for the resource's content blocks.
     *
     * @return HasMany<Block>
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class, 'parent_id')
            ->where('parent_type', self::class)
            ->orderBy('display_order');
    }
}
