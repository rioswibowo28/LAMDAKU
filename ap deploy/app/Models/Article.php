<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'gallery',
        'status',
        'author_id',
        'category',
        'tags',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image',
        'published_at',
        'view_count',
        'is_featured',
        'allow_comments'
    ];

    protected $casts = [
        'gallery' => 'array',
        'tags' => 'array',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
        'allow_comments' => 'boolean'
    ];

    // Relationships
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByAuthor($query, $authorId)
    {
        return $query->where('author_id', $authorId);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }    // Mutators
    // public function setTitleAttribute($value)
    // {
    //     $this->attributes['title'] = $value;
    //     // Only generate slug if not already set
    //     if (!isset($this->attributes['slug']) || empty($this->attributes['slug'])) {
    //         $this->attributes['slug'] = $this->generateUniqueSlug($value);
    //     }
    // }

    // Accessors
    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }
        
        // Auto-generate excerpt from content if not provided
        return Str::limit(strip_tags($this->content), 150);
    }

    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $readingTime = ceil($wordCount / 200); // Average 200 words per minute
        return $readingTime . ' min read';
    }

    public function getFormattedPublishedDateAttribute()
    {
        if ($this->published_at) {
            return $this->published_at->format('d M Y');
        }
        return null;
    }

    public function getIsPublishedAttribute()
    {
        return $this->status === 'published' && 
               $this->published_at && 
               $this->published_at->lte(now());
    }

    // Helper Methods
    public function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (self::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
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

    public function archive()
    {
        $this->update(['status' => 'archived']);
    }

    public function incrementViewCount()
    {
        $this->increment('view_count');
    }

    public function toggleFeatured()
    {
        $this->update(['is_featured' => !$this->is_featured]);
    }

    // Search functionality
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('content', 'LIKE', "%{$search}%")
              ->orWhere('excerpt', 'LIKE', "%{$search}%")
              ->orWhere('category', 'LIKE', "%{$search}%");
        });
    }

    // Get related articles
    public function getRelatedArticles($limit = 3)
    {
        return self::published()
                   ->where('id', '!=', $this->id)
                   ->where(function ($query) {
                       if ($this->category) {
                           $query->where('category', $this->category);
                       }
                       
                       if ($this->tags && count($this->tags) > 0) {
                           foreach ($this->tags as $tag) {
                               $query->orWhereJsonContains('tags', $tag);
                           }
                       }
                   })
                   ->orderBy('view_count', 'desc')
                   ->orderBy('published_at', 'desc')
                   ->limit($limit)
                   ->get();
    }

    // Get all unique categories
    public static function getCategories()
    {
        return self::whereNotNull('category')
                   ->distinct()
                   ->pluck('category')
                   ->filter()
                   ->sort()
                   ->values();
    }

    // Get all unique tags
    public static function getAllTags()
    {
        $tags = self::whereNotNull('tags')
                    ->pluck('tags')
                    ->flatten()
                    ->unique()
                    ->filter()
                    ->sort()
                    ->values();
        
        return $tags;
    }
}
