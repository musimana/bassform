<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Navbar extends Model
{
    use HasFactory,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
    ];

    /** Get the subtitle for the page. */
    public function getTitle(): string
    {
        return $this->title ?? '';
    }

    /** The relationship for the navbar's items. */
    public function items(): HasMany
    {
        return $this->hasMany(NavbarItem::class)
            ->whereNull('parent_id')
            ->orderBy('navbar_items.display_order');
    }
}
