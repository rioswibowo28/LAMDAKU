@extends('admin.layout-simple')

@section('title', 'Tambah Artikel')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Tambah Artikel Baru</h1>
                    <p class="text-muted">Buat artikel baru untuk website</p>
                </div>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
                @csrf
                
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-8">
                        <!-- Basic Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-edit me-2"></i>Informasi Dasar
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Slug akan otomatis dibuat dari judul</div>
                                </div>

                                <div class="mb-3">
                                    <label for="excerpt" class="form-label">Ringkasan</label>
                                    <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                              id="excerpt" name="excerpt" rows="3" 
                                              placeholder="Ringkasan singkat artikel (opsional, akan otomatis diambil dari konten jika kosong)">{{ old('excerpt') }}</textarea>
                                    @error('excerpt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Maksimal 500 karakter</div>
                                </div>                                <div class="mb-3">
                                    <label for="content" class="form-label">Konten Artikel <span class="text-danger">*</span></label>                                    <div class="editor-toolbar mb-2">
                                        <div class="btn-group-vertical btn-group-sm w-100" role="group">                                            <div class="btn-group btn-group-sm mb-2" role="group">
                                                <button type="button" class="btn btn-outline-primary template-btn" data-template="article-intro" title="Template pembuka artikel">
                                                    <i class="fas fa-paragraph"></i> Intro Artikel
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary template-btn" data-template="heading-section" title="Heading dan sub-section">
                                                    <i class="fas fa-heading"></i> Section
                                                </button>
                                                <button type="button" class="btn btn-outline-success template-btn" data-template="bullet-points" title="Bullet points terstruktur">
                                                    <i class="fas fa-list"></i> Points
                                                </button>
                                                <button type="button" class="btn btn-outline-dark template-btn" data-template="step-by-step" title="Langkah-langkah berurutan">
                                                    <i class="fas fa-list-ol"></i> Steps
                                                </button>
                                            </div>
                                            <div class="btn-group btn-group-sm mb-2" role="group">
                                                <button type="button" class="btn btn-outline-info template-btn" data-template="callout-info" title="Info box dengan tips">
                                                    <i class="fas fa-info-circle"></i> Info Box
                                                </button>
                                                <button type="button" class="btn btn-outline-warning template-btn" data-template="callout-warning" title="Warning box">
                                                    <i class="fas fa-exclamation-triangle"></i> Warning
                                                </button>
                                                <button type="button" class="btn btn-outline-primary template-btn" data-template="quote" title="Quote atau kutipan">
                                                    <i class="fas fa-quote-right"></i> Quote
                                                </button>
                                                <button type="button" class="btn btn-outline-dark template-btn" data-template="code-example" title="Code example dengan penjelasan">
                                                    <i class="fas fa-code"></i> Code
                                                </button>                                            </div>
                                        </div>
                                        
                                        <small class="text-muted d-block mt-1">
                                            <i class="fas fa-magic text-primary"></i> 
                                            Gunakan template di atas untuk format HTML yang profesional. Klik tombol untuk memasukkan template ke editor.
                                        </small>
                                        
                                        <!-- Debug button for testing -->                                        <div class="mt-2" style="border-top: 1px dashed #dee2e6; padding-top: 0.5rem;">
                                            <button type="button" class="btn btn-sm btn-outline-secondary me-2 debug-btn" data-action="test-template">
                                                <i class="fas fa-bug"></i> Test Template
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-info me-2 debug-btn" data-action="debug-editor">
                                                <i class="fas fa-info"></i> Debug Info
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-success debug-btn" data-action="test-form">
                                                <i class="fas fa-check"></i> Test Form
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-warning me-2" onclick="debugTinyMCE()">
                                                <i class="fas fa-search"></i> Debug TinyMCE
                                            </button>                                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="forceInitTinyMCE()">
                                                <i class="fas fa-redo"></i> Force Init
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-success" onclick="testTemplateInsertion()">
                                                <i class="fas fa-plus"></i> Test Insert
                                            </button>
                                            <small class="text-muted ms-2">Debug tools</small>
                                        </div>
                                    </div>
                                      <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="content" name="content" rows="20" 
                                              placeholder="Menulis konten artikel...">{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Gunakan toolbar di atas untuk menambahkan elemen, atau ketik langsung dengan format Markdown</div>
                                </div>
                            </div>
                        </div>

                        <!-- Media Management -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-images me-2"></i>Media
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="featured_image" class="form-label">Gambar Utama</label>
                                    <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                                           id="featured_image" name="featured_image" accept="image/*">
                                    @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB</div>
                                    <div id="featuredImagePreview" class="mt-2"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="gallery" class="form-label">Galeri Gambar</label>
                                    <input type="file" class="form-control @error('gallery') is-invalid @enderror" 
                                           id="gallery" name="gallery[]" accept="image/*" multiple>
                                    @error('gallery')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Pilih beberapa gambar untuk galeri (opsional)</div>
                                    <div id="galleryPreview" class="mt-2 row"></div>
                                </div>
                            </div>
                        </div>

                        <!-- SEO Settings -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-search me-2"></i>SEO Settings
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" 
                                           id="meta_title" name="meta_title" value="{{ old('meta_title') }}"
                                           placeholder="Akan menggunakan judul artikel jika kosong">
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Maksimal 60 karakter untuk hasil terbaik di Google</div>
                                </div>

                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                              id="meta_description" name="meta_description" rows="3"
                                              placeholder="Deskripsi artikel untuk search engine">{{ old('meta_description') }}</textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Maksimal 160 karakter untuk hasil terbaik di Google</div>
                                </div>

                                <div class="mb-3">
                                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                    <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" 
                                           id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}"
                                           placeholder="keyword1, keyword2, keyword3">
                                    @error('meta_keywords')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Pisahkan dengan koma</div>
                                </div>

                                <div class="mb-3">
                                    <label for="canonical_url" class="form-label">Canonical URL</label>
                                    <input type="url" class="form-control @error('canonical_url') is-invalid @enderror" 
                                           id="canonical_url" name="canonical_url" value="{{ old('canonical_url') }}"
                                           placeholder="https://example.com/artikel-ini">
                                    @error('canonical_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Open Graph -->
                                <hr>
                                <h6 class="mb-3">Open Graph (Social Media)</h6>
                                
                                <div class="mb-3">
                                    <label for="og_title" class="form-label">OG Title</label>
                                    <input type="text" class="form-control @error('og_title') is-invalid @enderror" 
                                           id="og_title" name="og_title" value="{{ old('og_title') }}"
                                           placeholder="Akan menggunakan meta title jika kosong">
                                    @error('og_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="og_description" class="form-label">OG Description</label>
                                    <textarea class="form-control @error('og_description') is-invalid @enderror" 
                                              id="og_description" name="og_description" rows="2"
                                              placeholder="Akan menggunakan meta description jika kosong">{{ old('og_description') }}</textarea>
                                    @error('og_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="og_image" class="form-label">OG Image</label>
                                    <input type="file" class="form-control @error('og_image') is-invalid @enderror" 
                                           id="og_image" name="og_image" accept="image/*">
                                    @error('og_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Akan menggunakan gambar utama jika kosong. Ukuran ideal: 1200x630px</div>
                                    <div id="ogImagePreview" class="mt-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Publish Settings -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-cog me-2"></i>Pengaturan Publikasi
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" 
                                               {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            <i class="fas fa-star text-warning me-1"></i>Featured Article
                                        </label>
                                    </div>
                                    <div class="form-text">Artikel akan ditampilkan di area khusus</div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="allow_comments" name="allow_comments" value="1" 
                                               {{ old('allow_comments', true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="allow_comments">
                                            <i class="fas fa-comments me-1"></i>Izinkan Komentar
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Categories & Tags -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-tags me-2"></i>Kategori & Tag
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Kategori</label>
                                    <input type="text" class="form-control @error('category') is-invalid @enderror" 
                                           id="category" name="category" value="{{ old('category') }}"
                                           list="categoryList" placeholder="Masukkan atau pilih kategori">
                                    <datalist id="categoryList">
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}">
                                        @endforeach
                                    </datalist>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tags" class="form-label">Tags</label>
                                    <input type="text" class="form-control @error('tags') is-invalid @enderror" 
                                           id="tags" name="tags" value="{{ old('tags') }}"
                                           placeholder="tag1, tag2, tag3">
                                    @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Pisahkan dengan koma</div>
                                    
                                    @if($tags->count() > 0)
                                        <div class="mt-2">
                                            <small class="text-muted">Tag yang tersedia:</small><br>
                                            @foreach($tags as $tag)
                                                <span class="badge bg-light text-dark me-1 mb-1 tag-suggestion" 
                                                      style="cursor: pointer;" onclick="addTag('{{ $tag }}')">
                                                    {{ $tag }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary" name="submit_action" value="save">
                                        <i class="fas fa-save me-2"></i>Simpan Artikel
                                    </button>
                                    <button type="submit" class="btn btn-success" name="submit_action" value="save_and_publish" 
                                            id="saveAndPublishBtn">
                                        <i class="fas fa-rocket me-2"></i>Simpan & Publish
                                    </button>
                                    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('css/advanced-editor.css') }}">
<style>
.editor-toolbar {
    border: 1px solid #dee2e6;
    border-bottom: none;
    border-radius: 0.375rem 0.375rem 0 0;
    padding: 0.5rem;
    background-color: #f8f9fa;
}

.editor-toolbar + .form-control {
    border-radius: 0 0 0.375rem 0.375rem;
}

.template-buttons .btn {
    margin: 2px;
}

.tox-tinymce {
    border-radius: 0 0 0.375rem 0.375rem !important;
}

.content-template {
    background-color: #f8f9fa;
    border: 1px dashed #dee2e6;
    padding: 1rem;
    margin: 0.5rem 0;
    border-radius: 0.375rem;
    font-style: italic;
    color: #6c757d;
}

.image-preview {
    max-width: 200px;
    max-height: 150px;
    object-fit: cover;
    border-radius: 0.375rem;
    border: 1px solid #dee2e6;
}

.gallery-preview-item {
    position: relative;
    display: inline-block;
    margin: 0.25rem;
}

.gallery-preview-item .remove-btn {
    position: absolute;
    top: -8px;
    right: -8px;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #dc3545;
    color: white;
    border: none;
    font-size: 12px;
    cursor: pointer;
}

.meta-counter {
    font-size: 0.75rem;
    color: #6b7280;
    text-align: right;
    margin-top: 0.25rem;
}

.meta-counter.warning {
    color: #f59e0b;
}

.meta-counter.danger {
    color: #ef4444;
}

/* Auto-save indicator styling */
.autosave-indicator {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #10b981;
    color: white;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    opacity: 0;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1050;
    font-size: 0.875rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.autosave-indicator.show {
    opacity: 1;
    transform: translateY(0);
}

/* Draft recovery styling */
.draft-recovery {
    background: #fef3c7;
    border: 1px solid #f59e0b;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.draft-recovery .actions {
    display: flex;
    gap: 0.5rem;
}

/* Editor toolbar enhancements */
.editor-toolbar {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 1rem;
}

.editor-loading {
    text-align: center;
    padding: 0.5rem;
}

.editor-ready {
    text-align: center;
    padding: 0.5rem;
    animation: fadeInOut 3s ease-in-out;
}

@keyframes fadeInOut {
    0%, 100% { opacity: 0; }
     20%, 80% { opacity: 1; }
}

/* Disabled button state */
.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Toolbar button hover effects */
.editor-toolbar .btn {
    transition: all 0.2s ease;
}

.editor-toolbar .btn:hover:not(:disabled) {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Article content styling for professional output */
.callout {
    padding: 1rem;
    margin: 1rem 0;
    border-radius: 0.5rem;
    border-left: 4px solid;
    background-color: #f8f9fa;
}

.callout.info {
    border-left-color: #0dcaf0;
    background-color: #d1ecf1;
    color: #055160;
}

.callout.warning {
    border-left-color: #ffc107;
    background-color: #fff3cd;
    color: #664d03;
}

.article-content {
    line-height: 1.6;
}

.article-content .intro {
    font-size: 1.1em;
    color: #495057;
    margin-bottom: 1.5rem;
}

blockquote {
    border-left: 4px solid #dee2e6;
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #6c757d;
}

blockquote footer {
    font-size: 0.9em;
    color: #adb5bd;
    margin-top: 0.5rem;
}

pre {
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 0.375rem;
    overflow-x: auto;
    border: 1px solid #dee2e6;
}

code {
    background-color: #f8f9fa;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
    font-size: 0.875em;
}

pre code {
    background-color: transparent;
    padding: 0;
}

/* Hide textarea when TinyMCE is active */
.tinymce-active #content {
    position: absolute !important;
    left: -9999px !important;
    width: 1px !important;
    height: 1px !important;
    overflow: hidden !important;
    visibility: hidden !important;
}

/* Ensure textarea is visible by default until TinyMCE loads */
#content {
    display: block !important;
    position: static !important;
    visibility: visible !important;
}
</style>
@endpush

@push('scripts')
<!-- TinyMCE Editor -->
<script src="https://cdn.jsdelivr.net/npm/tinymce@6/tinymce.min.js" referrerpolicy="origin"></script>
<!-- Advanced Editor Configuration -->
<script src="{{ asset('js/advanced-editor.js') }}" onload="console.log('✅ Advanced editor config loaded')" onerror="console.error('❌ Failed to load advanced-editor.js')"></script>
<!-- Debug Script -->
<script src="{{ asset('js/tinymce-debug.js') }}"></script>
<script>
// Add CSRF token to global scope for API requests
window.csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

// Debug script loading
console.log('📍 Scripts section loaded');
console.log('📍 TinyMCE available:', typeof tinymce !== 'undefined');
console.log('📍 Asset URL for advanced-editor.js:', '{{ asset('js/advanced-editor.js') }}');

// Wait a bit for scripts to load
setTimeout(function() {
    console.log('📍 After timeout - advancedEditorConfig available:', typeof advancedEditorConfig !== 'undefined');
    if (typeof advancedEditorConfig !== 'undefined') {
        console.log('✅ Advanced editor config found:', advancedEditorConfig);
    } else {
        console.error('❌ advancedEditorConfig not found - trying direct initialization');
    }
}, 1000);

// Initialize advanced editor
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Initializing Rich Text Editor...');
    console.log('📍 Page:', window.location.pathname);
    console.log('📍 TinyMCE available:', typeof tinymce !== 'undefined');
    console.log('📍 Advanced config available:', typeof advancedEditorConfig !== 'undefined');
    
    // Check if textarea exists
    const textarea = document.getElementById('content');
    if (!textarea) {
        console.error('❌ Content textarea not found!');
        return;
    }    console.log('✅ Content textarea found');
    
    // Set a timeout to force basic TinyMCE if nothing happens
    const forceInitTimeout = setTimeout(() => {
        console.warn('⚠️ Force initializing basic TinyMCE due to timeout...');
        if (!document.body.classList.contains('tinymce-active')) {
            initBasicTinyMCE();
        }
    }, 3000); // 3 second timeout
    
    // Don't disable buttons initially - let them work as fallback
    const toolbar = document.querySelector('.editor-toolbar');
    if (toolbar) {
        const loadingIndicator = document.createElement('div');
        loadingIndicator.className = 'editor-loading';
        loadingIndicator.innerHTML = '<small class="text-muted"><i class="fas fa-spinner fa-spin"></i> Loading editor...</small>';
        toolbar.appendChild(loadingIndicator);
        
        console.log('✅ Toolbar found and loading indicator added');
    } else {
        console.error('❌ Editor toolbar not found!');
    }
    
    // Check if TinyMCE is available
    if (typeof tinymce === 'undefined') {
        console.error('❌ TinyMCE not loaded!');
        if (toolbar) {
            const loadingIndicator = toolbar.querySelector('.editor-loading');
            if (loadingIndicator) loadingIndicator.remove();
            
            const errorIndicator = document.createElement('div');
            errorIndicator.className = 'editor-error';
            errorIndicator.innerHTML = '<small class="text-danger"><i class="fas fa-exclamation-triangle"></i> TinyMCE not loaded - check internet connection</small>';
            toolbar.appendChild(errorIndicator);
        }
        return;
    }    console.log('✅ TinyMCE is available');
    
    // SIMPLE DIRECT TINYMCE INITIALIZATION
    console.log('🔧 Starting direct TinyMCE initialization...');
    clearTimeout(forceInitTimeout);
    
    // Remove any existing loading indicators
    if (toolbar) {
        const loadingIndicator = toolbar.querySelector('.editor-loading');
        if (loadingIndicator) loadingIndicator.remove();
    }
    
    // Clean up any existing editors
    if (tinymce.get('content')) {
        tinymce.get('content').remove();
    }    // Simple TinyMCE configuration
    tinymce.init({
        selector: '#content',
        height: 350,
        menubar: false,
        promotion: false,
        branding: false,
        plugins: 'lists link code',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link | code',
        content_style: `
            body { 
                font-family: Arial, sans-serif;
                font-size: 14px; 
                line-height: 1.5; 
                margin: 10px;
            }
        `,
        setup: function(editor) {
            console.log('🔧 TinyMCE setup callback');
            
            editor.on('init', function() {
                console.log('✅ TinyMCE editor initialized successfully!');
                
                // Hide textarea
                document.body.classList.add('tinymce-active');
                
                // Show success message
                if (toolbar) {
                    const successMsg = document.createElement('div');
                    successMsg.className = 'alert alert-success p-2 mt-2';
                    successMsg.innerHTML = '<small><i class="fas fa-check"></i> Editor siap digunakan!</small>';
                    toolbar.appendChild(successMsg);
                    
                    setTimeout(() => {
                        if (successMsg.parentNode) {
                            successMsg.remove();
                        }
                    }, 3000);
                }
                
                // Make editor globally accessible
                window.tinymceEditor = editor;
            });
            
            editor.on('change', function() {
                console.log('📝 Editor content changed');
            });
        }
    }).then(function(editors) {
        console.log('✅ TinyMCE promise resolved, editors created:', editors.length);
    }).catch(function(error) {
        console.error('❌ TinyMCE initialization failed:', error);
        
        if (toolbar) {
            const errorMsg = document.createElement('div');
            errorMsg.className = 'alert alert-danger p-2 mt-2';
            errorMsg.innerHTML = '<small><i class="fas fa-exclamation-triangle"></i> Error loading editor: ' + error.message + '</small>';
            toolbar.appendChild(errorMsg);
        }
    });
    
    return; // Exit here - no need for other code// Check if advanced editor config is available
    if (typeof advancedEditorConfig === 'undefined') {
        console.error('❌ Advanced editor config not found!');
        console.log('⚠️ Trying basic TinyMCE initialization...');        if (toolbar) {
            const loadingIndicator = toolbar.querySelector('.editor-loading');
            if (loadingIndicator) loadingIndicator.remove();
        }
        clearTimeout(forceInitTimeout);
        initBasicTinyMCE();
        return;
    }
    console.log('✅ Advanced editor config found');
      // If we reach here but TinyMCE failed to load advanced config, use basic
    if (!advancedEditorConfig.selector) {
        console.warn('⚠️ Advanced config incomplete, using basic TinyMCE');
        clearTimeout(forceInitTimeout);
        initBasicTinyMCE();
        return;
    }
      try {
        // Initialize TinyMCE with advanced configuration
        console.log('✅ Advanced editor config found, initializing TinyMCE...');
        
        // Add timeout for initialization
        const initTimeout = setTimeout(() => {
            console.warn('⚠️ TinyMCE initialization timeout, trying basic mode...');
            if (!document.body.classList.contains('tinymce-active')) {
                initBasicTinyMCE();
            }
        }, 10000); // 10 second timeout
        
        // Add setup callback to enable toolbar when ready
        const configWithSetup = {
            ...advancedEditorConfig,
            setup: function(editor) {
                console.log('🔧 TinyMCE setup callback triggered');
                  // Clear timeout since init started
                clearTimeout(initTimeout);
                clearTimeout(forceInitTimeout);
                
                editor.on('init', function() {
                    console.log('✅ TinyMCE initialized successfully');
                    
                    // Add class to body to hide textarea
                    document.body.classList.add('tinymce-active');
                    
                    // Remove loading indicator
                    if (toolbar) {
                        const loadingIndicator = toolbar.querySelector('.editor-loading');
                        if (loadingIndicator) {
                            loadingIndicator.remove();
                        }
                        
                        // Add success indicator
                        const successIndicator = document.createElement('div');
                        successIndicator.className = 'editor-ready';
                        successIndicator.innerHTML = '<small class="text-success"><i class="fas fa-check"></i> Editor ready - TinyMCE mode active!</small>';
                        toolbar.appendChild(successIndicator);
                        
                        setTimeout(() => {
                            if (successIndicator.parentNode) {
                                successIndicator.remove();
                            }
                        }, 3000);
                    }
                    
                    // Make editor globally accessible
                    window.tinymceEditor = editor;
                    console.log('✅ Editor set to window.tinymceEditor');
                });
                
                editor.on('LoadContent', function() {
                    console.log('✅ TinyMCE content loaded');
                });
                
                editor.on('Change', function() {
                    console.log('📝 TinyMCE content changed');
                });
            }
        };
        
        tinymce.init(configWithSetup).then(function(editors) {
            console.log('✅ TinyMCE init promise resolved, editors:', editors.length);
            clearTimeout(initTimeout);
        }).catch(function(error) {
            console.error('❌ TinyMCE init promise rejected:', error);
            clearTimeout(initTimeout);
            if (!document.body.classList.contains('tinymce-active')) {
                console.log('⚠️ Falling back to basic TinyMCE...');
                initBasicTinyMCE();
            }
        });
        
    } catch (error) {
        console.error('❌ Error initializing TinyMCE:', error);
        // Remove loading indicator on error
        if (toolbar) {
            const loadingIndicator = toolbar.querySelector('.editor-loading');
            if (loadingIndicator) loadingIndicator.remove();
            
            // Add error indicator
            const errorIndicator = document.createElement('div');
            errorIndicator.className = 'editor-error';
            errorIndicator.innerHTML = '<small class="text-warning"><i class="fas fa-exclamation-triangle"></i> TinyMCE failed - using fallback mode</small>';
            toolbar.appendChild(errorIndicator);
        }
    }
    
    // Show draft recovery if available
    const draftContent = localStorage.getItem('article_draft_new');
    if (draftContent && draftContent.trim() !== '') {
        showDraftRecovery(draftContent);
    }
});

// Fallback basic TinyMCE initialization
function initBasicTinyMCE() {
    console.log('🔄 Initializing basic TinyMCE as fallback...');
    const toolbar = document.querySelector('.editor-toolbar');
    
    // Clean up any existing editors first
    if (typeof tinymce !== 'undefined' && tinymce.get('content')) {
        tinymce.get('content').remove();
    }
    
    const basicConfig = {
        selector: '#content',
        height: 500,
        menubar: 'file edit view insert format tools table help',
        promotion: false,
        branding: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink | image media | code fullscreen',
        setup: function (editor) {
            console.log('🔧 Basic TinyMCE setup callback triggered');
            
            editor.on('init', function () {
                console.log('✅ Basic TinyMCE initialized successfully');
                
                // Add class to body to hide textarea
                document.body.classList.add('tinymce-active');
                console.log('✅ Body class "tinymce-active" added');
                
                // Remove loading indicator
                if (toolbar) {
                    const loadingIndicator = toolbar.querySelector('.editor-loading');
                    if (loadingIndicator) {
                        loadingIndicator.remove();
                    }
                    
                    // Add success indicator
                    const successIndicator = document.createElement('div');
                    successIndicator.className = 'editor-ready';
                    successIndicator.innerHTML = '<small class="text-success"><i class="fas fa-check"></i> Editor ready - Basic TinyMCE mode!</small>';
                    toolbar.appendChild(successIndicator);
                    
                    setTimeout(() => {
                        if (successIndicator.parentNode) {
                            successIndicator.remove();
                        }
                    }, 3000);
                }
                
                // Make editor globally accessible
                window.tinymceEditor = editor;
                console.log('✅ Editor set to window.tinymceEditor');
            });
            
            editor.on('LoadContent', function() {
                console.log('📄 Basic TinyMCE content loaded');
            });
            
            editor.on('Change', function() {
                console.log('📝 Basic TinyMCE content changed');
            });
        }
    };
    
    console.log('🔧 Starting basic TinyMCE initialization with config:', basicConfig);
    
    tinymce.init(basicConfig).then(function(editors) {
        console.log('✅ Basic TinyMCE init promise resolved, editors:', editors.length);
    }).catch(function(error) {
        console.error('❌ Basic TinyMCE init promise rejected:', error);
        
        // Remove loading indicator on error
        if (toolbar) {
            const loadingIndicator = toolbar.querySelector('.editor-loading');
            if (loadingIndicator) loadingIndicator.remove();
            
            // Add error indicator
            const errorIndicator = document.createElement('div');
            errorIndicator.className = 'editor-error';
            errorIndicator.innerHTML = '<small class="text-danger"><i class="fas fa-exclamation-triangle"></i> TinyMCE initialization failed completely</small>';
            toolbar.appendChild(errorIndicator);
        }
    });
}

// Draft recovery functionality
function showDraftRecovery(draftContent) {
    const contentTextarea = document.getElementById('content');
    const currentContent = contentTextarea.value.trim();
    
    if (draftContent !== currentContent) {
        const recoveryDiv = document.createElement('div');
        recoveryDiv.className = 'draft-recovery';
        recoveryDiv.innerHTML = `
            <div>
                <strong>📝 Draft Ditemukan:</strong> Ada draft yang tersimpan sebelumnya. Apakah Anda ingin memulihannya?
            </div>
            <div class="actions">
                <button class="btn btn-primary" onclick="recoverDraft('${draftContent.replace(/'/g, "\\'")}')">Pulihkan</button>
                <button class="btn btn-secondary" onclick="dismissDraft()">Abaikan</button>
            </div>
        `;
        
        contentTextarea.parentNode.insertBefore(recoveryDiv, contentTextarea);
    }
}

function recoverDraft(content) {
    const editor = tinymce.get('content');
    if (editor) {
        editor.setContent(content);
    } else {
        document.getElementById('content').value = content;
    }
    dismissDraft();
    showAutoSaveIndicator('Draft dipulihkan');
}

function dismissDraft() {
    const recoveryDiv = document.querySelector('.draft-recovery');
    if (recoveryDiv) {
        recoveryDiv.remove();
    }
    localStorage.removeItem('article_draft_new');
}

// Auto-save indicator
function showAutoSaveIndicator(message = 'Tersimpan otomatis') {
    let indicator = document.querySelector('.autosave-indicator');
    if (!indicator) {
        indicator = document.createElement('div');
        indicator.className = 'autosave-indicator';
        document.body.appendChild(indicator);
    }
    
    indicator.textContent = message;
    indicator.classList.add('show');
    
    setTimeout(() => {
        indicator.classList.remove('show');
    }, 2000);
}

// Enhanced Template insertion functions untuk toolbar buttons dengan format HTML profesional
function insertTemplate(type) {
    console.log('🎯 insertTemplate called with type:', type);
    
    // Get editor dengan metode yang lebih simple dan reliable
    let editor = null;
    
    // Try window.tinymceEditor first (set by our debug script)
    if (window.tinymceEditor && !window.tinymceEditor.destroyed) {
        editor = window.tinymceEditor;
        console.log('✅ Using window.tinymceEditor');
    }
    // Try tinymce.get as fallback
    else if (typeof tinymce !== 'undefined') {
        editor = tinymce.get('content');
        if (editor && !editor.destroyed) {
            console.log('✅ Using tinymce.get("content")');
        } else {
            editor = null;
        }
    }
    
    if (!editor) {
        console.error('❌ No active TinyMCE editor found');
        alert('❌ Editor not ready! Please wait for editor to load or click "Force Init".');
        return;
    }
    
    console.log('🔍 Editor state:', {
        id: editor.id,
        initialized: editor.initialized,
        destroyed: editor.destroyed
    });
    
    // Direct template insertion with improved templates
    let template = '';
    
    switch(type) {        case 'article-intro':
            template = '<p><strong>Ini adalah paragraf pembuka artikel.</strong> Tuliskan penjelasan singkat tentang topik yang akan dibahas.</p>';
            break;
              case 'heading-section':
            template = '<h2>Judul Bagian</h2><p>Konten bagian ini. Anda dapat menambahkan teks dengan <strong>bold</strong> atau <em>italic</em>.</p>';
            break;
              case 'bullet-points':
            template = '<ul><li>Poin pertama</li><li>Poin kedua</li><li>Poin ketiga</li></ul>';
            break;
              case 'step-by-step':
            template = '<ol><li>Langkah pertama</li><li>Langkah kedua</li><li>Langkah ketiga</li></ol>';
            break;
            
        case 'callout-info':
            template = '<div style="background-color: #d1ecf1; border-left: 4px solid #0dcaf0; padding: 1rem; margin: 1rem 0; border-radius: 0.375rem;"><strong>� Tips Penting:</strong> Gunakan callout box seperti ini untuk memberikan informasi tambahan atau tips yang berguna bagi pembaca.</div>';
            break;
            
        case 'callout-warning':
            template = '<div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 1rem; margin: 1rem 0; border-radius: 0.375rem;"><strong>⚠️ Perhatian:</strong> Bagian ini berisi informasi penting yang perlu diperhatikan sebelum melanjutkan.</div>';
            break;
            
        case 'quote':
            template = '<blockquote style="border-left: 4px solid #dee2e6; padding-left: 1rem; margin: 1.5rem 0; font-style: italic; color: #6c757d;"><p>"Quote atau kutipan menarik yang mendukung pembahasan dalam artikel ini dan memberikan perspektif yang berbeda."</p><footer style="font-size: 0.9em; color: #adb5bd; margin-top: 0.5rem;">— Sumber Kutipan atau Expert</footer></blockquote>';
            break;
            
        case 'code-example':
            template = '<pre style="background-color: #f8f9fa; padding: 1rem; border-radius: 0.375rem; overflow-x: auto; border: 1px solid #dee2e6;"><code>// Contoh implementasi kode\nfunction exampleFunction() {\n    const result = "Ini adalah contoh kode yang dapat disesuaikan";\n    return result;\n}</code></pre><p><em>Penjelasan mengenai kode di atas dan bagaimana cara menggunakannya dalam konteks artikel.</em></p>';
            break;
            
        default:
            template = '<p><strong>Template "' + type + '":</strong> Template tidak ditemukan. Silakan pilih template yang tersedia.</p>';
            console.warn('⚠️ Unknown template type:', type);
    }
    
    try {
        editor.insertContent(template);
        editor.focus();
        console.log('✅ Template inserted successfully:', type);
        
        // Show success feedback
        showAutoSaveIndicator('Template "' + type + '" ditambahkan');
        
    } catch (error) {
        console.error('❌ Error inserting template:', error);
        alert('❌ Error inserting template: ' + error.message);
    }
}

// Insert template into TinyMCE editor
function insertTinyMCETemplate(editor, type) {
    let template = '';
    
    switch(type) {
        case 'article-intro':
            template = `
                <div class="article-content">
                    <p class="intro"><strong>Paragraf pembuka dengan emphasis yang menarik perhatian pembaca.</strong> Jelaskan secara singkat apa yang akan dibahas dalam artikel ini dan mengapa hal tersebut penting untuk pembaca.</p>
                </div>
            `;
            break;
            
        case 'heading-section':
            template = `
                <h2>Judul Bagian Utama</h2>
                <p>Konten dengan <strong>bold text</strong> dan <em>italic text</em> untuk memberikan penekanan pada poin-poin penting. Pastikan setiap paragraf memiliki gagasan utama yang jelas dan mudah dipahami.</p>
                
                <h3>Sub Bagian Penting</h3>
                <p>Pembahasan lebih detail mengenai topik tertentu. Gunakan sub heading untuk membuat struktur yang jelas dan memudahkan pembaca memahami hierarki informasi.</p>
            `;
            break;
            
        case 'bullet-points':
            template = `
                <ul>
                    <li><strong>Point 1:</strong> Deskripsi detail mengenai poin pertama yang perlu diperhatikan</li>
                    <li><strong>Point 2:</strong> Penjelasan komprehensif tentang aspek kedua dari topik</li>
                    <li><strong>Point 3:</strong> Informasi tambahan yang mendukung pemahaman pembaca</li>
                </ul>
            `;
            break;
            
        case 'callout-info':
            template = '<div class="callout info"><strong>💡 Tips Penting:</strong> Gunakan callout box seperti ini untuk memberikan informasi tambahan atau tips yang berguna bagi pembaca.</div>';
            break;
            
        case 'callout-warning':
            template = '<div class="callout warning"><strong>⚠️ Perhatian:</strong> Bagian ini berisi informasi penting yang perlu diperhatikan sebelum melanjutkan.</div>';
            break;
              case 'code-example':
            template = `
                <pre><code>// Contoh implementasi kode
function exampleFunction() {
    const result = "Ini adalah contoh kode yang dapat disesuaikan";
    return result;
}</code></pre>
                <p><em>Penjelasan mengenai kode di atas dan bagaimana cara menggunakannya dalam konteks artikel.</em></p>
            `;
            break;
            
        case 'step-by-step':
            template = `
                <h2>Langkah-langkah</h2>
                <ol>
                    <li><strong>Langkah Pertama:</strong> Penjelasan detail mengenai langkah awal yang harus dilakukan</li>
                    <li><strong>Langkah Kedua:</strong> Instruksi lanjutan dengan penjelasan yang mudah diikuti</li>
                    <li><strong>Langkah Ketiga:</strong> Finalisasi proses dengan tips untuk hasil optimal</li>
                </ol>
            `;
            break;
            
        case 'quote':
            template = `
                <blockquote>
                    <p>"Quote atau kutipan menarik yang mendukung pembahasan dalam artikel ini dan memberikan perspektif yang berbeda."</p>
                    <footer>— Sumber Kutipan atau Expert</footer>
                </blockquote>
            `;            break;
            
        default:
            template = '<p>Template tidak ditemukan. Silakan pilih template yang tersedia.</p>';
    }
    
    if (template) {
        try {
            // Insert content at cursor position
            editor.insertContent(template);
            
            // Focus back to editor
            editor.focus();
            
            // Show success indicator
            showAutoSaveIndicator('Template ditambahkan');
            console.log('✅ Template inserted successfully');
            
            // Trigger change event to enable auto-save
            if (editor.fire) {
                editor.fire('change');
            }
            
        } catch (error) {
            console.error('❌ Error inserting template:', error);
            // Fallback to plain text insertion
            insertPlainTemplate(type);
        }
    }
}

// Fallback for plain textarea dengan format HTML - Enhanced dengan debugging
function insertPlainTemplate(type) {
    console.log('📝 insertPlainTemplate called with type:', type);
    
    const textarea = document.getElementById('content');
    if (!textarea) {
        console.error('❌ Content textarea not found!');
        alert('Error: Content textarea not found!');
        return;
    }
    
    console.log('✅ Content textarea found');
    
    let template = '';
    
    switch(type) {
        case 'article-intro':
            template = '\n\n<div class="article-content">\n    <p class="intro"><strong>Paragraf pembuka dengan emphasis yang menarik perhatian pembaca.</strong> Jelaskan secara singkat apa yang akan dibahas dalam artikel ini dan mengapa hal tersebut penting untuk pembaca.</p>\n</div>\n\n';
            break;
            
        case 'heading-section':
            template = '\n\n<h2>Judul Bagian Utama</h2>\n<p>Konten dengan <strong>bold text</strong> dan <em>italic text</em> untuk memberikan penekanan pada poin-poin penting. Pastikan setiap paragraf memiliki gagasan utama yang jelas dan mudah dipahami.</p>\n\n<h3>Sub Bagian Penting</h3>\n<p>Pembahasan lebih detail mengenai topik tertentu. Gunakan sub heading untuk membuat struktur yang jelas dan memudahkan pembaca memahami hierarki informasi.</p>\n\n';
            break;
            
        case 'bullet-points':
            template = '\n\n<ul>\n    <li><strong>Point 1:</strong> Deskripsi detail mengenai poin pertama yang perlu diperhatikan</li>\n    <li><strong>Point 2:</strong> Penjelasan komprehensif tentang aspek kedua dari topik</li>\n    <li><strong>Point 3:</strong> Informasi tambahan yang mendukung pemahaman pembaca</li>\n</ul>\n\n';
            break;
            
        case 'step-by-step':
            template = '\n\n<h2>Langkah-langkah</h2>\n<ol>\n    <li><strong>Langkah Pertama:</strong> Penjelasan detail mengenai langkah awal yang harus dilakukan</li>\n    <li><strong>Langkah Kedua:</strong> Instruksi lanjutan dengan penjelasan yang mudah diikuti</li>\n    <li><strong>Langkah Ketiga:</strong> Finalisasi proses dengan tips untuk hasil optimal</li>\n</ol>\n\n';
            break;
            
        case 'callout-info':
            template = '\n\n<div class="callout info"><strong>💡 Tips Penting:</strong> Gunakan callout box seperti ini untuk memberikan informasi tambahan atau tips yang berguna bagi pembaca.</div>\n\n';
            break;
            
        case 'callout-warning':
            template = '\n\n<div class="callout warning"><strong>⚠️ Perhatian:</strong> Bagian ini berisi informasi penting yang perlu diperhatikan sebelum melanjutkan.</div>\n\n';
            break;
            
        case 'code-example':
            template = '\n\n<pre><code>// Contoh implementasi kode\nfunction exampleFunction() {\n    const result = "Ini adalah contoh kode yang dapat disesuaikan";\n    return result;\n}</code></pre>\n<p><em>Penjelasan mengenai kode di atas dan bagaimana cara menggunakannya dalam konteks artikel.</em></p>\n\n';
            break;
            
        case 'quote':
            template = '\n\n<blockquote>\n    <p>"Quote atau kutipan menarik yang mendukung pembahasan dalam artikel ini dan memberikan perspektif yang berbeda."</p>\n    <footer>— Sumber Kutipan atau Expert</footer>\n</blockquote>\n\n';
            break;
            
        default:
            template = '\n\n<p>Template "' + type + '" tidak ditemukan. Silakan pilih template yang tersedia.</p>\n\n';
            console.warn('⚠️ Unknown template type:', type);
    }
    
    if (template) {
        try {
            const cursorPos = textarea.selectionStart || 0;
            const textBefore = textarea.value.substring(0, cursorPos);
            const textAfter = textarea.value.substring(cursorPos);
            
            textarea.value = textBefore + template + textAfter;
            textarea.focus();
            
            // Set cursor position after inserted template
            const newCursorPos = cursorPos + template.length;
            textarea.setSelectionRange(newCursorPos, newCursorPos);
            
            // Show success indicator
            showAutoSaveIndicator('Template ditambahkan (fallback mode)');
            console.log('✅ Template inserted successfully via fallback');
            
        } catch (error) {
            console.error('❌ Error inserting template in fallback mode:', error);
            alert('Error inserting template: ' + error.message);
        }
    } else {
        console.error('❌ No template generated for type:', type);
        alert('No template available for: ' + type);
    }
}

// Debug functions untuk testing template insertion
function testTemplateInsertion() {
    console.log('🧪 Testing template insertion...');
    alert('Testing template insertion - check console for details');
    insertTemplate('article-intro');
}

function debugEditorState() {
    console.log('🔍 EDITOR DEBUG INFO:');
    console.log('====================');
    
    // Check textarea
    const textarea = document.getElementById('content');
    console.log('📝 Textarea element:', textarea ? 'Found' : 'NOT FOUND');
    if (textarea) {
        console.log('   - ID:', textarea.id);
        console.log('   - Value length:', textarea.value.length);
        console.log('   - Cursor position:', textarea.selectionStart);
    }
    
    // Check TinyMCE
    console.log('🔧 TinyMCE check:');
    console.log('   - tinymce defined:', typeof tinymce !== 'undefined');
    
    if (typeof tinymce !== 'undefined') {
        console.log('   - tinymce.get("content"):', tinymce.get('content') ? 'Found' : 'NOT FOUND');
        console.log('   - tinymce.editors.length:', tinymce.editors ? tinymce.editors.length : 'undefined');
        
        if (tinymce.editors && tinymce.editors.length > 0) {
            tinymce.editors.forEach((editor, index) => {
                console.log(`   - Editor ${index}:`, {
                    id: editor.id,
                    targetElm: editor.targetElm ? editor.targetElm.id : 'none',
                    initialized: editor.initialized,
                    destroyed: editor.destroyed
                });
            });
        }
        
        const contentEditor = tinymce.get('content');
        if (contentEditor) {
            console.log('   - Content editor state:', {
                initialized: contentEditor.initialized,
                destroyed: contentEditor.destroyed,
                removed: contentEditor.removed,
                mode: contentEditor.mode ? contentEditor.mode.get() : 'unknown'
            });
        }
    }
    
    // Check global editor
    console.log('🌐 Global editor (window.tinymceEditor):', window.tinymceEditor ? 'Found' : 'NOT FOUND');
    
    // Check advanced config
    console.log('⚙️ Advanced config (advancedEditorConfig):', typeof advancedEditorConfig !== 'undefined' ? 'Found' : 'NOT FOUND');
    
    // Check insertTemplate function
    console.log('🎯 insertTemplate function:', typeof insertTemplate !== 'undefined' ? 'Found' : 'NOT FOUND');
    
    alert('Debug info logged to console - check F12 Developer Tools');
}

// Backup event listeners for template buttons (in case onclick fails)
document.addEventListener('DOMContentLoaded', function() {
    console.log('🔗 Setting up backup event listeners for template buttons...');
    
    // Wait a bit for page to fully load
    setTimeout(function() {
        setupTemplateButtons();
    }, 1000); // Wait 1 second for everything to load
});

function setupTemplateButtons() {
    console.log('⚙️ Setting up template buttons...');
    
    // Method 1: Event listeners for template buttons using data attributes
    const templateButtons = document.querySelectorAll('.template-btn[data-template]');
    console.log('🔍 Found template buttons:', templateButtons.length);
    
    templateButtons.forEach(button => {
        const templateType = button.getAttribute('data-template');
        if (templateType) {
            // Add click event listener
            button.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('🖱️ Template button clicked:', templateType);
                insertTemplate(templateType);
                return false;
            });
            
            console.log('✅ Event listener added for template:', templateType);
        }
    });
    
    // Method 2: Event listeners for debug buttons using data attributes
    const debugButtons = document.querySelectorAll('.debug-btn[data-action]');
    console.log('🔍 Found debug buttons:', debugButtons.length);
    
    debugButtons.forEach(button => {
        const action = button.getAttribute('data-action');
        if (action) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('🖱️ Debug button clicked:', action);
                
                switch(action) {
                    case 'test-template':
                        testTemplateInsertion();
                        break;
                    case 'debug-editor':
                        debugEditorState();
                        break;
                    case 'test-form':
                        testFormSubmission();
                        break;
                    default:
                        console.warn('Unknown debug action:', action);
                }
                
                return false;
            });
            
            console.log('✅ Event listener added for debug action:', action);
        }
    });
    
    // Method 3: Fallback event delegation (safety net)
    document.addEventListener('click', function(e) {
        // Template buttons fallback
        if (e.target.closest('.template-btn')) {
            const button = e.target.closest('.template-btn');
            const templateType = button.getAttribute('data-template');
            if (templateType) {
                e.preventDefault();
                console.log('🎯 Template button detected via delegation:', templateType);
                insertTemplate(templateType);
                return false;
            }
        }
        
        // Debug buttons fallback
        if (e.target.closest('.debug-btn')) {
            const button = e.target.closest('.debug-btn');
            const action = button.getAttribute('data-action');
            if (action) {
                e.preventDefault();
                console.log('🎯 Debug button detected via delegation:', action);
                
                switch(action) {
                    case 'test-template':
                        testTemplateInsertion();
                        break;
                    case 'debug-editor':
                        debugEditorState();
                        break;
                    case 'test-form':
                        testFormSubmission();
                        break;
                }
                
                return false;
            }
        }
    });
    
    console.log('✅ All template buttons setup completed');
    
    // Test that functions are available
    console.log('🧪 Function availability check:');
    console.log('   - insertTemplate:', typeof insertTemplate !== 'undefined' ? '✅' : '❌');
    console.log('   - insertTinyMCETemplate:', typeof insertTinyMCETemplate !== 'undefined' ? '✅' : '❌');
    console.log('   - insertPlainTemplate:', typeof insertPlainTemplate !== 'undefined' ? '✅' : '❌');
    
    // Show ready indicator
    const toolbar = document.querySelector('.editor-toolbar');
    if (toolbar) {
        const readyIndicator = document.createElement('div');
        readyIndicator.className = 'template-buttons-ready';
        readyIndicator.innerHTML = '<small class="text-success"><i class="fas fa-check"></i> Template buttons ready!</small>';
        readyIndicator.style.cssText = 'text-align: center; padding: 0.25rem; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 4px; margin-top: 0.5rem;';
        toolbar.appendChild(readyIndicator);
        
        setTimeout(() => {
            if (readyIndicator.parentNode) {
                readyIndicator.remove();
            }
        }, 3000);
    }
}

