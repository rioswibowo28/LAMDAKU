@extends('admin.layout-simple')

@section('title', 'Detail Artikel')

@section('content')
<div class="container-fluid p-0">
    @if($errors->any())
        <div class="alert alert-danger mx-3 mt-3">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Hero Section with Featured Image -->
    @if($article->featured_image && file_exists(public_path('storage/' . $article->featured_image)))
    <div class="article-hero position-relative">
        <div class="hero-image-container">
            <img src="{{ asset('storage/' . $article->featured_image) }}" 
                 alt="{{ $article->title }}" class="hero-image"
                 onerror="this.style.display='none'; this.parentElement.style.display='none';">
            <div class="hero-overlay"></div>
        </div>
        <div class="hero-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="hero-text text-center text-white">
                            <div class="mb-3">
                                @if($article->category)
                                    <span class="badge bg-primary-glass fs-6 px-3 py-2 me-2">
                                        <i class="fas fa-folder me-1"></i>{{ $article->category }}
                                    </span>
                                @endif
                                @php
                                    $statusClass = match($article->status ?? 'draft') {
                                        'published' => 'bg-success-glass',
                                        'draft' => 'bg-warning-glass',
                                        'archived' => 'bg-secondary-glass',
                                        default => 'bg-secondary-glass'
                                    };
                                    $statusText = match($article->status ?? 'draft') {
                                        'published' => 'Published',
                                        'draft' => 'Draft',
                                        'archived' => 'Archived',
                                        default => $article->status ?? 'Draft'
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }} fs-6 px-3 py-2">{{ $statusText }}</span>
                                @if($article->is_featured)
                                    <span class="badge bg-warning-glass fs-6 px-3 py-2 ms-2">
                                        <i class="fas fa-star me-1"></i>Featured
                                    </span>
                                @endif
                            </div>
                            <h1 class="display-4 fw-bold mb-4 text-shadow">{{ $article->title ?? 'Untitled Article' }}</h1>
                            @if($article->excerpt)
                                <p class="lead mb-4 text-shadow fs-5">{{ $article->excerpt }}</p>
                            @endif
                            <div class="d-flex justify-content-center align-items-center flex-wrap gap-4">                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name ?? 'Unknown') }}&background=ffffff&color=333333&size=40" 
                                         alt="{{ $article->author->name ?? 'Unknown Author' }}" class="rounded-circle me-2 border border-white">
                                    <div class="text-start">
                                        <div class="fw-semibold">{{ $article->author->name ?? 'Unknown Author' }}</div>
                                        <small class="opacity-75">{{ $article->author->role_name ?? 'User' }}</small>
                                    </div>
                                </div>                                <div class="text-center">
                                    <div class="fw-semibold">
                                        @if($article->published_at)
                                            {{ $article->published_at->format('d M Y') }}
                                        @elseif($article->created_at)
                                            {{ $article->created_at->format('d M Y') }}
                                        @else
                                            {{ now()->format('d M Y') }}
                                        @endif
                                    </div>
                                    <small class="opacity-75">
                                        @if($article->published_at)
                                            Dipublikasi
                                        @else
                                            Dibuat
                                        @endif
                                    </small>
                                </div>
                                <div class="text-center">
                                    <div class="fw-semibold">{{ number_format($article->view_count) }}</div>
                                    <small class="opacity-75">Views</small>
                                </div>
                                <div class="text-center">
                                    <div class="fw-semibold">{{ $article->reading_time }}</div>
                                    <small class="opacity-75">Baca</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Navigation Bar -->
    <div class="article-nav bg-white shadow-sm sticky-top">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center py-3">
                        <div class="d-flex align-items-center">
                            @if(!$article->featured_image)
                                <h1 class="h4 mb-0 me-3">{{ Str::limit($article->title, 50) }}</h1>
                            @endif
                            <div class="article-progress-container">
                                <div class="progress" style="height: 3px; width: 100px;">
                                    <div class="progress-bar bg-primary" role="progressbar" id="reading-progress" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            @if(session('admin_role') === 'admin' || $article->author_id === session('admin_user_id'))
                                <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                            @endif
                            <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">{            <div class="col-lg-8">
                <!-- Article Header (for non-featured image articles) -->
                @if(!$article->featured_image)
                <div class="article-header mb-5 text-center">
                    <div class="mb-3">
                        @if($article->category)
                            <span class="badge bg-primary fs-6 px-3 py-2 me-2">
                                <i class="fas fa-folder me-1"></i>{{ $article->category }}
                            </span>
                        @endif
                        @php
                            $statusClass = match($article->status) {
                                'published' => 'bg-success',
                                'draft' => 'bg-warning text-dark',
                                'archived' => 'bg-secondary',
                                default => 'bg-secondary'
                            };
                            $statusText = match($article->status) {
                                'published' => 'Published',
                                'draft' => 'Draft',
                                'archived' => 'Archived',
                                default => $article->status
                            };
                        @endphp
                        <span class="badge {{ $statusClass }} fs-6 px-3 py-2">{{ $statusText }}</span>
                        @if($article->is_featured)
                            <span class="badge bg-warning text-dark fs-6 px-3 py-2 ms-2">
                                <i class="fas fa-star me-1"></i>Featured
                            </span>
                        @endif
                    </div>
                    <h1 class="display-5 fw-bold mb-4 text-dark">{{ $article->title }}</h1>
                    @if($article->excerpt)
                        <p class="lead text-muted mb-4 fs-5">{{ $article->excerpt }}</p>
                    @endif
                    <div class="d-flex justify-content-center align-items-center flex-wrap gap-4 mb-4">                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name ?? 'Unknown') }}&background=6366f1&color=fff&size=40" 
                                 alt="{{ $article->author->name ?? 'Unknown Author' }}" class="rounded-circle me-2">
                            <div class="text-start">
                                <div class="fw-semibold text-dark">{{ $article->author->name ?? 'Unknown Author' }}</div>
                                <small class="text-muted">{{ $article->author->role_name ?? 'User' }}</small>
                            </div>
                        </div>                        <div class="text-center">
                            <div class="fw-semibold text-dark">
                                @if($article->published_at)
                                    {{ $article->published_at->format('d M Y') }}
                                @elseif($article->created_at)
                                    {{ $article->created_at->format('d M Y') }}
                                @else
                                    {{ now()->format('d M Y') }}
                                @endif
                            </div>
                            <small class="text-muted">
                                @if($article->published_at)
                                    Dipublikasi
                                @else
                                    Dibuat
                                @endif
                            </small>
                        </div>
                        <div class="text-center">
                            <div class="fw-semibold text-dark">{{ number_format($article->view_count) }}</div>
                            <small class="text-muted">Views</small>
                        </div>
                        <div class="text-center">
                            <div class="fw-semibold text-dark">{{ $article->reading_time }}</div>
                            <small class="text-muted">Baca</small>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Tags -->
                @if($article->tags && count($article->tags) > 0)
                    <div class="mb-4 text-center">
                        @foreach($article->tags as $tag)
                            <span class="badge bg-light text-dark border me-2 mb-2 px-3 py-2">
                                <i class="fas fa-tag me-1"></i>{{ $tag }}
                            </span>
                        @endforeach
                    </div>
                @endif                <!-- Main Article Content -->
                <div class="article-main-content">
                    <!-- Article Content -->
                    <div class="article-content-wrapper bg-white rounded-4 shadow-sm p-5 mb-5">
                        <div class="article-content">
                            @if($article->content)
                                {!! nl2br(e($article->content)) !!}
                            @else
                                <div class="text-center text-muted py-5">
                                    <i class="fas fa-file-alt fa-3x mb-3"></i>
                                    <h5>Konten artikel belum tersedia</h5>
                                    <p>Artikel ini belum memiliki konten atau masih dalam proses penulisan.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Gallery -->
                    @if($article->gallery && is_array($article->gallery) && count($article->gallery) > 0)
                        <div class="article-gallery bg-white rounded-4 shadow-sm p-5 mb-5">
                            <h3 class="h4 mb-4 text-center">
                                <i class="fas fa-images me-2 text-primary"></i>Galeri Foto
                            </h3>
                            <div class="row g-3">
                                @foreach($article->gallery as $imagePath)
                                    @if($imagePath && file_exists(public_path('storage/' . $imagePath)))
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <div class="gallery-item">
                                                <img src="{{ asset('storage/' . $imagePath) }}" 
                                                     alt="Gallery Image" class="img-fluid rounded-3 shadow-sm w-100" 
                                                     style="height: 200px; object-fit: cover; cursor: pointer; transition: transform 0.3s ease;"
                                                     onclick="showImageModal('{{ asset('storage/' . $imagePath) }}')"
                                                     onmouseover="this.style.transform='scale(1.05)'"
                                                     onmouseout="this.style.transform='scale(1)'"
                                                     onerror="this.parentElement.parentElement.style.display='none'">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Article Actions for Admins -->
                    @if(session('admin_role') === 'admin' || $article->author_id === session('admin_user_id'))
                        <div class="admin-actions bg-light rounded-4 p-4 mb-5">
                            <h5 class="mb-3">
                                <i class="fas fa-tools me-2"></i>Aksi Admin
                            </h5>
                            <div class="row">
                                <div class="col-md-6">                                    <div class="small text-muted mb-3">
                                        <div><strong>Dibuat:</strong> 
                                            @if($article->created_at)
                                                {{ $article->created_at->format('d M Y H:i') }}
                                            @else
                                                -
                                            @endif
                                        </div>
                                        <div><strong>Update terakhir:</strong> 
                                            @if($article->updated_at)
                                                {{ $article->updated_at->format('d M Y H:i') }}
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                                        @if(session('admin_role') === 'admin')
                                            <button type="button" class="btn btn-outline-warning btn-sm" 
                                                    onclick="toggleFeatured({{ $article->id }})">
                                                <i class="fas fa-star me-1"></i>
                                                {{ $article->is_featured ? 'Remove Featured' : 'Make Featured' }}
                                            </button>
                                        @endif
                                        
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-outline-secondary dropdown-toggle" 
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-exchange-alt me-1"></i>Ubah Status
                                            </button>
                                            <ul class="dropdown-menu">
                                                @if($article->status !== 'draft')
                                                    <li><a class="dropdown-item" href="#" onclick="changeStatus({{ $article->id }}, 'draft')">
                                                        <i class="fas fa-file-alt me-2"></i>Draft
                                                    </a></li>
                                                @endif
                                                @if($article->status !== 'published')
                                                    <li><a class="dropdown-item" href="#" onclick="changeStatus({{ $article->id }}, 'published')">
                                                        <i class="fas fa-globe me-2"></i>Published
                                                    </a></li>
                                                @endif
                                                @if($article->status !== 'archived')
                                                    <li><a class="dropdown-item" href="#" onclick="changeStatus({{ $article->id }}, 'archived')">
                                                        <i class="fas fa-archive me-2"></i>Archived
                                                    </a></li>
                                                @endif
                                            </ul>
                                        </div>
                                        
                                        <button type="button" class="btn btn-outline-danger btn-sm" 
                                                onclick="deleteArticle({{ $article->id }})">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="article-sidebar">
                    <!-- Quick Stats -->
                    <div class="stats-card bg-gradient-primary text-white rounded-4 p-4 mb-4 shadow">
                        <h5 class="mb-3">
                            <i class="fas fa-chart-line me-2"></i>Statistik Artikel
                        </h5>
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="stats-item">
                                    <h3 class="mb-1">{{ number_format($article->view_count) }}</h3>
                                    <small class="opacity-75">Total Views</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stats-item">
                                    <h3 class="mb-1">{{ $article->reading_time }}</h3>
                                    <small class="opacity-75">Waktu Baca</small>
                                </div>
                            </div>
                        </div>
                        <hr class="my-3 opacity-25">                        <div class="row text-center">
                            <div class="col-6">
                                <div class="stats-item">
                                    <h6 class="mb-1">
                                        @if($article->created_at)
                                            {{ $article->created_at->format('d/m/Y') }}
                                        @else
                                            {{ now()->format('d/m/Y') }}
                                        @endif
                                    </h6>
                                    <small class="opacity-75">Dibuat</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stats-item">
                                    @if($article->published_at)
                                        <h6 class="mb-1">{{ $article->published_at->format('d/m/Y') }}</h6>
                                        <small class="opacity-75">Dipublikasi</small>
                                    @elseif($article->status === 'published')
                                        <h6 class="mb-1">{{ $article->created_at ? $article->created_at->format('d/m/Y') : now()->format('d/m/Y') }}</h6>
                                        <small class="opacity-75">Dipublikasi</small>
                                    @else
                                        <h6 class="mb-1 text-warning">Draft</h6>
                                        <small class="opacity-75">Status</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Author Card -->
                    <div class="author-card bg-white rounded-4 shadow-sm p-4 mb-4">
                        <h5 class="mb-3">
                            <i class="fas fa-user me-2 text-primary"></i>Tentang Penulis
                        </h5>                        <div class="text-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name ?? 'Unknown') }}&background=6366f1&color=fff&size=80" 
                                 alt="{{ $article->author->name ?? 'Unknown Author' }}" class="rounded-circle mb-3 border border-light shadow-sm">
                            <h6 class="mb-1 text-dark">{{ $article->author->name ?? 'Unknown Author' }}</h6>
                            <p class="text-muted small mb-3">{{ $article->author->role_name ?? 'User' }}</p>
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="author-stat">
                                        <h6 class="text-primary mb-1">{{ $article->author->published_articles_count ?? 0 }}</h6>
                                        <small class="text-muted">Published</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="author-stat">
                                        <h6 class="text-warning mb-1">{{ $article->author->draft_articles_count ?? 0 }}</h6>
                                        <small class="text-muted">Drafts</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Information -->
                    <div class="seo-card bg-white rounded-4 shadow-sm p-4 mb-4">
                        <h5 class="mb-3">
                            <i class="fas fa-search me-2 text-success"></i>Informasi SEO
                        </h5>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Meta Title:</label>
                            <p class="small mb-0">{{ $article->meta_title ?: $article->title }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Meta Description:</label>
                            <p class="small mb-0">{{ $article->meta_description ?: $article->excerpt ?: 'Tidak ada deskripsi' }}</p>
                        </div>
                        
                        @if($article->meta_keywords)
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Keywords:</label>
                                <p class="small mb-0">{{ $article->meta_keywords }}</p>
                            </div>
                        @endif
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">URL Slug:</label>
                            <p class="small mb-0"><code class="bg-light px-2 py-1 rounded">{{ $article->slug }}</code></p>
                        </div>
                        
                        @if($article->canonical_url)
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Canonical URL:</label>
                                <p class="small mb-0"><a href="{{ $article->canonical_url }}" target="_blank" class="text-decoration-none">{{ Str::limit($article->canonical_url, 40) }}</a></p>
                            </div>
                        @endif
                    </div>                    <!-- Related Articles -->
                    @if(isset($relatedArticles) && $relatedArticles->count() > 0)
                        <div class="related-articles bg-white rounded-4 shadow-sm p-4">
                            <h5 class="mb-3">
                                <i class="fas fa-link me-2 text-info"></i>Artikel Terkait
                            </h5>
                            @foreach($relatedArticles as $related)
                                <div class="related-item d-flex mb-3 {{ !$loop->last ? 'pb-3 border-bottom' : '' }}">
                                    @if($related->featured_image && file_exists(public_path('storage/' . $related->featured_image)))
                                        <img src="{{ asset('storage/' . $related->featured_image) }}" 
                                             alt="{{ $related->title ?? 'Untitled' }}" class="rounded-3 me-3 shadow-sm" 
                                             style="width: 70px; height: 70px; object-fit: cover;"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="bg-light rounded-3 me-3 d-none align-items-center justify-content-center shadow-sm" 
                                             style="width: 70px; height: 70px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @else
                                        <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center shadow-sm" 
                                             style="width: 70px; height: 70px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                    <div class="flex-grow-1">
                                        <h6 class="mb-2 lh-sm">
                                            <a href="{{ route('admin.articles.show', $related) }}" 
                                               class="text-decoration-none text-dark">
                                                {{ Str::limit($related->title ?? 'Untitled Article', 45) }}
                                            </a>
                                        </h6>                                        <div class="small text-muted d-flex align-items-center">
                                            <i class="fas fa-eye me-1"></i>
                                            <span class="me-3">{{ number_format($related->view_count ?? 0) }}</span>
                                            <i class="fas fa-calendar me-1"></i>
                                            <span>
                                                @if($related->published_at)
                                                    {{ $related->published_at->format('d M Y') }}
                                                @elseif($related->created_at)
                                                    {{ $related->created_at->format('d M Y') }}
                                                @else
                                                    {{ now()->format('d M Y') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white rounded-4 shadow-sm p-4 text-center">
                            <i class="fas fa-newspaper fa-2x text-muted mb-3"></i>
                            <h6 class="text-muted">Tidak ada artikel terkait</h6>
                            <small class="text-muted">Belum ada artikel terkait dengan kategori atau tag yang sama.</small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="imageModalLabel">
                    <i class="fas fa-images me-2"></i>Galeri Gambar
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img id="modalImage" src="" alt="Gallery Image" class="img-fluid w-100" style="max-height: 80vh; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('css/article-content-styling.css') }}">
<style>
/* Hero Section Styles */
.article-hero {
    position: relative;
    height: 70vh;
    min-height: 500px;
    overflow: hidden;
}

.hero-image-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.hero-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    filter: brightness(0.7);
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.3) 100%);
}

