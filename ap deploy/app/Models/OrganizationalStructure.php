<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationalStructure extends Model
{
    protected $fillable = [
        'name',
        'position',
        'description',
        'level_order',
        'position_order',
        'background_color',
        'icon_class',
        'photo',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'level_order' => 'integer',
        'position_order' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('level_order')
                    ->orderBy('position_order');
    }

    public function scopeByLevel($query, $level)
    {
        return $query->where('level_order', $level);
    }

    // Get all unique levels
    public static function getLevels()
    {
        return self::select('level_order')
                   ->distinct()
                   ->orderBy('level_order')
                   ->pluck('level_order');
    }

    // Get positions grouped by level
    public static function getByLevels()
    {
        return self::active()
                   ->ordered()
                   ->get()
                   ->groupBy('level_order');
    }

    // Get photo URL
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        return null;
    }

    // Get default avatar if no photo
    public function getAvatarAttribute()
    {
        if ($this->photo) {
            return $this->photo_url;
        }
        // Return a default avatar based on name initials
        $initials = collect(explode(' ', $this->name))
            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
            ->take(2)
            ->implode('');
        return 'https://ui-avatars.com/api/?name=' . urlencode($initials) . '&size=100&background=random';
    }
}