// Form validation and submission handler
document.addEventListener('DOMContentLoaded', function() {
    console.log('🔧 Setting up form submission handler...');
    
    const articleForm = document.getElementById('articleForm');
    if (articleForm) {
        console.log('✅ Article form found');
        
        articleForm.addEventListener('submit', function(e) {
            console.log('📋 Form submission started...');
              // Sync TinyMCE content to textarea before validation
            if (typeof tinymce !== 'undefined') {
                const editor = tinymce.get('content');
                if (editor) {
                    const editorContent = editor.getContent();
                    const contentTextarea = document.getElementById('content');
                    if (contentTextarea) {
                        contentTextarea.value = editorContent;
                        console.log('✅ TinyMCE content synced to textarea');
                    }
                    // Trigger save to ensure sync
                    tinymce.triggerSave();
                } else {
                    console.log('⚠️ TinyMCE editor not found, using textarea value');
                }
            } else {
                console.log('⚠️ TinyMCE not available, using textarea value');
            }
            
            // Get form values for validation
            const titleField = document.getElementById('title');
            const title = titleField ? titleField.value.trim() : '';
            const contentTextarea = document.getElementById('content');
            let content = '';
            
            // Get content from TinyMCE or textarea
            if (typeof tinymce !== 'undefined') {
                const editor = tinymce.get('content');
                if (editor) {
                    content = editor.getContent().trim();
                } else if (contentTextarea) {
                    content = contentTextarea.value.trim();
                }
            } else if (contentTextarea) {
                content = contentTextarea.value.trim();
            }
            
            console.log('📊 Form validation:');
            console.log('   - Title:', title);
            console.log('   - Content length:', content.length);
            
            // Manual validation since we removed required attribute
            if (!title) {
                e.preventDefault();
                console.error('❌ Title validation failed');
                alert('Judul artikel harus diisi');
                if (titleField) titleField.focus();
                return false;
            }
            
            if (!content) {
                e.preventDefault();
                console.error('❌ Content validation failed');
                alert('Konten artikel harus diisi');
                if (typeof tinymce !== 'undefined' && tinymce.get('content')) {
                    tinymce.get('content').focus();
                } else if (contentTextarea) {
                    contentTextarea.focus();
                }
                return false;
            }
            
            // Ensure content is in textarea for form submission
            if (contentTextarea) {
                contentTextarea.value = content;
            }
            
            // Show loading indicator
            const submitButtons = articleForm.querySelectorAll('button[type="submit"]');
            console.log('🔄 Disabling submit buttons:', submitButtons.length);
            
            submitButtons.forEach(btn => {
                btn.disabled = true;
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
                
                // Re-enable after 30 seconds as fallback
                setTimeout(() => {
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                }, 30000);
            });
            
            console.log('✅ Form validation passed, submitting...');
            return true;
        });
        
        console.log('✅ Form submission handler attached');
    } else {
        console.error('❌ Article form not found!');
    }
});

