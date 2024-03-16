<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Block extends Model
{
    use HasFactory,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_type',
        'parent_id',
        'type',
        'display_order',
        'data',
    ];

    /**
     * Get an array of the block's JSON encoded data field.
     *
     * @return array<int|string, mixed>
     */
    public function getDataArray(): ?array
    {
        return json_decode($this->data ?? '', true);
    }
}
