<?php

namespace App\Models;

use App\Traits\HasPageView;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * @method Builder|static inSitemap()
 * @method Builder|static isHomepage()
 * @method Builder|static isNotHomepage()
 * @method static Builder|static query()
 */
final class Page extends Model
{
    use HasFactory,
        HasPageView,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'open_graph_id',
        'template',
        'in_sitemap',
        'is_homepage',
    ];

    /** Get the HTML content string for the page. */
    public function getContent(): string
    {
        return $this->content ?? '';
    }

    /** Get the public URL's path for the page. */
    public function getPath(): string
    {
        return $this->is_homepage
            ? route('home', [], false)
            : route('page.show', $this->slug, false);
    }

    /** Get the subtitle for the page. */
    public function getSubtitle(): string
    {
        return $this->subtitle ?? '';
    }

    /** Get the public URL for the page. */
    public function getUrl(): string
    {
        return $this->is_homepage
            ? route('home')
            : route('page.show', $this->slug);
    }

    /** Get the admin URL for the page edit view. */
    public function getUrlEdit(): string
    {
        return route('admin.page.edit', $this->slug);
    }

    /** Returns all Page models that should be in the sitemap (in_sitemap = 1). */
    public function scopeInSitemap(Builder|QueryBuilder $query): Builder|QueryBuilder
    {
        return $query->where(function ($query) {
            $query->where('in_sitemap', 1);
        });
    }

    /** Return all Page models flagged as the homepage (is_homepage = 1). */
    public function scopeIsHomepage(Builder|QueryBuilder $query): Builder|QueryBuilder
    {
        return $query->where(function ($query) {
            $query->where('is_homepage', 1)->orderBy('udpated_at', 'desc');
        });
    }

    /** Return all Page models not flagged as the homepage (is_homepage != 1). */
    public function scopeIsNotHomepage(Builder|QueryBuilder $query): Builder|QueryBuilder
    {
        return $query->where(function ($query) {
            $query->where('is_homepage', '!=', 1)->orderBy('udpated_at', 'desc');
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'in_sitemap' => 'boolean',
            'is_homepage' => 'boolean',
        ];
    }
}
