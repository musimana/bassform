<?php

namespace App\Traits;

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

    /**
     * Get the content blocks array for the item.
     *
     * @return array<int, string>
     */
    public function blocks(): array
    {
        $blocks = [];

        if ($this->slug === 'about') {
            $blocks[] = 'stack';
        }

        if ($this->slug === 'controls') {
            $blocks[] = 'tabs';
        }

        return $blocks;
    }
}
