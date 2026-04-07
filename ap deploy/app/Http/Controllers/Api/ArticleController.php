<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    /**
     * Get all published articles for frontend
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = Article::with('author:id,name,role')
                           ->published()
                           ->orderBy('published_at', 'desc');

            // Search functionality
            if ($request->filled('search')) {
                $query->search($request->search);
            }

            // Filter by category
            if ($request->filled('category')) {
                $query->where('category', $request->category);
            }

            // Filter by tag
            if ($request->filled('tag')) {
                $query->whereJsonContains('tags', $request->tag);
            }

            // Featured articles only
            if ($request->boolean('featured')) {
                $query->where('is_featured', true);
            }

            // Pagination
            $perPage = min($request->get('per_page', 12), 50); // Max 50 per page
            $articles = $query->paginate($perPage);

            // Transform data for frontend
            $articles->getCollection()->transform(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'excerpt' => $article->excerpt,
                    'featured_image' => $article->featured_image ? asset('storage/' . $article->featured_image) : null,
                    'category' => $article->category,
                    'tags' => $article->tags ?? [],
                    'author' => [
                        'name' => $article->author->name,
                        'role' => $article->author->role,
                    ],
                    'published_at' => $article->published_at->format('Y-m-d H:i:s'),
                    'formatted_date' => $article->published_at->format('d M Y'),
                    'view_count' => $article->view_count,
                    'reading_time' => $article->reading_time,
                    'is_featured' => $article->is_featured,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $articles->items(),
                'pagination' => [
                    'current_page' => $articles->currentPage(),
                    'last_page' => $articles->lastPage(),
                    'per_page' => $articles->perPage(),
                    'total' => $articles->total(),
                    'from' => $articles->firstItem(),
                    'to' => $articles->lastItem(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch articles',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Get featured articles for homepage
     */
    public function featured(Request $request): JsonResponse
    {
        try {
            $limit = min($request->get('limit', 6), 20); // Max 20 featured articles
            
            $articles = Article::with('author:id,name,role')
                              ->published()
                              ->featured()
                              ->orderBy('published_at', 'desc')
                              ->limit($limit)
                              ->get();

            $articles->transform(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'excerpt' => $article->excerpt,
                    'featured_image' => $article->featured_image ? asset('storage/' . $article->featured_image) : null,
                    'category' => $article->category,
                    'tags' => $article->tags ?? [],
                    'author' => [
                        'name' => $article->author->name,
                        'role' => $article->author->role,
                    ],
                    'published_at' => $article->published_at->format('Y-m-d H:i:s'),
                    'formatted_date' => $article->published_at->format('d M Y'),
                    'view_count' => $article->view_count,
                    'reading_time' => $article->reading_time,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $articles
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch featured articles',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Get latest articles
     */
    public function latest(Request $request): JsonResponse
    {
        try {
            $limit = min($request->get('limit', 5), 20);
            
            $articles = Article::with('author:id,name,role')
                              ->published()
                              ->orderBy('published_at', 'desc')
                              ->limit($limit)
                              ->get();

            $articles->transform(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'excerpt' => $article->excerpt,
                    'featured_image' => $article->featured_image ? asset('storage/' . $article->featured_image) : null,
                    'category' => $article->category,
                    'author' => [
                        'name' => $article->author->name,
                    ],
                    'published_at' => $article->published_at->format('Y-m-d H:i:s'),
                    'formatted_date' => $article->published_at->format('d M Y'),
                    'reading_time' => $article->reading_time,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $articles
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch latest articles',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Show single article
     */
    public function show(string $slug): JsonResponse
    {
        try {
            $article = Article::with(['author:id,name,role,email'])
                             ->where('slug', $slug)
                             ->published()
                             ->first();

            if (!$article) {
                return response()->json([
                    'success' => false,
                    'message' => 'Article not found'
                ], 404);
            }

            // Increment view count
            $article->incrementViewCount();

            // Get related articles
            $relatedArticles = $article->getRelatedArticles(4);

            $articleData = [
                'id' => $article->id,
                'title' => $article->title,
                'slug' => $article->slug,
                'excerpt' => $article->excerpt,
                'content' => $article->content,
                'featured_image' => $article->featured_image ? asset('storage/' . $article->featured_image) : null,
                'gallery' => $article->gallery ? array_map(function($path) {
                    return asset('storage/' . $path);
                }, $article->gallery) : [],
                'category' => $article->category,
                'tags' => $article->tags ?? [],
                'author' => [
                    'name' => $article->author->name,
                    'role' => $article->author->role,
                    'email' => $article->author->email,
                ],
                'published_at' => $article->published_at->format('Y-m-d H:i:s'),
                'formatted_date' => $article->published_at->format('d M Y'),
                'view_count' => $article->view_count,
                'reading_time' => $article->reading_time,
                'is_featured' => $article->is_featured,
                'allow_comments' => $article->allow_comments,
                
                // SEO Data
                'seo' => [
                    'meta_title' => $article->meta_title ?: $article->title,
                    'meta_description' => $article->meta_description ?: $article->excerpt,
                    'meta_keywords' => $article->meta_keywords,
                    'canonical_url' => $article->canonical_url,
                    'og_title' => $article->og_title ?: $article->meta_title ?: $article->title,
                    'og_description' => $article->og_description ?: $article->meta_description ?: $article->excerpt,
                    'og_image' => $article->og_image ? asset('storage/' . $article->og_image) : 
                                 ($article->featured_image ? asset('storage/' . $article->featured_image) : null),
                ],
                
                // Related articles
                'related_articles' => $relatedArticles->map(function ($related) {
                    return [
                        'id' => $related->id,
                        'title' => $related->title,
                        'slug' => $related->slug,
                        'excerpt' => $related->excerpt,
                        'featured_image' => $related->featured_image ? asset('storage/' . $related->featured_image) : null,
                        'category' => $related->category,
                        'published_at' => $related->published_at->format('Y-m-d H:i:s'),
                        'formatted_date' => $related->published_at->format('d M Y'),
                        'view_count' => $related->view_count,
                    ];
                }),
            ];

            return response()->json([
                'success' => true,
                'data' => $articleData
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch article',
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
            $categories = Article::published()
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
            $articles = Article::published()
                              ->whereNotNull('tags')
                              ->get(['tags']);

            $allTags = [];
            foreach ($articles as $article) {
                if ($article->tags) {
                    $allTags = array_merge($allTags, $article->tags);
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
     * Search articles
     */
    public function search(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'q' => 'required|string|min:2|max:100',
                'per_page' => 'nullable|integer|min:1|max:50'
            ]);

            $query = Article::with('author:id,name,role')
                           ->published()
                           ->search($request->q)
                           ->orderBy('published_at', 'desc');

            $perPage = min($request->get('per_page', 12), 50);
            $articles = $query->paginate($perPage);

            $articles->getCollection()->transform(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'excerpt' => $article->excerpt,
                    'featured_image' => $article->featured_image ? asset('storage/' . $article->featured_image) : null,
                    'category' => $article->category,
                    'tags' => $article->tags ?? [],
                    'author' => [
                        'name' => $article->author->name,
                    ],
                    'published_at' => $article->published_at->format('Y-m-d H:i:s'),
                    'formatted_date' => $article->published_at->format('d M Y'),
                    'view_count' => $article->view_count,
                    'reading_time' => $article->reading_time,
                ];
            });

            return response()->json([
                'success' => true,
                'query' => $request->q,
                'data' => $articles->items(),
                'pagination' => [
                    'current_page' => $articles->currentPage(),
                    'last_page' => $articles->lastPage(),
                    'per_page' => $articles->perPage(),
                    'total' => $articles->total(),
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

    /**
     * Get popular articles (most viewed)
     */
    public function popular(Request $request): JsonResponse
    {
        try {
            $limit = min($request->get('limit', 10), 20);
            
            $articles = Article::with('author:id,name,role')
                              ->published()
                              ->orderBy('view_count', 'desc')
                              ->orderBy('published_at', 'desc')
                              ->limit($limit)
                              ->get();

            $articles->transform(function ($article) {
                return [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'excerpt' => $article->excerpt,
                    'featured_image' => $article->featured_image ? asset('storage/' . $article->featured_image) : null,
                    'category' => $article->category,
                    'author' => [
                        'name' => $article->author->name,
                    ],
                    'published_at' => $article->published_at->format('Y-m-d H:i:s'),
                    'formatted_date' => $article->published_at->format('d M Y'),
                    'view_count' => $article->view_count,
                    'reading_time' => $article->reading_time,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $articles
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch popular articles',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
