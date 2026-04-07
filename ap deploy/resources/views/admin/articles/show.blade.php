@extends('admin.layout-simple')

@section('title', 'Detail Artikel - ' . $article->title)

@section('content')
<div class="container-fluid">    <!-- Modern Article Header with Gradient Background -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card article-hero-card border-0 shadow-lg overflow-hidden">
                <div class="card-body position-relative p-0">
                    <!-- Hero Background -->
                    <div class="hero-background">
                        <div class="hero-overlay"></div>
                        @if($article->featured_image)
                            <img src="{{ asset('storage/' . $article->featured_image) }}" 
                                 alt="{{ $article->title }}" 
                                 class="hero-bg-image">
                        @endif
                    </div>
                    
                    <!-- Hero Content -->
                    <div class="hero-content p-5">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1 me-4">
                                <!-- Badges -->
                                <div class="d-flex align-items-center flex-wrap gap-2 mb-4">
                                    @if($article->category)
                                        <span class="badge hero-badge bg-primary">
                                            <i class="fas fa-folder me-1"></i>{{ $article->category }}
                                        </span>
                                    @endif
                                    @php
                                        $statusClass = match($article->status) {
                                            'published' => 'bg-success',
                                            'draft' => 'bg-warning',
                                            'archived' => 'bg-secondary',
                                            default => 'bg-secondary'
                                        };
                                        $statusText = match($article->status) {
                                            'published' => 'Published',
                                            'draft' => 'Draft',
                                            'archived' => 'Archived',
                                            default => ucfirst($article->status)
                                        };
                                    @endphp
                                    <span class="badge hero-badge {{ $statusClass }}">
                                        <i class="fas fa-circle me-1" style="font-size: 0.6rem;"></i>{{ $statusText }}
                                    </span>
                                    @if($article->is_featured)
                                        <span class="badge hero-badge bg-warning text-dark">
                                            <i class="fas fa-star me-1"></i>Featured
                                        </span>
                                    @endif
                                    <span class="badge hero-badge bg-info">
                                        <i class="fas fa-eye me-1"></i>{{ number_format($article->view_count ?? 0) }} views
                                    </span>
                                </div>
                                
                                <!-- Title -->
                                <h1 class="display-4 mb-4 text-white fw-bold article-hero-title">
                                    {{ $article->title }}
                                </h1>
                                
                                <!-- Excerpt -->
                                @if($article->excerpt)
                                    <p class="lead text-white-75 mb-4 hero-excerpt">
                                        {{ $article->excerpt }}
                                    </p>
                                @endif                                <!-- Author & Meta Info -->
                                <div class="hero-meta d-flex flex-wrap align-items-center gap-4">
                                    <div class="d-flex align-items-center">
                                        <div class="author-avatar me-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name ?? 'Unknown') }}&background=ffffff&color=6366f1&size=48" 
                                                 alt="{{ $article->author->name ?? 'Unknown' }}" 
                                                 class="rounded-circle border border-white border-3 shadow">
                                        </div>
                                        <div>
                                            <div class="text-white fw-semibold">{{ $article->author->name ?? 'Unknown Author' }}</div>
                                            <small class="text-white-75">Author</small>
                                        </div>
                                    </div>
                                    <div class="hero-meta-divider"></div>
                                    <div class="d-flex align-items-center text-white-75">
                                        <i class="fas fa-calendar me-2"></i>
                                        <span>{{ $article->published_at ? $article->published_at->format('M d, Y') : $article->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="d-flex align-items-center text-white-75">
                                        <i class="fas fa-clock me-2"></i>
                                        <span>{{ $article->reading_time ?? '3 min read' }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="hero-actions d-flex flex-column gap-2">
                                @if(session('admin_role') === 'admin' || $article->author_id === session('admin_user_id'))
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-light btn-action">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </a>
                                @endif
                                <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-light btn-action">
                                    <i class="fas fa-arrow-left me-2"></i>Back
                                </a>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-light btn-action" onclick="printArticle()" title="Print Article">
                                        <i class="fas fa-print"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-light btn-action" onclick="shareArticle()" title="Share Article">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-outline-light btn-action" onclick="toggleBookmark()" title="Bookmark">
                                        <i class="fas fa-bookmark"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">        <!-- Main Content -->
        <div class="col-lg-8">
            <!-- Article Content -->
            <div class="card content-card border-0 shadow-sm">
                <div class="card-body p-5">
                    <!-- Content Header -->
                    <div class="content-header mb-4">
                        <div class="reading-progress">
                            <div class="progress-bar"></div>
                        </div>
                    </div>
                    
                    <!-- Article Body -->
                    <div class="article-content">
                        {!! $article->content !!}
                    </div>
                      <!-- Content Footer -->
                    <div class="content-footer mt-5">
                        <!-- Author Section -->
                        <div class="author-section bg-light rounded-3 p-4 mb-4">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="author-avatar">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name ?? 'Unknown') }}&background=6366f1&color=ffffff&size=60" 
                                             alt="{{ $article->author->name ?? 'Unknown' }}" 
                                             class="rounded-circle shadow-sm">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="author-info">
                                        <h6 class="author-name mb-1 fw-bold text-dark">{{ $article->author->name ?? 'Unknown Author' }}</h6>
                                        <p class="author-role mb-2 text-muted small">{{ $article->author->role_name ?? 'Administrator' }}</p>
                                        <p class="author-action mb-0 text-primary small">
                                            <i class="fas fa-pen-nib me-1"></i>Published this article
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Share Section -->
                        <div class="social-share-section">
                            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                                <div class="share-label mb-3 mb-md-0">
                                    <h6 class="mb-0 fw-semibold text-dark">
                                        <i class="fas fa-share-alt me-2 text-primary"></i>Share this article:
                                    </h6>
                                </div>
                                <div class="share-buttons">
                                    <button class="btn btn-social btn-facebook me-2" onclick="shareToFacebook()" title="Share on Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                        <span class="btn-text">Facebook</span>
                                    </button>
                                    <button class="btn btn-social btn-twitter me-2" onclick="shareToTwitter()" title="Share on Twitter">
                                        <i class="fab fa-twitter"></i>
                                        <span class="btn-text">Twitter</span>
                                    </button>
                                    <button class="btn btn-social btn-whatsapp me-2" onclick="shareToWhatsApp()" title="Share on WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                        <span class="btn-text">WhatsApp</span>
                                    </button>
                                    <button class="btn btn-social btn-copy" onclick="copyLink()" title="Copy Link">
                                        <i class="fas fa-copy"></i>
                                        <span class="btn-text">Copy Link</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            <!-- Tags Section -->
            @if($article->tags)
                <div class="card tags-card mt-4 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="card-title d-flex align-items-center mb-4">
                            <div class="section-icon me-2">
                                <i class="fas fa-tags text-primary"></i>
                            </div>
                            Article Tags
                        </h5>
                        <div class="tags-container">
                            @if(is_array($article->tags))
                                @foreach($article->tags as $tag)
                                    <span class="tag-modern">
                                        <i class="fas fa-hashtag me-1"></i>{{ $tag }}
                                    </span>
                                @endforeach
                            @else
                                @foreach(explode(',', $article->tags) as $tag)
                                    <span class="tag-modern">
                                        <i class="fas fa-hashtag me-1"></i>{{ trim($tag) }}
                                    </span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Navigation Section -->
            <div class="card navigation-card mt-4 border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title d-flex align-items-center mb-4">
                        <div class="section-icon me-2">
                            <i class="fas fa-compass text-primary"></i>
                        </div>
                        More Articles
                    </h5>
                    <div class="row g-3">
                        <!-- Previous Article -->
                        <div class="col-md-6">
                            @php
                                $previousArticle = \App\Models\Article::where('id', '<', $article->id)
                                    ->where('status', 'published')
                                    ->orderBy('id', 'desc')
                                    ->first();
                            @endphp
                            @if($previousArticle)
                                <a href="{{ route('admin.articles.show', $previousArticle) }}" class="nav-card-link">
                                    <div class="nav-card nav-card-prev">
                                        <div class="nav-card-icon">
                                            <i class="fas fa-chevron-left"></i>
                                        </div>
                                        <div class="nav-card-content">
                                            <small class="nav-card-label">Previous Article</small>
                                            <div class="nav-card-title">{{ Str::limit($previousArticle->title, 60) }}</div>
                                            <small class="nav-card-meta">{{ $previousArticle->created_at->format('M d, Y') }}</small>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <div class="nav-card nav-card-disabled">
                                    <div class="nav-card-content text-center">
                                        <i class="fas fa-ban text-muted mb-2"></i>
                                        <small class="text-muted">No previous article</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Next Article -->
                        <div class="col-md-6">
                            @php
                                $nextArticle = \App\Models\Article::where('id', '>', $article->id)
                                    ->where('status', 'published')
                                    ->orderBy('id', 'asc')
                                    ->first();
                            @endphp
                            @if($nextArticle)
                                <a href="{{ route('admin.articles.show', $nextArticle) }}" class="nav-card-link">
                                    <div class="nav-card nav-card-next">
                                        <div class="nav-card-content text-end">
                                            <small class="nav-card-label">Next Article</small>
                                            <div class="nav-card-title">{{ Str::limit($nextArticle->title, 60) }}</div>
                                            <small class="nav-card-meta">{{ $nextArticle->created_at->format('M d, Y') }}</small>
                                        </div>
                                        <div class="nav-card-icon">
                                            <i class="fas fa-chevron-right"></i>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <div class="nav-card nav-card-disabled">
                                    <div class="nav-card-content text-center">
                                        <i class="fas fa-ban text-muted mb-2"></i>
                                        <small class="text-muted">No next article</small>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>        <!-- Modern Sidebar -->
        <div class="col-lg-4">
            <div class="sidebar-sticky">                <!-- Article Statistics -->
                <div class="card stats-card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title d-flex align-items-center mb-0">
                            <i class="fas fa-chart-bar me-2"></i>
                            Article Statistics
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-0">
                            <div class="col-4 text-center border-end">
                                <div class="stat-item">
                                    <div class="stat-value text-primary display-6 fw-bold">{{ number_format($article->view_count ?? 30) }}</div>
                                    <div class="stat-label text-uppercase small text-muted">VIEWS</div>
                                </div>
                            </div>
                            <div class="col-4 text-center border-end">
                                <div class="stat-item">
                                    <div class="stat-value text-success display-6 fw-bold">{{ str_word_count(strip_tags($article->content)) ?: 52 }}</div>
                                    <div class="stat-label text-uppercase small text-muted">WORDS</div>
                                </div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="stat-item">
                                    <div class="stat-value text-info display-6 fw-bold">{{ intval(str_word_count(strip_tags($article->content)) / 200) ?: 1 }}</div>
                                    <div class="stat-label text-uppercase small text-muted">MIN READ</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                <!-- Article Details -->
                <div class="card details-card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title d-flex align-items-center mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Article Details
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        
                        <!-- Status -->
                        <div class="detail-item d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div class="detail-label fw-semibold">Status</div>
                            <div class="detail-value">
                                <span class="badge detail-badge {{ $statusClass }} px-3 py-2">{{ $statusText }}</span>
                            </div>
                        </div>
                        
                        <!-- Author -->
                        <div class="detail-item d-flex justify-content-between align-items-center py-3 border-bottom">
                            <div class="detail-label fw-semibold">Author</div>
                            <div class="detail-value">
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name ?? 'Unknown') }}&background=6366f1&color=ffffff&size=32" 
                                         alt="{{ $article->author->name ?? 'Unknown' }}" 
                                         class="rounded-circle me-2">
                                    <div class="text-end">
                                        <div class="fw-medium">{{ $article->author->name ?? 'Unknown Author' }}</div>
                                        <small class="text-muted">{{ $article->author->role_name ?? 'Administrator' }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Category -->
                        @if($article->category)
                        <div class="detail-item d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div class="detail-label fw-semibold">Category</div>
                            <div class="detail-value">
                                <span class="badge bg-primary px-3 py-2">
                                    <i class="fas fa-folder me-1"></i>{{ $article->category }}
                                </span>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Created -->
                        <div class="detail-item d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div class="detail-label fw-semibold">Created</div>
                            <div class="detail-value text-muted">
                                <i class="fas fa-clock me-1"></i>{{ $article->created_at->format('M d, Y \a\t H:i') }}
                            </div>
                        </div>
                        
                        @if($article->published_at)
                        <!-- Published -->
                        <div class="detail-item d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div class="detail-label fw-semibold">Published</div>
                            <div class="detail-value text-muted">
                                <i class="fas fa-calendar-check me-1"></i>{{ $article->published_at->format('M d, Y \a\t H:i') }}
                            </div>
                        </div>
                        @endif
                        
                        <!-- Last Updated -->
                        <div class="detail-item d-flex justify-content-between align-items-center py-2">
                            <div class="detail-label fw-semibold">Last Updated</div>
                            <div class="detail-value text-muted">
                                <i class="fas fa-edit me-1"></i>{{ $article->updated_at->format('M d, Y \a\t H:i') }}
                            </div>                        </div>
                    </div>
                </div>

                <!-- SEO Information -->                @if($article->meta_title || $article->meta_description || $article->meta_keywords)
                <div class="card seo-card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title d-flex align-items-center mb-0">
                            <i class="fas fa-search me-2"></i>
                            SEO Information
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        
                        @if($article->meta_title)
                        <div class="seo-item mb-3">
                            <div class="seo-label fw-semibold text-dark">Meta Title</div>
                            <div class="seo-value text-muted small bg-light p-2 rounded mt-1">{{ $article->meta_title }}</div>
                        </div>
                        @endif
                        
                        @if($article->meta_description)
                        <div class="seo-item mb-3">
                            <div class="seo-label fw-semibold text-dark">Meta Description</div>
                            <div class="seo-value text-muted small bg-light p-2 rounded mt-1">{{ $article->meta_description }}</div>
                        </div>
                        @endif
                        
                        @if($article->meta_keywords)
                        <div class="seo-item">
                            <div class="seo-label fw-semibold text-dark mb-2">Keywords</div>
                            <div class="seo-value">
                                <div class="keywords-list">
                                    @foreach(explode(',', $article->meta_keywords) as $keyword)
                                        <span class="keyword-tag">{{ trim($keyword) }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Related Articles -->
                @php
                    $relatedArticles = \App\Models\Article::where('category', $article->category)
                        ->where('id', '!=', $article->id)
                        ->where('status', 'published')
                        ->limit(4)
                        ->get();
                @endphp
                @if($relatedArticles->count() > 0)
                <div class="card related-card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="card-title d-flex align-items-center mb-4">
                            <div class="section-icon me-2">
                                <i class="fas fa-newspaper text-primary"></i>
                            </div>
                            Related Articles
                        </h5>
                        
                        <div class="related-articles">
                            @foreach($relatedArticles as $related)
                            <a href="{{ route('admin.articles.show', $related) }}" class="related-article-link">
                                <div class="related-article">
                                    <div class="related-article-image">
                                        @if($related->featured_image)
                                            <img src="{{ asset('storage/' . $related->featured_image) }}" 
                                                 alt="{{ $related->title }}">
                                        @else
                                            <div class="placeholder-image">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="related-article-content">
                                        <div class="related-article-title">{{ Str::limit($related->title, 50) }}</div>
                                        <div class="related-article-meta">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>{{ $related->created_at->format('M d, Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>                </div>                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Modern Article Hero Section */
.article-hero-card {
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 2rem;
}

.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hero-bg-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.3;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(102, 126, 234, 0.9), rgba(118, 75, 162, 0.8));
}

.hero-content {
    position: relative;
    z-index: 10;
    min-height: 300px;
    display: flex;
    align-items: center;
}

.hero-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.article-hero-title {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    line-height: 1.2;
}

.hero-excerpt {
    opacity: 0.95;
    font-size: 1.1rem;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}

.hero-meta {
    margin-top: 2rem;
}

.hero-meta-divider {
    width: 1px;
    height: 30px;
    background: rgba(255, 255, 255, 0.3);
}

.author-avatar img {
    width: 48px;
    height: 48px;
}

.text-white-75 {
    color: rgba(255, 255, 255, 0.75) !important;
}

.hero-actions {
    min-width: 120px;
}

.btn-action {
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border-width: 2px;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* Content Card */
.content-card {
    border-radius: 15px;
    margin-bottom: 2rem;
}

.reading-progress {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

.progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #667eea, #764ba2);
    width: 0%;
    transition: width 0.3s ease;
}

.article-content {
    font-size: 1.125rem;
    line-height: 1.8;
    color: #374151;
}

.article-content h1,
.article-content h2,
.article-content h3,
.article-content h4,
.article-content h5,
.article-content h6 {
    margin-top: 2.5rem;
    margin-bottom: 1.25rem;
    font-weight: 700;
    color: #1f2937;
}

.article-content h1 { font-size: 2.5rem; }
.article-content h2 { font-size: 2rem; }
.article-content h3 { font-size: 1.75rem; }

.article-content p {
    margin-bottom: 1.5rem;
    text-align: justify;
}

.article-content blockquote {
    border-left: 4px solid #667eea;
    padding: 1.5rem;
    margin: 2rem 0;
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    border-radius: 10px;
    font-style: italic;
    position: relative;
}

.article-content blockquote::before {
    content: '"';
    font-size: 4rem;
    color: #667eea;
    position: absolute;
    top: -10px;
    left: 20px;
    opacity: 0.3;
}

/* Content Footer Styling */
.content-footer {
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 2px solid #e5e7eb;
}

.author-section {
    background: linear-gradient(135deg, #f8fafc, #e2e8f0) !important;
    border: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.author-section:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.author-avatar img {
    width: 60px;
    height: 60px;
    border: 3px solid #ffffff;
    transition: all 0.3s ease;
}

.author-avatar:hover img {
    transform: scale(1.05);
}

.author-name {
    color: #1f2937;
    font-size: 1.1rem;
}

.author-role {
    color: #6b7280;
    font-size: 0.875rem;
}

.author-action {
    color: #6366f1;
    font-size: 0.875rem;
    font-weight: 500;
}

/* Social Share Buttons */
.social-share-section {
    margin-top: 1.5rem;
    padding: 1.5rem;
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.share-label h6 {
    color: #374151;
    font-size: 1rem;
}

.share-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.btn-social {
    display: inline-flex;
    align-items: center;
    padding: 10px 16px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}

.btn-social i {
    font-size: 1rem;
    margin-right: 8px;
}

.btn-social .btn-text {
    font-weight: 600;
}

.btn-social:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* Facebook Button */
.btn-facebook {
    background: linear-gradient(135deg, #1877f2, #42a5f5);
    color: white;
    border-color: #1877f2;
}

.btn-facebook:hover {
    background: linear-gradient(135deg, #166fe5, #1565c0);
    color: white;
    box-shadow: 0 8px 20px rgba(24, 119, 242, 0.4);
}

/* Twitter Button */
.btn-twitter {
    background: linear-gradient(135deg, #1da1f2, #42a5f5);
    color: white;
    border-color: #1da1f2;
}

.btn-twitter:hover {
    background: linear-gradient(135deg, #1a94da, #1976d2);
    color: white;
    box-shadow: 0 8px 20px rgba(29, 161, 242, 0.4);
}

/* WhatsApp Button */
.btn-whatsapp {
    background: linear-gradient(135deg, #25d366, #4caf50);
    color: white;
    border-color: #25d366;
}

.btn-whatsapp:hover {
    background: linear-gradient(135deg, #20ba5a, #388e3c);
    color: white;
    box-shadow: 0 8px 20px rgba(37, 211, 102, 0.4);
}

/* Copy Button */
.btn-copy {
    background: linear-gradient(135deg, #6b7280, #9ca3af);
    color: white;
    border-color: #6b7280;
}

.btn-copy:hover {
    background: linear-gradient(135deg, #4b5563, #6b7280);
    color: white;
    box-shadow: 0 8px 20px rgba(107, 114, 128, 0.4);
}

/* Responsive Social Buttons */
@media (max-width: 768px) {
    .share-buttons {
        justify-content: center;
    }
    
    .btn-social {
        flex: 1;
        min-width: 120px;
        justify-content: center;
    }
    
    .social-share-section {
        padding: 1rem;
    }
    
    .share-label {
        text-align: center;
        margin-bottom: 1rem;
    }
}

/* Tags Section */
.tags-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.tag-modern {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}

.tag-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    color: white;
    text-decoration: none;
}

/* Navigation Cards */
.nav-card {
    padding: 1.5rem;
    border-radius: 15px;
    background: white;
    border: 2px solid #e5e7eb;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    align-items: center;
    text-decoration: none;
}

.nav-card:hover {
    border-color: #667eea;
    box-shadow: 0 10px 25px rgba(102, 126, 234, 0.15);
    transform: translateY(-3px);
}

.nav-card-link {
    text-decoration: none;
    color: inherit;
}

.nav-card-link:hover {
    text-decoration: none;
    color: inherit;
}

.nav-card-icon {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
}

.nav-card-next .nav-card-icon {
    margin-right: 0;
    margin-left: 1rem;
}

.nav-card-title {
    font-weight: 600;
    color: #1f2937;
    margin: 0.5rem 0;
    line-height: 1.4;
}

.nav-card-label {
    color: #6b7280;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-size: 0.75rem;
}

.nav-card-meta {
    color: #9ca3af;
    font-size: 0.875rem;
}

.nav-card-disabled {
    background: #f9fafb;
    border-color: #e5e7eb;
    color: #9ca3af;
}

/* Sidebar Styling */
.sidebar-sticky {
    position: sticky;
    top: 2rem;
}

.section-icon {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
}

/* Stats Card */
.stat-item {
    padding: 1rem;
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    border-radius: 10px;
    transition: all 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.75rem;
    color: #6b7280;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Detail Items */
.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 1rem 0;
    border-bottom: 1px solid #f3f4f6;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 600;
    color: #374151;
    min-width: 80px;
}

.detail-value {
    flex: 1;
    text-align: right;
}

.detail-badge {
    font-size: 0.8rem;
    padding: 6px 12px;
    border-radius: 15px;
}

/* SEO Card */
.seo-item {
    margin-bottom: 1.5rem;
}

.seo-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.seo-value {
    color: #6b7280;
    font-size: 0.875rem;
    line-height: 1.5;
}

.keywords-list {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.keyword-tag {
    background: #e0e7ff;
    color: #3730a3;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
}

/* Related Articles */
.related-articles {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.related-article-link {
    text-decoration: none;
    color: inherit;
}

.related-article {
    display: flex;
    padding: 1rem;
    background: #f8fafc;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.related-article:hover {
    background: #e2e8f0;
    transform: translateX(5px);
}

.related-article-image {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
    margin-right: 1rem;
    flex-shrink: 0;
}

.related-article-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.placeholder-image {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #e5e7eb, #d1d5db);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
}

.related-article-content {
    flex: 1;
}

.related-article-title {
    font-weight: 600;
    color: #1f2937;
    line-height: 1.3;
    margin-bottom: 0.5rem;
}

.related-article-meta {
    color: #6b7280;
    font-size: 0.75rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-content {
        min-height: 250px;
    }
    
    .article-hero-title {
        font-size: 2rem !important;
    }
    
    .hero-actions {
        margin-top: 2rem;
        min-width: auto;
    }
    
    .hero-actions .btn-group {
        width: 100%;
    }
    
    .hero-actions .btn-action {
        flex: 1;
    }
    
    .nav-card {
        padding: 1rem;
    }
    
    .article-content {
        font-size: 1rem;
    }
    
    .sidebar-sticky {
        position: static;
        margin-top: 2rem;
    }
}

/* Card animations */
.card {
    border: none;/* Card animations */
.card {
    border: none;
    transition: all 0.3s ease;
}

.shadow-sm {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
}

.border-0 {
    border: none !important;
}

/* Card headers */
.card-header {
    border-radius: 10px 10px 0 0 !important;
    border-bottom: none !important;
    font-weight: 600;
}

.card-body {
    padding: 1.5rem;
}

/* Related articles styling */
.related-article-image {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    overflow: hidden;
    flex-shrink: 0;
}

.related-article-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.placeholder-image {
    width: 100%;
    height: 100%;
    background: #f8f9fa;
    color: #6c757d;
    font-size: 1rem;
}

/* Statistics styling */
.stat-item {
    padding: 1rem 0;
}

.stat-value {
    line-height: 1;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    font-weight: 600;
}

/* Detail items */
.detail-item {
    min-height: 50px;
}

.detail-label {
    font-size: 0.9rem;
}

.detail-value {
    font-size: 0.9rem;
}

/* SEO styling */
.seo-label {
    font-size: 0.85rem;
    margin-bottom: 0.5rem;
}

.seo-value {
    font-size: 0.8rem;
    line-height: 1.4;
}

.keyword-tag {
    background: #e3f2fd;
    color: #1976d2;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
    display: inline-block;
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .col-lg-8 {
        margin-bottom: 2rem;
    }
    
    .article-content {
        font-size: 1rem;
    }
    
    .article-content h1 { font-size: 2rem; }
    .article-content h2 { font-size: 1.75rem; }
    .article-content h3 { font-size: 1.5rem; }
    
    .hero-content {
        min-height: 200px;
    }
    
    .article-hero-title {
        font-size: 2rem !important;
    }
}

/* Print styles */
@media print {
    .btn, .card-header, .sidebar, .hero-actions {
        display: none !important;
    }
    
    .card {
        box-shadow: none !important;
        border: 1px solid #dee2e6 !important;
    }
    
    .article-content {
        font-size: 12pt;
        line-height: 1.6;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for internal links
    const links = document.querySelectorAll('a[href*="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href.startsWith('#')) {
                e.preventDefault();
                const targetId = href.substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
    
    // Add ripple effect to buttons
    const buttons = document.querySelectorAll('.btn');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
});

// Print article function
function printArticle() {
    const printWindow = window.open('', '_blank');
    const articleTitle = {!! json_encode($article->title) !!};
    const articleContent = document.querySelector('.article-content').innerHTML;
    const articleMeta = '<div style="margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid #eee;">' +
        '<h1 style="margin-bottom: 1rem; color: #333;">' + articleTitle + '</h1>' +
        '<div style="color: #666; font-size: 14px;">' +
        '<strong>Author:</strong> {{ $article->author->name ?? "Unknown" }} | ' +
        '<strong>Published:</strong> {{ $article->published_at ? $article->published_at->format("M d, Y") : $article->created_at->format("M d, Y") }}' +
        '</div>' +
        '</div>';
    
    printWindow.document.write('<!DOCTYPE html><html><head><title>Print: ' + articleTitle + '</title>' +
        '<style>body { font-family: Arial, sans-serif; line-height: 1.6; margin: 2rem; color: #333; }' +
        'h1, h2, h3, h4, h5, h6 { color: #333; margin-top: 2rem; margin-bottom: 1rem; }' +
        'p { margin-bottom: 1rem; text-align: justify; }' +
        'img { max-width: 100%; height: auto; }' +
        'blockquote { border-left: 4px solid #ddd; padding-left: 1rem; margin: 1rem 0; font-style: italic; }' +
        '@media print { body { margin: 0; } }</style></head><body>' +
        articleMeta + articleContent + '</body></html>');
    
    printWindow.document.close();
    printWindow.focus();
    setTimeout(() => {
        printWindow.print();
        printWindow.close();
    }, 250);
}

// Share article function
function shareArticle() {
    const shareData = {
        title: {!! json_encode($article->title) !!},
        text: {!! json_encode($article->excerpt ?? "Read this amazing article") !!},
        url: window.location.href
    };
    
    if (navigator.share) {
        navigator.share(shareData).catch(console.error);
    } else {
        navigator.clipboard.writeText(window.location.href).then(() => {
            showNotification('Article link copied to clipboard!', 'success');
        }).catch(() => {
            showNotification('Unable to copy link', 'error');
        });
    }
}

// Social media sharing functions
function shareToFacebook() {
    const url = encodeURIComponent(window.location.href);
    window.open('https://www.facebook.com/sharer/sharer.php?u=' + url, '_blank', 'width=600,height=400');
}

function shareToTwitter() {
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent({!! json_encode($article->title) !!});
    window.open('https://twitter.com/intent/tweet?url=' + url + '&text=' + text, '_blank', 'width=600,height=400');
}

function shareToWhatsApp() {
    const url = encodeURIComponent(window.location.href);
    const text = encodeURIComponent({!! json_encode($article->title . ' - ') !!});
    window.open('https://wa.me/?text=' + text + url, '_blank');
}

function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        showNotification('Link copied to clipboard!', 'success');
    }).catch(() => {
        showNotification('Unable to copy link', 'error');
    });
}

// Bookmark toggle function
function toggleBookmark() {
    const button = event.target.closest('button');
    const icon = button.querySelector('i');
    
    if (icon.classList.contains('fas')) {
        icon.classList.remove('fas');
        icon.classList.add('far');
        showNotification('Bookmark removed', 'info');
    } else {
        icon.classList.remove('far');
        icon.classList.add('fas');
        showNotification('Article bookmarked!', 'success');
    }
}

// Notification function
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = 'alert alert-' + type + ' alert-dismissible fade show position-fixed';
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = message + '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>

<style>
/* Ripple effect */
.btn {
    position: relative;
    overflow: hidden;
}

.ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.6);
    transform: scale(0);
    animation: ripple-animation 0.6s linear;
    pointer-events: none;
}

@keyframes ripple-animation {
    to {
        transform: scale(4);
        opacity: 0;
    }
}
</style>

@endsection
