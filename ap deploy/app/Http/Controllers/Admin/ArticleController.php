<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{    public function __construct()
    {
        // Routes are already protected by admin.auth middleware in web.php
        // Just add role-based access control
        $this->middleware(function ($request, $next) {
            // Get user from session (since we're using session-based auth)
            $userId = session('admin_user_id');
            $userRole = session('admin_role');
            
            if (!$userId || !$userRole) {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
            
            // Check if user has permission to access articles
            if ($userRole !== 'admin' && $userRole !== 'penulis') {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
            
            return $next($request);        });
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
     * Display a listing of the articles.
     */    public function index(Request $request)
    {
        $user = $this->getCurrentUser();
        $query = Article::with('author');

        // Penulis hanya bisa melihat artikel mereka sendiri
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

        // Filter berdasarkan author (hanya untuk admin)
        if ($request->filled('author') && $user->isAdmin()) {
            $query->where('author_id', $request->author);
        }

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Sorting
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortField, $sortDirection);

        $articles = $query->paginate(15)->withQueryString();

        // Data untuk filter
        $categories = Article::getCategories();
        $authors = $user->isAdmin() ? User::where('role', 'penulis')->orWhere('role', 'admin')->get() : null;

        return view('admin.articles.index', compact('articles', 'categories', 'authors'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        $categories = Article::getCategories();
        $tags = Article::getAllTags();
        
        return view('admin.articles.create', compact('categories', 'tags'));
    }    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'allow_comments' => 'boolean',
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

        // Debug: Check if title exists
        if (!$validated['title']) {
            return back()->withErrors(['title' => 'Judul artikel wajib diisi'])->withInput();
        }

        // Process tags
        $tags = null;
        if ($request->filled('tags')) {
            $tags = array_map('trim', explode(',', $request->tags));
            $tags = array_filter($tags); // Remove empty tags
        }

        // Handle featured image upload
        $featuredImagePath = null;
        if ($request->hasFile('featured_image')) {
            $featuredImagePath = $request->file('featured_image')->store('articles/featured', 'public');
        }

        // Handle gallery images upload
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('articles/gallery', 'public');
            }
        }

        // Handle OG image upload
        $ogImagePath = null;
        if ($request->hasFile('og_image')) {
            $ogImagePath = $request->file('og_image')->store('articles/og', 'public');
        }        // Generate unique slug
        $baseSlug = \Illuminate\Support\Str::slug($validated['title']);
        $slug = $baseSlug;
        $count = 1;
        
        while (Article::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        // Prepare article data with explicit field mapping
        $articleData = [
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'category' => $validated['category'],
            'status' => $validated['status'],
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description'],
            'meta_keywords' => $validated['meta_keywords'],
            'canonical_url' => $validated['canonical_url'],
            'og_title' => $validated['og_title'],
            'og_description' => $validated['og_description'],
            'author_id' => session('admin_user_id'),
            'featured_image' => $featuredImagePath,
            'gallery' => !empty($galleryPaths) ? $galleryPaths : null,
            'tags' => $tags,
            'og_image' => $ogImagePath,
            'is_featured' => $request->has('is_featured'),
            'allow_comments' => $request->has('allow_comments'),
        ];

        // Set published_at if status is published
        if ($validated['status'] === 'published') {
            $articleData['published_at'] = now();
        }

        try {
            $article = Article::create($articleData);
            
            return redirect()->route('admin.articles.index')
                            ->with('success', 'Artikel berhasil dibuat!');
        } catch (\Exception $e) {
            \Log::error('Error creating article: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan artikel: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified article.
     */    public function show(Article $article)
    {
        $user = $this->getCurrentUser();
        
        // Penulis hanya bisa melihat artikel mereka sendiri
        if ($user->isPenulis() && $article->author_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses ke artikel ini.');
        }

        $article->load('author');
        $relatedArticles = $article->getRelatedArticles();

        return view('admin.articles.show', compact('article', 'relatedArticles'));
    }

    /**
     * Show the form for editing the specified article.
     */    public function edit(Article $article)
    {
        $user = $this->getCurrentUser();
        
        // Penulis hanya bisa edit artikel mereka sendiri
        if ($user->isPenulis() && $article->author_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit artikel ini.');
        }        $categories = Article::getCategories();
        $tags = Article::getAllTags();
        
        return view('admin.articles.edit', compact('article', 'categories', 'tags'));
    }

    /**
     * Update the specified article in storage.
     */    public function update(Request $request, Article $article)
    {
        $user = $this->getCurrentUser();
        
        // Penulis hanya bisa update artikel mereka sendiri
        if ($user->isPenulis() && $article->author_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate artikel ini.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'allow_comments' => 'boolean',
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
        $featuredImagePath = $article->featured_image;
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
            $featuredImagePath = $request->file('featured_image')->store('articles/featured', 'public');
        }

        // Handle gallery images
        $galleryPaths = $article->gallery ?? [];
        
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
                $galleryPaths[] = $file->store('articles/gallery', 'public');
            }
        }

        // Handle OG image
        $ogImagePath = $article->og_image;
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
            $ogImagePath = $request->file('og_image')->store('articles/og', 'public');
        }

        // Update article
        $articleData = $validated;
        $articleData['featured_image'] = $featuredImagePath;
        $articleData['gallery'] = !empty($galleryPaths) ? $galleryPaths : null;
        $articleData['tags'] = $tags;
        $articleData['og_image'] = $ogImagePath;
        $articleData['is_featured'] = $request->has('is_featured');
        $articleData['allow_comments'] = $request->has('allow_comments');

        // Handle published_at
        if ($validated['status'] === 'published' && !$article->published_at) {
            $articleData['published_at'] = now();
        } elseif ($validated['status'] !== 'published') {
            $articleData['published_at'] = null;
        }

        // Update slug if title changed
        if ($article->title !== $validated['title']) {
            $articleData['slug'] = $article->generateUniqueSlug($validated['title']);
        }

        $article->update($articleData);

        return redirect()->route('admin.articles.index')
                        ->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Remove the specified article from storage.
     */    public function destroy(Article $article)
    {
        $user = $this->getCurrentUser();
        
        // Penulis hanya bisa hapus artikel mereka sendiri
        if ($user->isPenulis() && $article->author_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus artikel ini.');
        }

        // Delete associated images
        if ($article->featured_image) {
            Storage::disk('public')->delete($article->featured_image);
        }
        
        if ($article->gallery) {
            foreach ($article->gallery as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }
        
        if ($article->og_image) {
            Storage::disk('public')->delete($article->og_image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
                        ->with('success', 'Artikel berhasil dihapus!');
    }

    /**
     * Toggle article featured status
     */    public function toggleFeatured(Article $article)
    {
        $user = $this->getCurrentUser();
        
        // Only admin can toggle featured status
        if (!$user->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah status featured.');
        }

        $article->toggleFeatured();

        $message = $article->is_featured ? 'Artikel ditandai sebagai featured!' : 'Artikel dihapus dari featured!';
        
        return response()->json([
            'success' => true,
            'message' => $message,
            'is_featured' => $article->is_featured
        ]);
    }

    /**
     * Change article status
     */    public function changeStatus(Request $request, Article $article)
    {
        $user = $this->getCurrentUser();
        
        // Penulis hanya bisa mengubah status artikel mereka sendiri
        if ($user->isPenulis() && $article->author_id !== $user->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah status artikel ini.');
        }

        $request->validate([
            'status' => 'required|in:draft,published,archived'
        ]);

        $oldStatus = $article->status;
        $newStatus = $request->status;

        // Update published_at if changing to published
        if ($newStatus === 'published' && $oldStatus !== 'published') {
            $article->update([
                'status' => $newStatus,
                'published_at' => now()
            ]);
        } elseif ($newStatus !== 'published') {
            $article->update([
                'status' => $newStatus,
                'published_at' => null
            ]);
        } else {
            $article->update(['status' => $newStatus]);
        }

        $statusNames = [
            'draft' => 'Draft',
            'published' => 'Published',
            'archived' => 'Archived'
        ];

        return response()->json([
            'success' => true,
            'message' => "Status artikel berhasil diubah ke {$statusNames[$newStatus]}!",
            'status' => $newStatus
        ]);
    }

    /**
     * Bulk actions for articles
     */    public function bulkAction(Request $request)
    {
        $user = $this->getCurrentUser();
        
        $request->validate([
            'action' => 'required|in:delete,publish,draft,archive',
            'articles' => 'required|array',
            'articles.*' => 'exists:articles,id'
        ]);

        $query = Article::whereIn('id', $request->articles);
        
        // Penulis hanya bisa bulk action artikel mereka sendiri
        if ($user->isPenulis()) {
            $query->where('author_id', $user->id);
        }

        $articles = $query->get();
        
        if ($articles->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada artikel yang ditemukan atau Anda tidak memiliki akses.'
            ]);
        }

        $count = 0;
        foreach ($articles as $article) {
            switch ($request->action) {
                case 'delete':
                    // Delete associated images
                    if ($article->featured_image) {
                        Storage::disk('public')->delete($article->featured_image);
                    }
                    if ($article->gallery) {
                        foreach ($article->gallery as $imagePath) {
                            Storage::disk('public')->delete($imagePath);
                        }
                    }
                    if ($article->og_image) {
                        Storage::disk('public')->delete($article->og_image);
                    }
                    $article->delete();
                    $count++;
                    break;
                
                case 'publish':
                    $article->update([
                        'status' => 'published',
                        'published_at' => $article->published_at ?? now()
                    ]);
                    $count++;
                    break;
                
                case 'draft':
                    $article->update([
                        'status' => 'draft',
                        'published_at' => null
                    ]);
                    $count++;
                    break;
                
                case 'archive':
                    $article->update(['status' => 'archived']);
                    $count++;
                    break;
            }
        }

        $actionNames = [
            'delete' => 'dihapus',
            'publish' => 'dipublish',
            'draft' => 'diubah ke draft',
            'archive' => 'diarsipkan'
        ];

        return response()->json([
            'success' => true,
            'message' => "{$count} artikel berhasil {$actionNames[$request->action]}!"
        ]);
    }
}