// Function to manually validate form before submission
function validateForm() {
    const titleField = document.getElementById('title');
    const title = titleField ? titleField.value.trim() : '';
    
    let content = '';
    if (typeof tinymce !== 'undefined') {
        const editor = tinymce.get('content');
        if (editor) {
            content = editor.getContent().trim();
        } else {
            const contentTextarea = document.getElementById('content');
            if (contentTextarea) {
                content = contentTextarea.value.trim();
            }
        }
    } else {
        const contentTextarea = document.getElementById('content');
        if (contentTextarea) {
            content = contentTextarea.value.trim();
        }
    }
    
    const errors = [];
    if (!title) errors.push('Judul artikel harus diisi');
    if (!content) errors.push('Konten artikel harus diisi');
    
    return {
        isValid: errors.length === 0,
        errors: errors
    };
}

// Auto-save functionality (optional)
let autoSaveTimer;
function setupAutoSave() {
    clearTimeout(autoSaveTimer);
    autoSaveTimer = setTimeout(function() {
        const validation = validateForm();
        if (validation.isValid) {
            // Get content for auto-save
            let content = '';
            if (typeof tinymce !== 'undefined' && tinymce.get('content')) {
                content = tinymce.get('content').getContent();
            } else {
                const contentTextarea = document.getElementById('content');
                if (contentTextarea) {
                    content = contentTextarea.value;
                }
            }
            
            if (content.trim()) {
                localStorage.setItem('article_draft_new', content);
                showAutoSaveIndicator('Draft tersimpan');
                console.log('💾 Auto-saved draft');
            }
        }
    }, 10000); // Auto-save after 10 seconds of inactivity
}

