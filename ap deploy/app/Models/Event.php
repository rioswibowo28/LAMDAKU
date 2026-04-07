<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'location',
        'address',
        'start_date',
        'end_date',
        'is_all_day',
        'timezone',
        'category',
        'tags',
        'event_type',
        'status',
        'requires_registration',
        'max_participants',
        'current_participants',
        'registration_fee',
        'registration_deadline',
        'registration_instructions',
        'contact_person',
        'contact_email',
        'contact_phone',
        'website_url',
        'featured_image',
        'gallery',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'author_id',
        'published_at',
        'view_count',
        'is_featured',
        'allow_comments'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_deadline' => 'datetime',
        'published_at' => 'datetime',
        'tags' => 'array',
        'gallery' => 'array',
        'is_all_day' => 'boolean',
        'requires_registration' => 'boolean',
        'is_featured' => 'boolean',
        'allow_comments' => 'boolean',
        'registration_fee' => 'decimal:2',
        'max_participants' => 'integer',
        'current_participants' => 'integer',
        'view_count' => 'integer'
    ];

    // Relationships
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now());
    }

    public function scopePast($query)
    {
        return $query->where('end_date', '<', now());
    }

    public function scopeOngoing($query)
    {
        return $query->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('start_date', now()->month)
                    ->whereYear('start_date', now()->year);
    }

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeEventType($query, $type)
    {
        return $query->where('event_type', $type);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('description', 'LIKE', "%{$search}%")
              ->orWhere('content', 'LIKE', "%{$search}%")
              ->orWhere('location', 'LIKE', "%{$search}%");
        });
    }

    // Accessors
    public function getFormattedStartDateAttribute()
    {
        return $this->start_date->format('d M Y H:i');
    }

    public function getFormattedEndDateAttribute()
    {
        return $this->end_date->format('d M Y H:i');
    }    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'draft' => 'Draft',
            'published' => 'Published',
            'cancelled' => 'Cancelled',
            'completed' => 'Completed',
            default => ucfirst($this->status)
        };
    }

    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'draft' => 'bg-warning text-dark',
            'published' => 'bg-success',
            'cancelled' => 'bg-danger',
            'completed' => 'bg-info',
            default => 'bg-secondary'
        };
    }

    public function getEventTypeLabelAttribute()
    {
        return match($this->event_type) {
            'public' => 'Public',
            'private' => 'Private',
            'hybrid' => 'Hybrid',
            default => ucfirst($this->event_type)
        };
    }

    public function getDurationAttribute()
    {
        if ($this->is_all_day) {
            if ($this->start_date->isSameDay($this->end_date)) {
                return 'All day';
            } else {
                $days = $this->start_date->diffInDays($this->end_date) + 1;
                return "{$days} days";
            }
        }
        
        $duration = $this->start_date->diff($this->end_date);
        
        if ($duration->days > 0) {
            return $duration->days . ' days, ' . $duration->h . ' hours';
        } elseif ($duration->h > 0) {
            return $duration->h . ' hours, ' . $duration->i . ' minutes';
        } else {
            return $duration->i . ' minutes';
        }
    }

    public function getIsUpcomingAttribute()
    {
        return $this->start_date->isFuture();
    }

    public function getIsOngoingAttribute()
    {
        return $this->start_date->isPast() && $this->end_date->isFuture();
    }

    public function getIsPastAttribute()
    {
        return $this->end_date->isPast();
    }

    public function getRegistrationStatusAttribute()
    {
        if (!$this->requires_registration) {
            return 'No registration required';
        }
        
        if ($this->registration_deadline && $this->registration_deadline->isPast()) {
            return 'Registration closed';
        }
        
        if ($this->max_participants && $this->current_participants >= $this->max_participants) {
            return 'Full';
        }
        
        return 'Open';
    }

    public function getAvailableSpotsAttribute()
    {
        if (!$this->max_participants) {
            return null;
        }
        
        return max(0, $this->max_participants - $this->current_participants);
    }

    // Mutators
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = $this->generateUniqueSlug($value);
    }

    // Helper methods
    public function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function publish()
    {
        $this->update([
            'status' => 'published',
            'published_at' => now()
        ]);
    }

    public function unpublish()
    {
        $this->update([
            'status' => 'draft',
            'published_at' => null
        ]);
    }

    public function cancel()
    {
        $this->update(['status' => 'cancelled']);
    }

    public function complete()
    {
        $this->update(['status' => 'completed']);
    }

    public function incrementViewCount()
    {
        $this->increment('view_count');
    }

    public function toggleFeatured()
    {
        $this->update(['is_featured' => !$this->is_featured]);
    }

    public function addParticipant($count = 1)
    {
        if ($this->max_participants && ($this->current_participants + $count) > $this->max_participants) {
            return false;
        }
        
        $this->increment('current_participants', $count);
        return true;
    }

    public function removeParticipant($count = 1)
    {
        $this->decrement('current_participants', max(0, $count));
    }

    // Static methods
    public static function getCategories()
    {
        return static::whereNotNull('category')
                    ->distinct()
                    ->pluck('category')
                    ->filter()
                    ->sort()
                    ->values();
    }

    public static function getAllTags()
    {
        $events = static::whereNotNull('tags')->get(['tags']);
        $allTags = [];
        
        foreach ($events as $event) {
            if ($event->tags) {
                $allTags = array_merge($allTags, $event->tags);
            }
        }
        
        return collect($allTags)->unique()->sort()->values();
    }

    public static function getEventTypes()
    {
        return [
            'public' => 'Public Event',
            'private' => 'Private Event',
            'hybrid' => 'Hybrid Event'
        ];
    }

    public static function getStatuses()
    {
        return [
            'draft' => 'Draft',
            'published' => 'Published',
            'cancelled' => 'Cancelled',
            'completed' => 'Completed'
        ];
    }

    public function getRelatedEvents($limit = 5)
    {
        return static::published()
                    ->where('id', '!=', $this->id)
                    ->where(function ($query) {
                        if ($this->category) {
                            $query->where('category', $this->category);
                        }
                    })
                    ->orderBy('start_date', 'asc')
                    ->limit($limit)
                    ->get();
    }
}