.hero-content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    z-index: 2;
}

.hero-text h1 {
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    font-size: 3.5rem;
    font-weight: 700;
    line-height: 1.2;
}

.hero-text p {
    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    font-size: 1.2rem;
    font-weight: 300;
}

.text-shadow {
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

/* Glass effect badges */
.bg-primary-glass {
    background: rgba(13, 110, 253, 0.8) !important;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.bg-success-glass {
    background: rgba(25, 135, 84, 0.8) !important;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.bg-warning-glass {
    background: rgba(255, 193, 7, 0.8) !important;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #000 !important;
}

.bg-secondary-glass {
    background: rgba(108, 117, 125, 0.8) !important;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

/* Navigation Bar */
.article-nav {
    border-bottom: 1px solid #e9ecef;
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.95) !important;
}

#reading-progress {
    transition: width 0.3s ease;
}

/* Article Content */
.article-header {
    padding: 2rem 0;
}

.article-content-wrapper {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05) !important;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.article-content {
    font-family: 'Georgia', 'Times New Roman', serif;
    font-size: 18px;
    line-height: 1.8;
    color: #2d3748;
}

.article-content p {
    margin-bottom: 1.5rem;
    text-align: justify;
}

.article-content h1, .article-content h2, .article-content h3, 
.article-content h4, .article-content h5, .article-content h6 {
    margin-top: 2.5rem;
    margin-bottom: 1.5rem;
    font-weight: 700;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #1a202c;
}

.article-content h1 {
    font-size: 2.5rem;
    border-bottom: 3px solid #3b82f6;
    padding-bottom: 0.5rem;
}

.article-content h2 {
    font-size: 2rem;
    color: #2563eb;
}

.article-content h3 {
    font-size: 1.5rem;
    color: #3b82f6;
}

.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    margin: 2rem auto;
    display: block;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.article-content blockquote {
    border-left: 5px solid #3b82f6;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 1.5rem 2rem;
    margin: 2rem 0;
    font-style: italic;
    color: #4a5568;
    border-radius: 0 12px 12px 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.article-content code {
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    padding: 0.3rem 0.6rem;
    border-radius: 6px;
    font-size: 0.9em;
    color: #e11d48;
    font-weight: 600;
}

.article-content pre {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    color: #e2e8f0;
    padding: 1.5rem;
    border-radius: 12px;
    overflow-x: auto;
    margin: 2rem 0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
}

.article-content ul, .article-content ol {
    margin: 1.5rem 0;
    padding-left: 2rem;
}

.article-content li {
    margin: 0.75rem 0;
    line-height: 1.6;
}

.article-content a {
    color: #3b82f6;
    text-decoration: none;
    border-bottom: 2px solid transparent;
    transition: all 0.3s ease;
}

.article-content a:hover {
    color: #1d4ed8;
    border-bottom-color: #3b82f6;
}

/* Gallery Styles */
.article-gallery {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05) !important;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.gallery-item img {
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.gallery-item img:hover {
    transform: scale(1.05);
    border-color: #3b82f6;
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3) !important;
}

/* Sidebar Cards */
.stats-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    border: none;
    box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3) !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

.author-card, .seo-card, .related-articles {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05) !important;
    border: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.author-card:hover, .seo-card:hover, .related-articles:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.1) !important;
}

