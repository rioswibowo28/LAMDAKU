<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $fillable = [
        'year',
        'title',
        'description',
        'icon',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'year' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('year');
    }

    public function scopeOrderedBySort($query)
    {
        return $query->orderBy('sort_order');
    }
}
