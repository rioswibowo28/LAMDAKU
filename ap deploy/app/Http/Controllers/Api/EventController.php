<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    /**
     * Get all published events for frontend
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Event::with('author:id,name,role')
                          ->published()
                          ->orderBy('start_date', 'asc');

            // Search functionality
            if ($request->filled('search')) {
                $query->search($request->search);
            }

            // Filter by category
            if ($request->filled('category')) {
                $query->where('category', $request->category);
            }

            // Filter by event type
            if ($request->filled('event_type')) {
                $query->where('event_type', $request->event_type);
            }

            // Filter by tag
            if ($request->filled('tag')) {
                $query->whereJsonContains('tags', $request->tag);
            }

            // Featured events only
            if ($request->boolean('featured')) {
                $query->where('is_featured', true);
            }

            // Date filters
            if ($request->filled('date_filter')) {
                switch ($request->date_filter) {
                    case 'upcoming':
                        $query->upcoming();
                        break;
                    case 'ongoing':
                        $query->ongoing();
                        break;
                    case 'past':
                        $query->past();
                        break;
                    case 'this_month':
                        $query->thisMonth();
                        break;
                }
            }

            // Pagination
            $perPage = min($request->get('per_page', 12), 50); // Max 50 per page
            $events = $query->paginate($perPage);

            // Transform data for frontend
            $events->getCollection()->transform(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'slug' => $event->slug,
                    'description' => $event->description,
                    'location' => $event->location,
                    'featured_image' => $event->featured_image ? asset('storage/' . $event->featured_image) : null,
                    'category' => $event->category,
                    'event_type' => $event->event_type,
                    'event_type_label' => $event->event_type_label,
                    'tags' => $event->tags ?? [],
                    'author' => [
                        'name' => $event->author->name,
                        'role' => $event->author->role,
                    ],
                    'start_date' => $event->start_date->format('Y-m-d H:i:s'),
                    'end_date' => $event->end_date->format('Y-m-d H:i:s'),
                    'formatted_start_date' => $event->formatted_start_date,
                    'formatted_end_date' => $event->formatted_end_date,
                    'is_all_day' => $event->is_all_day,
                    'duration' => $event->duration,
                    'is_upcoming' => $event->is_upcoming,
                    'is_ongoing' => $event->is_ongoing,
                    'is_past' => $event->is_past,
                    'view_count' => $event->view_count,
                    'is_featured' => $event->is_featured,
                    'requires_registration' => $event->requires_registration,
                    'registration_status' => $event->registration_status,
                    'available_spots' => $event->available_spots,
                    'registration_fee' => $event->registration_fee,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $events->items(),
                'pagination' => [
                    'current_page' => $events->currentPage(),
                    'last_page' => $events->lastPage(),
                    'per_page' => $events->perPage(),
                    'total' => $events->total(),
                    'from' => $events->firstItem(),
                    'to' => $events->lastItem(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch events',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Get featured events for homepage
     */
    public function featured(Request $request): JsonResponse
    {
        try {
            $limit = min($request->get('limit', 6), 20); // Max 20 featured events
            
            $events = Event::with('author:id,name,role')
                           ->published()
                           ->featured()
                           ->upcoming()
                           ->orderBy('start_date', 'asc')
                           ->limit($limit)
                           ->get();

            $events->transform(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'slug' => $event->slug,
                    'description' => $event->description,
                    'location' => $event->location,
                    'featured_image' => $event->featured_image ? asset('storage/' . $event->featured_image) : null,
                    'category' => $event->category,
                    'event_type' => $event->event_type,
                    'event_type_label' => $event->event_type_label,
                    'tags' => $event->tags ?? [],
                    'author' => [
                        'name' => $event->author->name,
                        'role' => $event->author->role,
                    ],
                    'start_date' => $event->start_date->format('Y-m-d H:i:s'),
                    'end_date' => $event->end_date->format('Y-m-d H:i:s'),
                    'formatted_start_date' => $event->formatted_start_date,
                    'formatted_end_date' => $event->formatted_end_date,
                    'is_all_day' => $event->is_all_day,
                    'duration' => $event->duration,
                    'view_count' => $event->view_count,
                    'requires_registration' => $event->requires_registration,
                    'registration_status' => $event->registration_status,
                    'available_spots' => $event->available_spots,
                    'registration_fee' => $event->registration_fee,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $events
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch featured events',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Get upcoming events
     */
    public function upcoming(Request $request): JsonResponse
    {
        try {
            $limit = min($request->get('limit', 10), 20);
            
            $events = Event::with('author:id,name,role')
                           ->published()
                           ->upcoming()
                           ->orderBy('start_date', 'asc')
                           ->limit($limit)
                           ->get();

            $events->transform(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'slug' => $event->slug,
                    'description' => $event->description,
                    'location' => $event->location,
                    'featured_image' => $event->featured_image ? asset('storage/' . $event->featured_image) : null,
                    'category' => $event->category,
                    'event_type' => $event->event_type,
                    'author' => [
                        'name' => $event->author->name,
                    ],
                    'start_date' => $event->start_date->format('Y-m-d H:i:s'),
                    'end_date' => $event->end_date->format('Y-m-d H:i:s'),
                    'formatted_start_date' => $event->formatted_start_date,
                    'formatted_end_date' => $event->formatted_end_date,
                    'is_all_day' => $event->is_all_day,
                    'duration' => $event->duration,
                    'view_count' => $event->view_count,
                    'requires_registration' => $event->requires_registration,
                    'registration_status' => $event->registration_status,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $events
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch upcoming events',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Show single event
     */
    public function show(string $slug): JsonResponse
    {
        try {
            $event = Event::with(['author:id,name,role,email'])
                          ->where('slug', $slug)
                          ->published()
                          ->first();

            if (!$event) {
                return response()->json([
                    'success' => false,
                    'message' => 'Event not found'
                ], 404);
            }

            // Increment view count
            $event->incrementViewCount();

            // Get related events
            $relatedEvents = $event->getRelatedEvents(4);

            $eventData = [
                'id' => $event->id,
                'title' => $event->title,
                'slug' => $event->slug,
                'description' => $event->description,
                'content' => $event->content,
                'location' => $event->location,
                'address' => $event->address,
                'featured_image' => $event->featured_image ? asset('storage/' . $event->featured_image) : null,
                'gallery' => $event->gallery ? array_map(function($path) {
                    return asset('storage/' . $path);
                }, $event->gallery) : [],
                'category' => $event->category,
                'event_type' => $event->event_type,
                'event_type_label' => $event->event_type_label,
                'tags' => $event->tags ?? [],
                'author' => [
                    'name' => $event->author->name,
                    'role' => $event->author->role,
                    'email' => $event->author->email,
                ],
                'start_date' => $event->start_date->format('Y-m-d H:i:s'),
                'end_date' => $event->end_date->format('Y-m-d H:i:s'),
                'formatted_start_date' => $event->formatted_start_date,
                'formatted_end_date' => $event->formatted_end_date,
                'is_all_day' => $event->is_all_day,
                'timezone' => $event->timezone,
                'duration' => $event->duration,
                'is_upcoming' => $event->is_upcoming,
                'is_ongoing' => $event->is_ongoing,
                'is_past' => $event->is_past,
                'view_count' => $event->view_count,
                'is_featured' => $event->is_featured,
                'allow_comments' => $event->allow_comments,
                
                // Registration info
                'requires_registration' => $event->requires_registration,
                'max_participants' => $event->max_participants,
                'current_participants' => $event->current_participants,
                'available_spots' => $event->available_spots,
                'registration_fee' => $event->registration_fee,
                'registration_deadline' => $event->registration_deadline?->format('Y-m-d H:i:s'),
                'registration_status' => $event->registration_status,
                'registration_instructions' => $event->registration_instructions,
                
                // Contact info
                'contact_person' => $event->contact_person,
                'contact_email' => $event->contact_email,
                'contact_phone' => $event->contact_phone,
                'website_url' => $event->website_url,
                
                // SEO Data
                'seo' => [
                    'meta_title' => $event->meta_title ?: $event->title,
                    'meta_description' => $event->meta_description ?: $event->description,
                    'meta_keywords' => $event->meta_keywords,
                    'canonical_url' => $event->canonical_url,
                    'og_title' => $event->og_title ?: $event->meta_title ?: $event->title,
                    'og_description' => $event->og_description ?: $event->meta_description ?: $event->description,
                    'og_image' => $event->og_image ? asset('storage/' . $event->og_image) : 
                                 ($event->featured_image ? asset('storage/' . $event->featured_image) : null),
                ],
                
                // Related events
                'related_events' => $relatedEvents->map(function ($related) {
                    return [
                        'id' => $related->id,
                        'title' => $related->title,
                        'slug' => $related->slug,
                        'description' => $related->description,
                        'location' => $related->location,
                        'featured_image' => $related->featured_image ? asset('storage/' . $related->featured_image) : null,
                        'category' => $related->category,
                        'start_date' => $related->start_date->format('Y-m-d H:i:s'),
                        'formatted_start_date' => $related->formatted_start_date,
                        'view_count' => $related->view_count,
                        'is_upcoming' => $related->is_upcoming,
                    ];
                }),
            ];

            return response()->json([
                'success' => true,
                'data' => $eventData
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch event',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Get all categories
     */
    public function categories(): JsonResponse
    {
        try {
            $categories = Event::published()
                               ->whereNotNull('category')
                               ->groupBy('category')
                               ->selectRaw('category, count(*) as count')
                               ->orderBy('category')
                               ->get();

            return response()->json([
                'success' => true,
                'data' => $categories
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch categories',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Get all tags
     */
    public function tags(): JsonResponse
    {
        try {
            $events = Event::published()
                           ->whereNotNull('tags')
                           ->get(['tags']);

            $allTags = [];
            foreach ($events as $event) {
                if ($event->tags) {
                    $allTags = array_merge($allTags, $event->tags);
                }
            }

            $tagCounts = array_count_values($allTags);
            $tags = collect($tagCounts)->map(function ($count, $tag) {
                return [
                    'name' => $tag,
                    'count' => $count
                ];
            })->sortBy('name')->values();

            return response()->json([
                'success' => true,
                'data' => $tags
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch tags',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Search events
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'q' => 'required|string|min:2|max:100',
                'per_page' => 'nullable|integer|min:1|max:50'
            ]);

            $query = Event::with('author:id,name,role')
                          ->published()
                          ->search($request->q)
                          ->orderBy('start_date', 'asc');

            $perPage = min($request->get('per_page', 12), 50);
            $events = $query->paginate($perPage);

            $events->getCollection()->transform(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'slug' => $event->slug,
                    'description' => $event->description,
                    'location' => $event->location,
                    'featured_image' => $event->featured_image ? asset('storage/' . $event->featured_image) : null,
                    'category' => $event->category,
                    'event_type' => $event->event_type,
                    'tags' => $event->tags ?? [],
                    'author' => [
                        'name' => $event->author->name,
                    ],
                    'start_date' => $event->start_date->format('Y-m-d H:i:s'),
                    'end_date' => $event->end_date->format('Y-m-d H:i:s'),
                    'formatted_start_date' => $event->formatted_start_date,
                    'formatted_end_date' => $event->formatted_end_date,
                    'is_all_day' => $event->is_all_day,
                    'duration' => $event->duration,
                    'view_count' => $event->view_count,
                    'is_upcoming' => $event->is_upcoming,
                    'is_ongoing' => $event->is_ongoing,
                    'is_past' => $event->is_past,
                    'requires_registration' => $event->requires_registration,
                    'registration_status' => $event->registration_status,
                ];
            });

            return response()->json([
                'success' => true,
                'query' => $request->q,
                'data' => $events->items(),
                'pagination' => [
                    'current_page' => $events->currentPage(),
                    'last_page' => $events->lastPage(),
                    'per_page' => $events->perPage(),
                    'total' => $events->total(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Search failed',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