// Setup auto-save when content changes
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        if (typeof tinymce !== 'undefined' && tinymce.get('content')) {
            tinymce.get('content').on('input change keyup', setupAutoSave);
        } else {
            const contentTextarea = document.getElementById('content');
            if (contentTextarea) {
                contentTextarea.addEventListener('input', setupAutoSave);
                contentTextarea.addEventListener('change', setupAutoSave);
            }
        }
        
        const titleField = document.getElementById('title');
        if (titleField) {
            titleField.addEventListener('input', setupAutoSave);
        }
    }, 2000);
});


// Image preview functionality
document.addEventListener('DOMContentLoaded', function() {
    // Featured image preview
    const featuredImageInput = document.getElementById('featured_image');
    if (featuredImageInput) {
        featuredImageInput.addEventListener('change', function(e) {
            previewImage(e.target, 'featuredImagePreview');
        });
    }

    // Gallery preview
    const galleryInput = document.getElementById('gallery');
    if (galleryInput) {
        galleryInput.addEventListener('change', function(e) {
            previewMultipleImages(e.target, 'galleryPreview');
        });
    }

    // OG Image preview
    const ogImageInput = document.getElementById('og_image');
    if (ogImageInput) {
        ogImageInput.addEventListener('change', function(e) {
            previewImage(e.target, 'ogImagePreview');
        });
    }
});

