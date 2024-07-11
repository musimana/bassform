<?php

namespace App\Models;

use App\Traits\Admin\IsAdminResource;
use App\Traits\HasPageView;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;

/**
 * @method Builder|static isHomepage()
 * @method Builder|static isNotHomepage()
 * @method static Builder|static query()
 */
final class Page extends Model
{
    use HasFactory,
        HasPageView,
        IsAdminResource,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'slug',
        'title',
        'meta_description',
        'meta_keywords',
        'open_graph_id',
        'template',
        'in_sitemap',
        'is_homepage',
    ];

    /** Get the public URL's path for the page. */
    public function getPath(): string
    {
        return $this->is_homepage
            ? route('home', [], false)
            : route('page.show', $this->slug, false);
    }

    /** Get the public URL for the page. */
    public function getUrl(): string
    {
        return $this->is_homepage
            ? route('home')
            : route('page.show', $this->slug);
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
