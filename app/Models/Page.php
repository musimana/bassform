<?php

namespace App\Models;

use App\Traits\HasPageView;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * @method Builder|static published()
 * @method Builder|static inSitemap()
 * @method static Builder|static query()
 */
class Page extends Model
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'in_sitemap' => 'boolean',
        'is_homepage' => 'boolean',
    ];

    /** GETTERS */

    /**
     * Get the public URL's path for the page.
     */
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

    /** SCOPES */

    /** Returns all Page models that should be in the sitemap (in_sitemap = 1). */
    public function scopeInSitemap(Builder|QueryBuilder $query): Builder|QueryBuilder
    {
        return $query->where(function ($query) {
            $query->where('in_sitemap', 1);
        });
    }
}