function previewImage(input, previewId) {
    const preview = document.getElementById(previewId);
    if (!preview) return;
    
    preview.innerHTML = '';
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-thumbnail';
            img.style.maxWidth = '200px';
            img.style.maxHeight = '150px';
            preview.appendChild(img);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewMultipleImages(input, previewId) {
    const preview = document.getElementById(previewId);
    if (!preview) return;
    
    preview.innerHTML = '';
    
    if (input.files) {
        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-6 col-md-4 mb-2';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'img-thumbnail w-100';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                
                col.appendChild(img);
                preview.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    }
}

// Tag functionality
function addTag(tag) {
    const tagsInput = document.getElementById('tags');
    if (!tagsInput) return;
    
    const currentTags = tagsInput.value ? tagsInput.value.split(',').map(t => t.trim()) : [];
    
    if (!currentTags.includes(tag)) {
        currentTags.push(tag);
        tagsInput.value = currentTags.join(', ');
    }
}

// Character counter for meta fields
function addCharacterCounter(inputId, maxLength) {
    const input = document.getElementById(inputId);
    if (!input) return;
    
    const counter = document.createElement('div');
    counter.className = 'form-text text-end';
    counter.style.fontSize = '12px';
    
    function updateCounter() {
        const length = input.value.length;
        counter.textContent = `${length}/${maxLength}`;
        counter.className = `form-text text-end ${length > maxLength ? 'text-danger' : 'text-muted'}`;
    }
    
    input.addEventListener('input', updateCounter);
    input.parentNode.appendChild(counter);
    updateCounter();
}

// Add character counters when page loads
document.addEventListener('DOMContentLoaded', function() {
    addCharacterCounter('meta_title', 60);
    addCharacterCounter('meta_description', 160);
    addCharacterCounter('excerpt', 500);
});

console.log('✅ All create article functionality loaded');

// Test form submission readiness
function testFormSubmission() {
    console.log('🧪 FORM SUBMISSION TEST:');
    console.log('=======================');
    
    const form = document.getElementById('articleForm');
    console.log('📋 Form element:', form ? 'Found' : 'NOT FOUND');
    
    if (form) {
        console.log('   - Action:', form.action);
        console.log('   - Method:', form.method);
        console.log('   - Enctype:', form.enctype);
        
        // Use the validation function
        const validation = validateForm();
        
        // Check CSRF token
        const csrfToken = form.querySelector('input[name="_token"]');
        console.log('🔐 CSRF token:', csrfToken ? 'Found' : 'NOT FOUND');
        
        // Check submit buttons
        const submitButtons = form.querySelectorAll('button[type="submit"]');
        console.log('🔘 Submit buttons:', submitButtons.length);
        submitButtons.forEach((btn, index) => {
            console.log(`   - Button ${index}:`, {
                text: btn.textContent.trim(),
                disabled: btn.disabled,
                name: btn.name,
                value: btn.value
            });
        });
        
        console.log('✅ Form validation result:');
        console.log('   - Can submit:', validation.isValid);
        console.log('   - Validation errors:', validation.errors);
        
        if (validation.isValid) {
            alert('✅ Form is ready to submit!\nCheck console for detailed information.');
        } else {
            alert('❌ Form validation failed:\n' + validation.errors.join('\n') + '\n\nCheck console for detailed information.');
        }
    } else {
        alert('❌ Form not found! Check console for details.');
    }
}
@endpush
@endsection
