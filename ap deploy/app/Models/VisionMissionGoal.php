<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisionMissionGoal extends Model
{
    protected $fillable = [
        'type',
        'title',
        'content',
        'description',
        'icon_class',
        'background_color',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeVision($query)
    {
        return $query->where('type', 'vision');
    }

    public function scopeMission($query)
    {
        return $query->where('type', 'mission');
    }

    public function scopeGoals($query)
    {
        return $query->where('type', 'goal');
    }

    // Static methods for easy data retrieval
    public static function getVision()
    {
        return self::active()->vision()->ordered()->get();
    }

    public static function getMissions()
    {
        return self::active()->mission()->ordered()->get();
    }

    public static function getGoals()
    {
        return self::active()->goals()->ordered()->get();
    }

    public static function getAllGrouped()
    {
        return [
            'vision' => self::getVision(),
            'mission' => self::getMissions(),
            'goals' => self::getGoals()
        ];
    }

    // Utility methods
    public function getTypeDisplayName()
    {
        return match($this->type) {
            'vision' => 'Visi',
            'mission' => 'Misi',
            'goal' => 'Tujuan',
            default => ucfirst($this->type)
        };
    }

    public static function getTypes()
    {
        return [
            'vision' => 'Visi',
            'mission' => 'Misi',
            'goal' => 'Tujuan'
        ];
    }
}
