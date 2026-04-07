<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function __construct()
    {
        // Routes are already protected by admin.auth middleware in web.php
        $this->middleware(function ($request, $next) {
            // Get user from session (since we're using session-based auth)
            $userId = session('admin_user_id');
            $userRole = session('admin_role');
            
            if (!$userId || !$userRole) {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
            
            // Check if user has permission to access events
            if ($userRole !== 'admin' && $userRole !== 'penulis') {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
            
            return $next($request);
        });
    }

    /**
     * Get current authenticated user from session
     */
    private function getCurrentUser()
    {
        $userId = session('admin_user_id');
        if (!$userId) {
            abort(403, 'User not authenticated');
        }
        
        return User::find($userId);
    }

    /**
     * Display a listing of events
     */
    public function index(Request $request)
    {
        $user = $this->getCurrentUser();
        $query = Event::with('author');

        // Penulis hanya bisa melihat event mereka sendiri
        if ($user->isPenulis()) {
            $query->where('author_id', $user->id);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter berdasarkan tipe event
        if ($request->filled('event_type')) {
            $query->where('event_type', $request->event_type);
        }

        // Filter berdasarkan author (hanya untuk admin)
        if ($request->filled('author') && $user->isAdmin()) {
            $query->where('author_id', $request->author);
        }

        // Filter berdasarkan tanggal
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

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Sorting
        $sortField = $request->get('sort', 'start_date');
        $sortDirection = $request->get('direction', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $events = $query->paginate(15)->withQueryString();

        // Data untuk filter
        $categories = Event::getCategories();
        $eventTypes = Event::getEventTypes();
        $authors = $user->isAdmin() ? User::where('role', 'penulis')->orWhere('role', 'admin')->get() : null;

        return view('admin.events.index', compact('events', 'categories', 'eventTypes', 'authors'));
    }

    /**
     * Show the form for creating a new event
     */
    public function create()
    {
        $categories = Event::getCategories();
        $tags = Event::getAllTags();
        $eventTypes = Event::getEventTypes();
        $statuses = Event::getStatuses();
        
        return view('admin.events.create', compact('categories', 'tags', 'eventTypes', 'statuses'));
    }

    /**
     * Store a newly created event
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'content' => 'required|string',
            'location' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_all_day' => 'boolean',
            'timezone' => 'required|string',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'event_type' => 'required|in:public,private,hybrid',
            'status' => 'required|in:draft,published,cancelled,completed',
            'requires_registration' => 'boolean',
            'max_participants' => 'nullable|integer|min:1',
            'registration_fee' => 'nullable|numeric|min:0',
            'registration_deadline' => 'nullable|date',
            'registration_instructions' => 'nullable|string',
            'contact_person' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'website_url' => 'nullable|url|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // SEO fields
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
            'meta_keywords' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|url',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:300',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Process tags
        $tags = null;
        if ($request->filled('tags')) {
            $tags = array_map('trim', explode(',', $request->tags));
            $tags = array_filter($tags); // Remove empty tags
        }

        // Handle featured image upload
        $featuredImagePath = null;
        if ($request->hasFile('featured_image')) {
            $featuredImagePath = $request->file('featured_image')->store('events/featured', 'public');
        }

        // Handle gallery images upload
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('events/gallery', 'public');
            }
        }

        // Handle OG image upload
        $ogImagePath = null;
        if ($request->hasFile('og_image')) {
            $ogImagePath = $request->file('og_image')->store('events/og', 'public');
        }

        // Create event
        $eventData = $validated;
        $eventData['author_id'] = session('admin_user_id');
        $eventData['featured_image'] = $featuredImagePath;
        $eventData['gallery'] = !empty($galleryPaths) ? $galleryPaths : null;
        $eventData['tags'] = $tags;
        $eventData['og_image'] = $ogImagePath;
        $eventData['is_featured'] = $request->has('is_featured');
        $eventData['allow_comments'] = $request->has('allow_comments');

        // Set published_at if status is published
        if ($validated['status'] === 'published') {
            $eventData['published_at'] = now();
        }

        $event = Event::create($eventData);

        return redirect()->route('admin.events.index')
                        ->with('success', 'Event berhasil dibuat!');
    }

    /**
     * Display the specified event
     */
    public function show(Event $event)
    {
        $user = $this->getCurrentUser();
        
        // Penulis hanya bisa melihat event mereka sendiri
        if ($user->isPenulis() && $event->author_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke event ini.');
        }

        $event->load('author');
        $relatedEvents = $event->getRelatedEvents();

        return view('admin.events.show', compact('event', 'relatedEvents'));
    }

    /**
     * Show the form for editing the specified event
     */
    public function edit(Event $event)
    {
        $user = $this->getCurrentUser();
        
        // Penulis hanya bisa edit event mereka sendiri
        if ($user->isPenulis() && $event->author_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit event ini.');
        }

        $categories = Event::getCategories();
        $tags = Event::getAllTags();
        $eventTypes = Event::getEventTypes();
        $statuses = Event::getStatuses();
        
        return view('admin.events.edit', compact('event', 'categories', 'tags', 'eventTypes', 'statuses'));
    }

    /**
     * Update the specified event
     */
    public function update(Request $request, Event $event)
    {
        $user = $this->getCurrentUser();
        
        // Penulis hanya bisa update event mereka sendiri
        if ($user->isPenulis() && $event->author_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate event ini.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'content' => 'required|string',
            'location' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'is_all_day' => 'boolean',
            'timezone' => 'required|string',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'event_type' => 'required|in:public,private,hybrid',
            'status' => 'required|in:draft,published,cancelled,completed',
            'requires_registration' => 'boolean',
            'max_participants' => 'nullable|integer|min:1',
            'registration_fee' => 'nullable|numeric|min:0',
            'registration_deadline' => 'nullable|date',
            'registration_instructions' => 'nullable|string',
            'contact_person' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'website_url' => 'nullable|url|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_featured_image' => 'boolean',
            'remove_gallery_images' => 'array',
            
            // SEO fields
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:300',
            'meta_keywords' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|url',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string|max:300',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_og_image' => 'boolean',
        ]);

        // Process tags
        $tags = null;
        if ($request->filled('tags')) {
            $tags = array_map('trim', explode(',', $request->tags));
            $tags = array_filter($tags);
        }

        // Handle featured image
        $featuredImagePath = $event->featured_image;
        if ($request->has('remove_featured_image') && $request->remove_featured_image) {
            if ($featuredImagePath) {
                Storage::disk('public')->delete($featuredImagePath);
            }
            $featuredImagePath = null;
        }
        if ($request->hasFile('featured_image')) {
            if ($featuredImagePath) {
                Storage::disk('public')->delete($featuredImagePath);
            }
            $featuredImagePath = $request->file('featured_image')->store('events/featured', 'public');
        }

        // Handle gallery images
        $galleryPaths = $event->gallery ?? [];
        
        // Remove selected gallery images
        if ($request->has('remove_gallery_images')) {
            foreach ($request->remove_gallery_images as $imageToRemove) {
                if (($key = array_search($imageToRemove, $galleryPaths)) !== false) {
                    Storage::disk('public')->delete($imageToRemove);
                    unset($galleryPaths[$key]);
                }
            }
            $galleryPaths = array_values($galleryPaths); // Re-index array
        }
        
        // Add new gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('events/gallery', 'public');
            }
        }

        // Handle OG image
        $ogImagePath = $event->og_image;
        if ($request->has('remove_og_image') && $request->remove_og_image) {
            if ($ogImagePath) {
                Storage::disk('public')->delete($ogImagePath);
            }
            $ogImagePath = null;
        }
        if ($request->hasFile('og_image')) {
            if ($ogImagePath) {
                Storage::disk('public')->delete($ogImagePath);
            }
            $ogImagePath = $request->file('og_image')->store('events/og', 'public');
        }

        // Update event
        $eventData = $validated;
        $eventData['featured_image'] = $featuredImagePath;
        $eventData['gallery'] = !empty($galleryPaths) ? $galleryPaths : null;
        $eventData['tags'] = $tags;
        $eventData['og_image'] = $ogImagePath;
        $eventData['is_featured'] = $request->has('is_featured');
        $eventData['allow_comments'] = $request->has('allow_comments');

        // Handle published_at
        if ($validated['status'] === 'published' && !$event->published_at) {
            $eventData['published_at'] = now();
        } elseif ($validated['status'] !== 'published') {
            $eventData['published_at'] = null;
        }

        // Update slug if title changed
        if ($event->title !== $validated['title']) {
            $eventData['slug'] = $event->generateUniqueSlug($validated['title']);
        }

        $event->update($eventData);

        return redirect()->route('admin.events.index')
                        ->with('success', 'Event berhasil diperbarui!');
    }

    /**
     * Remove the specified event from storage
     */
    public function destroy(Event $event)
    {
        $user = $this->getCurrentUser();
        
        // Penulis hanya bisa hapus event mereka sendiri
        if ($user->isPenulis() && $event->author_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus event ini.');
        }

        // Delete associated images
        if ($event->featured_image) {
            Storage::disk('public')->delete($event->featured_image);
        }
        
        if ($event->gallery) {
            foreach ($event->gallery as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }
        
        if ($event->og_image) {
            Storage::disk('public')->delete($event->og_image);
        }

        $event->delete();

        return redirect()->route('admin.events.index')
                        ->with('success', 'Event berhasil dihapus!');
    }

    /**
     * Toggle event featured status
     */
    public function toggleFeatured(Event $event)
    {
        $user = $this->getCurrentUser();
        
        // Only admin can toggle featured status
        if (!$user->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah status featured.');
        }

        $event->toggleFeatured();

        $message = $event->is_featured ? 'Event ditandai sebagai featured!' : 'Event dihapus dari featured!';
        
        return response()->json([
            'success' => true,
            'message' => $message,
            'is_featured' => $event->is_featured
        ]);
    }

    /**
     * Change event status
     */
    public function changeStatus(Request $request, Event $event)
    {
        $user = $this->getCurrentUser();
        
        // Penulis hanya bisa mengubah status event mereka sendiri
        if ($user->isPenulis() && $event->author_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah status event ini.');
        }

        $request->validate([
            'status' => 'required|in:draft,published,cancelled,completed'
        ]);

        $oldStatus = $event->status;
        $newStatus = $request->status;

        // Update published_at if changing to published
        if ($newStatus === 'published' && $oldStatus !== 'published') {
            $event->update([
                'status' => $newStatus,
                'published_at' => now()
            ]);
        } elseif ($newStatus !== 'published') {
            $event->update([
                'status' => $newStatus,
                'published_at' => null
            ]);
        } else {
            $event->update(['status' => $newStatus]);
        }

        $statusNames = [
            'draft' => 'Draft',
            'published' => 'Published',
            'cancelled' => 'Cancelled',
            'completed' => 'Completed'
        ];

        return response()->json([
            'success' => true,
            'message' => "Status event berhasil diubah ke {$statusNames[$newStatus]}!",
            'status' => $newStatus
        ]);
    }

    /**
     * Bulk actions for events
     */
    public function bulkAction(Request $request)
    {
        $user = $this->getCurrentUser();
        
        $request->validate([
            'action' => 'required|in:delete,publish,draft,cancel,complete',
            'events' => 'required|array',
            'events.*' => 'exists:events,id'
        ]);

        $query = Event::whereIn('id', $request->events);
        
        // Penulis hanya bisa bulk action event mereka sendiri
        if ($user->isPenulis()) {
            $query->where('author_id', $user->id);
        }

        $events = $query->get();
        
        if ($events->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada event yang ditemukan atau Anda tidak memiliki akses.'
            ]);
        }

        $count = 0;
        foreach ($events as $event) {
            switch ($request->action) {
                case 'delete':
                    // Delete associated images
                    if ($event->featured_image) {
                        Storage::disk('public')->delete($event->featured_image);
                    }
                    if ($event->gallery) {
                        foreach ($event->gallery as $imagePath) {
                            Storage::disk('public')->delete($imagePath);
                        }
                    }
                    if ($event->og_image) {
                        Storage::disk('public')->delete($event->og_image);
                    }
                    $event->delete();
                    $count++;
                    break;
                
                case 'publish':
                    $event->update([
                        'status' => 'published',
                        'published_at' => $event->published_at ?? now()
                    ]);
                    $count++;
                    break;
                
                case 'draft':
                    $event->update([
                        'status' => 'draft',
                        'published_at' => null
                    ]);
                    $count++;
                    break;

                case 'cancel':
                    $event->update(['status' => 'cancelled']);
                    $count++;
                    break;

                case 'complete':
                    $event->update(['status' => 'completed']);
                    $count++;
                    break;
            }
        }

        $actionNames = [
            'delete' => 'dihapus',
            'publish' => 'dipublish',
            'draft' => 'diubah ke draft',
            'cancel' => 'dibatalkan',
            'complete' => 'diselesaikan'
        ];

        return response()->json([
            'success' => true,
            'message' => "{$count} event berhasil {$actionNames[$request->action]}!"
        ]);
    }
}
