<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class NavbarItem extends Model
{
    use HasFactory,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'navbar_id',
        'parent_id',
        'title',
        'url',
        'display_order',
    ];

    /** Get the title for the navbar item. */
    public function getTitle(): string
    {
        return $this->title ?? '';
    }

    /** Get the url for the navbar item. */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /** The relationship for the navbar item's children. */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }
}