.author-card img {
    transition: transform 0.3s ease;
}

.author-card img:hover {
    transform: scale(1.1);
}

/* Related Articles */
.related-item {
    transition: all 0.3s ease;
    padding: 0.5rem;
    border-radius: 8px;
}

.related-item:hover {
    background-color: #f8fafc;
    transform: translateX(5px);
}

.related-item img {
    transition: transform 0.3s ease;
}

.related-item:hover img {
    transform: scale(1.05);
}

/* Admin Actions */
.admin-actions {
    border: 2px dashed #e2e8f0;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

/* Buttons */
.btn {
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

/* Enhanced Modal */
.modal-content {
    border-radius: 15px;
    overflow: hidden;
}

.modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.modal-header .btn-close {
    filter: invert(1);
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-text h1 {
        font-size: 2.5rem;
    }
    
    .hero-text p {
        font-size: 1rem;
    }
    
    .article-hero {
        height: 50vh;
        min-height: 400px;
    }
    
    .article-content {
        font-size: 16px;
    }
    
    .hero-content .d-flex {
        flex-direction: column;
        gap: 1rem;
    }
}

@media (max-width: 576px) {
    .hero-text h1 {
        font-size: 2rem;
    }
    
    .article-content-wrapper {
        padding: 2rem !important;
    }
    
    .article-gallery {
        padding: 2rem !important;
    }
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.article-main-content > * {
    animation: fadeInUp 0.6s ease forwards;
}

.article-main-content > *:nth-child(2) {
    animation-delay: 0.1s;
}

.article-main-content > *:nth-child(3) {
    animation-delay: 0.2s;
}

/* Custom Scrollbar */
.article-content::-webkit-scrollbar {
    width: 8px;
}

.article-content::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.article-content::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

.article-content::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>
@endpush

@push('scripts')
<script>
// Global error handler
window.addEventListener('error', function(e) {
    console.error('JavaScript error:', e.error);
    showToast('Terjadi kesalahan dalam aplikasi', 'error');
});

// Reading Progress Bar
function updateReadingProgress() {
    try {
        const article = document.querySelector('.article-content');
        const progressBar = document.getElementById('reading-progress');
        
        if (article && progressBar) {
            const articleTop = article.offsetTop;
            const articleHeight = article.offsetHeight;
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const windowHeight = window.innerHeight;
            
            const articleStart = articleTop - windowHeight / 2;
            const articleEnd = articleTop + articleHeight - windowHeight / 2;
            
            if (scrollTop < articleStart) {
                progressBar.style.width = '0%';
            } else if (scrollTop > articleEnd) {
                progressBar.style.width = '100%';
            } else {
                const progress = ((scrollTop - articleStart) / (articleEnd - articleStart)) * 100;
                progressBar.style.width = Math.max(0, Math.min(100, progress)) + '%';
            }
        }
    } catch (error) {
        console.error('Error updating reading progress:', error);
    }
}

// Initialize reading progress
document.addEventListener('DOMContentLoaded', function() {
    try {
        updateReadingProgress();
        window.addEventListener('scroll', updateReadingProgress);
        window.addEventListener('resize', updateReadingProgress);
    } catch (error) {
        console.error('Error initializing reading progress:', error);
    }
});

// Enhanced image modal with better UX and error handling
function showImageModal(imageSrc) {
    try {
        if (!imageSrc) {
            showToast('URL gambar tidak valid', 'error');
            return;
        }

        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        
        if (!modal || !modalImage) {
            showToast('Modal tidak dapat dibuka', 'error');
            return;
        }
        
        // Show loading state
        modalImage.style.opacity = '0.5';
        modalImage.style.filter = 'blur(5px)';
        modalImage.src = '';
        
        // Create new image to preload
        const img = new Image();
        img.onload = function() {
            modalImage.src = imageSrc;
            modalImage.style.opacity = '1';
            modalImage.style.filter = 'none';
        };
        img.onerror = function() {
            showToast('Gambar tidak dapat dimuat', 'error');
            modalImage.style.opacity = '1';
            modalImage.style.filter = 'none';
        };
        img.src = imageSrc;
        
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
    } catch (error) {
        console.error('Error showing image modal:', error);
        showToast('Error membuka gambar', 'error');
    }
}

// Enhanced toggle featured with better feedback
function toggleFeatured(articleId) {
    try {
        if (!articleId) {
            showToast('ID artikel tidak valid', 'error');
            return;
        }

        const button = event.target.closest('button');
        if (!button) return;
        
        const originalText = button.innerHTML;
        
        if (confirm('Yakin ingin mengubah status featured artikel ini?')) {
            // Show loading state
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Memproses...';
            
            fetch(`/admin/articles/${articleId}/toggle-featured`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showToast(data.message || 'Status featured berhasil diubah', 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast(error.message || 'Terjadi kesalahan saat memproses permintaan', 'error');
                button.disabled = false;
                button.innerHTML = originalText;
            });
        }
    } catch (error) {
        console.error('Error in toggleFeatured:', error);
        showToast('Error dalam fungsi toggle featured', 'error');
    }
}

// Enhanced change status with better feedback
function changeStatus(articleId, newStatus) {
    try {
        if (!articleId || !newStatus) {
            showToast('Parameter tidak valid', 'error');
            return;
        }

        const statusNames = {
            'draft': 'Draft',
            'published': 'Published',
            'archived': 'Archived'
        };
        
        const statusName = statusNames[newStatus] || newStatus;
        
        if (confirm(`Yakin ingin mengubah status artikel ke ${statusName}?`)) {
            showToast('Memproses perubahan status...', 'info');
            
            fetch(`/admin/articles/${articleId}/change-status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    status: newStatus
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    showToast(data.message || 'Status berhasil diubah', 'success');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast(error.message || 'Terjadi kesalahan saat memproses permintaan', 'error');
            });
        }
    } catch (error) {
        console.error('Error in changeStatus:', error);
        showToast('Error dalam fungsi ubah status', 'error');
    }
}

// Enhanced delete with better confirmation
function deleteArticle(articleId) {
    try {
        if (!articleId) {
            showToast('ID artikel tidak valid', 'error');
            return;
        }

        // Create custom confirmation modal
        const confirmModal = document.createElement('div');
        confirmModal.className = 'modal fade';
        confirmModal.innerHTML = `
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus Artikel
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <i class="fas fa-trash-alt text-danger" style="font-size: 3rem;"></i>
                        </div>
                        <p class="text-center"><strong>PERHATIAN:</strong> Yakin ingin menghapus artikel ini?</p>
                        <p class="text-center text-muted">Tindakan ini tidak dapat dibatalkan!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Batal
                        </button>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete(${articleId})">
                            <i class="fas fa-trash me-1"></i>Ya, Hapus
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        document.body.appendChild(confirmModal);
        const modal = new bootstrap.Modal(confirmModal);
        modal.show();
        
        // Clean up when modal is hidden
        confirmModal.addEventListener('hidden.bs.modal', function() {
            if (confirmModal.parentElement) {
                document.body.removeChild(confirmModal);
            }
        });
    } catch (error) {
        console.error('Error in deleteArticle:', error);
        showToast('Error dalam fungsi hapus artikel', 'error');
    }
}

// Confirm delete function
function confirmDelete(articleId) {
    try {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/articles/${articleId}`;
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    } catch (error) {
        console.error('Error in confirmDelete:', error);
        showToast('Error saat menghapus artikel', 'error');
    }
}

// Toast notification system
function showToast(message, type = 'info') {
    try {
        if (!message) return;
        
        // Remove existing toasts
        const existingToasts = document.querySelectorAll('.custom-toast');
        existingToasts.forEach(toast => {
            if (toast.parentElement) {
                toast.remove();
            }
        });
        
        const toast = document.createElement('div');
        toast.className = `custom-toast position-fixed top-0 end-0 m-3 p-3 rounded shadow-lg`;
        
        const bgClass = {
            'success': 'bg-success text-white',
            'error': 'bg-danger text-white',
            'warning': 'bg-warning text-dark',
            'info': 'bg-info text-white'
        }[type] || 'bg-info text-white';
        
        const icon = {
            'success': 'fas fa-check-circle',
            'error': 'fas fa-exclamation-circle',
            'warning': 'fas fa-exclamation-triangle',
            'info': 'fas fa-info-circle'
        }[type] || 'fas fa-info-circle';
        
        toast.className += ` ${bgClass}`;
        toast.style.zIndex = '9999';
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="${icon} me-2"></i>
                <span>${message}</span>
                <button type="button" class="btn-close ${type === 'warning' ? '' : 'btn-close-white'} ms-3" onclick="this.parentElement.parentElement.remove()"></button>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 5000);
    } catch (error) {
        console.error('Error in showToast:', error);
    }
}

// Smooth scroll for anchor links
document.addEventListener('DOMContentLoaded', function() {
    try {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');
        anchorLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                try {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                } catch (error) {
                    console.error('Error in smooth scroll:', error);
                }
            });
        });
    } catch (error) {
        console.error('Error setting up smooth scroll:', error);
    }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    try {
        // Ctrl/Cmd + E for edit (if user has permission)
        if ((e.ctrlKey || e.metaKey) && e.key === 'e') {
            const editButton = document.querySelector('a[href*="edit"]');
            if (editButton) {
                e.preventDefault();
                editButton.click();
            }
        }
        
        // Escape to close modals
        if (e.key === 'Escape') {
            const modals = document.querySelectorAll('.modal.show');
            modals.forEach(modal => {
                try {
                    const bsModal = bootstrap.Modal.getInstance(modal);
                    if (bsModal) bsModal.hide();
                } catch (error) {
                    console.error('Error closing modal:', error);
                }
            });
        }
    } catch (error) {
        console.error('Error in keyboard shortcuts:', error);
    }
});

// Image lazy loading fallback
document.addEventListener('DOMContentLoaded', function() {
    try {
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            img.addEventListener('error', function() {
                if (this.src && !this.src.includes('ui-avatars.com')) {
                    this.style.display = 'none';
                    
                    // Show placeholder if parent has specific class
                    const placeholder = this.parentElement.querySelector('.placeholder');
                    if (placeholder) {
                        placeholder.style.display = 'flex';
                    }
                }
            });
        });
    } catch (error) {
        console.error('Error setting up image error handlers:', error);
    }
});
</script>
@endpush
@endsection
