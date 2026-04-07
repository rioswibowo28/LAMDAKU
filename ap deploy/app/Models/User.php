<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'is_active',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    /**
     * Check if user has admin role
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user has penulis role
     */
    public function isPenulis(): bool
    {
        return $this->role === 'penulis';
    }

    /**
     * Check if user has specific role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Get role display name
     */
    public function getRoleNameAttribute(): string
    {
        return match($this->role) {
            'admin' => 'Administrator',
            'penulis' => 'Penulis',
            default => ucfirst($this->role)
        };
    }

    /**
     * Scope untuk filter berdasarkan role
     */
    public function scopeByRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Scope untuk user aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Relationship dengan Article
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'author_id');
    }

    /**
     * Relationship dengan Event
     */
    public function events()
    {
        return $this->hasMany(Event::class, 'author_id');
    }

    /**
     * Get published articles count
     */
    public function getPublishedArticlesCountAttribute()
    {
        return $this->articles()->where('status', 'published')->count();
    }

    /**
     * Get draft articles count
     */
    public function getDraftArticlesCountAttribute()
    {
        return $this->articles()->where('status', 'draft')->count();
    }

    /**
     * Get total articles count
     */
    public function getTotalArticlesCountAttribute()
    {
        return $this->articles()->count();
    }

    /**
     * Get published events count
     */
    public function getPublishedEventsCountAttribute()
    {
        return $this->events()->where('status', 'published')->count();
    }

    /**
     * Get upcoming events count
     */
    public function getUpcomingEventsCountAttribute()
    {
        return $this->events()->upcoming()->count();
    }

    /**
     * Get total events count
     */
    public function getTotalEventsCountAttribute()
    {
        return $this->events()->count();
    }
}
