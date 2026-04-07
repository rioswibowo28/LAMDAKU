@extends('admin.layout-simple')

@section('title', 'Tambah Artikel')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Tambah Artikel Baru</h1>
                    <p class="text-muted mb-0">Buat artikel baru untuk website</p>
                </div>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" id="articleForm">
                @csrf
                
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-lg-8">                        <!-- Basic Information -->
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
                                </div>

                                <div class="mb-3">
                                    <label for="excerpt" class="form-label">Ringkasan</label>
                                    <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                                              id="excerpt" name="excerpt" rows="3" 
                                              placeholder="Ringkasan singkat artikel">{{ old('excerpt') }}</textarea>
                                    @error('excerpt')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">Konten Artikel <span class="text-danger">*</span></label>
                                    
                                    <!-- Simple toolbar -->
                                    <div class="editor-toolbar mb-2">
                                        <div class="btn-group btn-group-sm mb-2" role="group">
                                            <button type="button" class="btn btn-outline-primary template-btn" data-template="article-intro">
                                                <i class="fas fa-paragraph"></i> Intro
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary template-btn" data-template="heading-section">
                                                <i class="fas fa-heading"></i> Section
                                            </button>
                                            <button type="button" class="btn btn-outline-success template-btn" data-template="bullet-points">
                                                <i class="fas fa-list"></i> Points
                                            </button>
                                            <button type="button" class="btn btn-outline-info template-btn" data-template="step-by-step">
                                                <i class="fas fa-list-ol"></i> Steps
                                            </button>
                                        </div>
                                        <div class="btn-group btn-group-sm mb-2" role="group">
                                            <button type="button" class="btn btn-outline-info template-btn" data-template="callout-info">
                                                <i class="fas fa-info-circle"></i> Info
                                            </button>
                                            <button type="button" class="btn btn-outline-warning template-btn" data-template="callout-warning">
                                                <i class="fas fa-exclamation-triangle"></i> Warning
                                            </button>
                                            <button type="button" class="btn btn-outline-primary template-btn" data-template="quote">
                                                <i class="fas fa-quote-right"></i> Quote
                                            </button>
                                            <button type="button" class="btn btn-outline-dark template-btn" data-template="code-example">
                                                <i class="fas fa-code"></i> Code
                                            </button>                                        </div>
                                    </div>
                                    
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="content" name="content" rows="15" 
                                              placeholder="Tulis konten artikel di sini...">{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                           placeholder="Akreditasi Klinik: Menjamin Mutu Layanan Kesehatan Primer" maxlength="60">
                                    @error('meta_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Maksimal 60 karakter untuk hasil terbaik di Google</div>
                                </div>

                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                              id="meta_description" name="meta_description" rows="3" 
                                              placeholder="Akreditasi klinik adalah proses penilaian eksternal terhadap klinik oleh lembaga independen, seperti Lembaga Akreditasi Fasilitas Kesehatan Tingkat Pertama" 
                                              maxlength="160">{{ old('meta_description') }}</textarea>
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

                                <div class="mb-3">
                                    <label for="og_title" class="form-label">Open Graph Title (Media Sosial)</label>
                                    <input type="text" class="form-control @error('og_title') is-invalid @enderror" 
                                           id="og_title" name="og_title" value="{{ old('og_title') }}" 
                                           placeholder="Akreditasi Klinik: Menjamin Mutu Layanan Kesehatan Primer">
                                    @error('og_title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="og_description" class="form-label">OG Description</label>
                                    <textarea class="form-control @error('og_description') is-invalid @enderror" 
                                              id="og_description" name="og_description" rows="3" 
                                              placeholder="Akreditasi klinik adalah proses penilaian eksternal terhadap klinik oleh lembaga independen, seperti Lembaga Akreditasi Fasilitas Kesehatan Tingkat Pertama">{{ old('og_description') }}</textarea>
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
                                    <div class="form-text">Atur gambar untuk shared di media sosial, biarkan kosong untuk menggunakan gambar utama</div>
                                </div>
                            </div>
                        </div>                    </div>
                    
                    <!-- Sidebar -->                    <div class="col-lg-4">
                        <!-- Informasi Artikel -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-info-circle me-2"></i>Informasi Artikel
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-4">
                                        <div class="small text-muted">Views</div>
                                        <div class="h5 mb-0">0</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="small text-muted">Read Time</div>
                                        <div class="h5 mb-0">3 min</div>
                                    </div>
                                    <div class="col-4">
                                        <div class="small text-muted">Created</div>
                                        <div class="h5 mb-0">{{ date('d M Y') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pengaturan Publikasi -->
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
                                               {{ old('allow_comments', 1) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="allow_comments">
                                            <i class="fas fa-comments me-1"></i>Izinkan Komentar
                                        </label>
                                    </div>
                                </div>
                            </div>                        </div>
                        
                        <!-- Media -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-images me-2"></i>Media
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="featured_image" class="form-label">Gambar Utama</label>
                                    <div class="text-center mb-2" id="featured_image_preview">
                                        <div class="border rounded p-3" style="background-color: #f8f9fa;">
                                            <i class="fas fa-image fa-2x text-muted mb-2"></i>
                                            <div class="small text-muted">Pilih gambar utama</div>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                                           id="featured_image" name="featured_image" accept="image/*">
                                    @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB</div>
                                </div>

                                <div class="mb-3">
                                    <label for="gallery" class="form-label">Galeri Gambar</label>
                                    <input type="file" class="form-control @error('gallery') is-invalid @enderror" 
                                           id="gallery" name="gallery[]" accept="image/*" multiple>
                                    @error('gallery')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Pilih gambar untuk galeri (opsional)</div>
                                </div>
                            </div>                        </div>
                        
                        <!-- Kategori & Tag -->
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
                                           placeholder="Masukkan kategori artikel">
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Contoh: Akreditasi, Layanan, Kesehatan, Regulasi</div>
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
                                    
                                    <!-- Popular Tags -->
                                    <div class="mt-2">
                                        <small class="text-muted">Tags populer:</small><br>
                                        <div class="d-flex flex-wrap gap-1 mt-1">
                                            <span class="badge bg-secondary me-1 mb-1" style="cursor: pointer;" onclick="addTag('akreditasi')">akreditasi</span>
                                            <span class="badge bg-secondary me-1 mb-1" style="cursor: pointer;" onclick="addTag('klinik')">klinik</span>
                                            <span class="badge bg-secondary me-1 mb-1" style="cursor: pointer;" onclick="addTag('sel-vol')">sel-vol</span>
                                            <span class="badge bg-secondary me-1 mb-1" style="cursor: pointer;" onclick="addTag('kesehatan')">kesehatan</span>
                                            <span class="badge bg-secondary me-1 mb-1" style="cursor: pointer;" onclick="addTag('layanan primer')">layanan primer</span>
                                            <span class="badge bg-secondary me-1 mb-1" style="cursor: pointer;" onclick="addTag('mutu')">mutu</span>
                                            <span class="badge bg-secondary me-1 mb-1" style="cursor: pointer;" onclick="addTag('keselamatan pasien')">keselamatan pasien</span>
                                            <span class="badge bg-secondary me-1 mb-1" style="cursor: pointer;" onclick="addTag('standar akreditasi')">standar akreditasi</span>
                                            <span class="badge bg-secondary me-1 mb-1" style="cursor: pointer;" onclick="addTag('visi misi')">visi misi</span>
                                        </div>
                                    </div>
                                </div>                            </div>
                        </div>
                        
                        <!-- Update Artikel Button -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <button type="submit" name="action" value="save" class="btn btn-success">
                                        <i class="fas fa-save me-2"></i>Simpan sebagai Draft
                                    </button>
                                    <button type="submit" name="action" value="publish" class="btn btn-primary">
                                        <i class="fas fa-paper-plane me-2"></i>Publish Artikel
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

<style>
body.tinymce-active #content {
    display: none;
}

.editor-toolbar {
    background-color: #f8f9fa;
    padding: 10px;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    margin-bottom: 10px;
}

/* Enhanced Card Styling */
.card {
    border: none;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.card.shadow-sm {
    box-shadow: 0 2px 10px rgba(0,0,0,0.08) !important;
}

.card:hover {
    box-shadow: 0 4px 20px rgba(0,0,0,0.12) !important;
    transform: translateY(-2px);
}

/* Container and spacing optimizations */
.main-content {
    padding-left: 0 !important;
    padding-right: 0 !important;
}

/* Maximize content width */
.row.g-3 {
    margin-left: 0;
    margin-right: 0;
    width: 100%;
}transform: translateY(-2px);
}

.card-header.bg-light {
    background-color: #f8f9fa !important;
    border-bottom: 1px solid #e9ecef;
    border-radius: 10px 10px 0 0 !important;
    padding: 0.875rem 1rem;
}

.card-title {
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 0;
}

.card-body {
    border-radius: 0 0 10px 10px;
    padding: 1rem;
}

/* Responsive adjustments */
@media (max-width: 1400px) {
    .col-xl-9 {
        margin-bottom: 1.5rem;
    }
}

@media (max-width: 992px) {
    .col-lg-8 {
        margin-bottom: 1.5rem;
    }
    
    .quick-actions-sticky {
        position: static !important;
    }
}

/* Form improvements */
.form-label {
    font-weight: 500;
    color: #495057;
    margin-bottom: 0.5rem;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 1px solid #dee2e6;
    padding: 0.75rem;
    transition: all 0.2s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #86b7fe;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

/* Button improvements */
.btn {
    border-radius: 8px;
    font-weight: 500;
    padding: 0.75rem 1.5rem;
    transition: all 0.2s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

/* Badge improvements */
.badge {
    border-radius: 6px;
    font-weight: 500;
}

/* Quick Actions sticky positioning */
@media (min-width: 1200px) {
    .quick-actions-sticky {
        position: sticky;
        top: 20px;
        z-index: 100;
    }
}
</style>

<!-- TinyMCE Local -->
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>

<script>
console.log('🚀 TinyMCE Script Loading...');

document.addEventListener('DOMContentLoaded', function() {
    console.log('📄 DOM Content Loaded');
    
    // Initialize TinyMCE
    initTinyMCE();
    
    // Setup template buttons
    setupTemplateButtons();
    
    // Setup debug functions
    setupDebugFunctions();
    
    // Setup additional form features
    setupFormFeatures();
});

function initTinyMCE() {
    console.log('🔧 Initializing TinyMCE...');
    
    // Clean up any existing editors
    if (typeof tinymce !== 'undefined' && tinymce.get('content')) {
        tinymce.get('content').remove();
    }
      // Simple TinyMCE configuration - Local version
    tinymce.init({
        selector: '#content',
        height: 350,
        menubar: false,
        promotion: false,
        branding: false,
        license_key: 'gpl', // Use GPL license for local development
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
        init_instance_callback: function(editor) {
            console.log('✅ TinyMCE instance created:', editor.id);
        },
        setup: function(editor) {
            console.log('🔧 TinyMCE setup callback');
            
            editor.on('init', function() {
                console.log('✅ TinyMCE editor initialized successfully!');
                
                // Hide textarea
                document.body.classList.add('tinymce-active');
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
        showMessage('Error loading editor: ' + error.message, 'error');
    });
}

function setupTemplateButtons() {
    console.log('🔘 Setting up template buttons');
    
    document.querySelectorAll('.template-btn').forEach(button => {
        button.addEventListener('click', function() {
            const template = this.getAttribute('data-template');
            console.log('🎯 Template button clicked:', template);
            insertTemplate(template);
        });
    });
}

function insertTemplate(type) {
    console.log('🎯 insertTemplate called with type:', type);
    
    // Get editor
    let editor = null;
    
    if (window.tinymceEditor && !window.tinymceEditor.destroyed) {
        editor = window.tinymceEditor;
        console.log('✅ Using window.tinymceEditor');
    } else if (typeof tinymce !== 'undefined') {
        editor = tinymce.get('content');
        if (editor && !editor.destroyed) {
            console.log('✅ Using tinymce.get("content")');
        } else {
            editor = null;
        }
    }
    
    if (!editor) {
        console.error('❌ No active TinyMCE editor found');
        alert('❌ Editor belum siap! Silakan tunggu atau klik tombol "Init".');
        return;
    }
    
    // Simple templates
    let template = '';
    
    switch(type) {
        case 'article-intro':
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
            template = '<p style="background-color: #e7f3ff; padding: 10px; border-left: 4px solid #2196F3;"><strong>Info:</strong> Informasi penting untuk pembaca.</p>';
            break;
            
        case 'callout-warning':
            template = '<p style="background-color: #fff3e0; padding: 10px; border-left: 4px solid #ff9800;"><strong>Perhatian:</strong> Peringatan atau catatan penting.</p>';
            break;
            
        case 'quote':
            template = '<blockquote style="border-left: 3px solid #ccc; padding-left: 15px; margin: 10px 0; font-style: italic;">"Kutipan atau quote menarik."</blockquote>';
            break;
            
        case 'code-example':
            template = '<pre style="background-color: #f5f5f5; padding: 10px; border: 1px solid #ddd;">// Contoh kode\nconsole.log("Hello World");</pre>';
            break;
            
        default:
            template = '<p><strong>Template "' + type + '":</strong> Template tidak ditemukan.</p>';
            console.warn('⚠️ Unknown template type:', type);
    }
    
    try {
        editor.insertContent(template);
        editor.focus();
        console.log('✅ Template inserted successfully:', type);
        showMessage('Template "' + type + '" ditambahkan', 'success');
        
    } catch (error) {
        console.error('❌ Error inserting template:', error);
        alert('❌ Error inserting template: ' + error.message);
    }
}

function setupDebugFunctions() {
    // Make debug functions globally available
    window.debugTinyMCE = function() {
        console.log('🔍 Debug TinyMCE');
        const editor = tinymce.get('content');
        console.log('Editor instance:', editor);
        console.log('Window editor:', window.tinymceEditor);
        console.log('TinyMCE version:', tinymce.majorVersion + '.' + tinymce.minorVersion);
        alert('Check console for debug info');
    };
    
    window.forceInitTinyMCE = function() {
        console.log('🔄 Force re-initializing TinyMCE');
        showMessage('Reinitializing editor...', 'info');
        initTinyMCE();
    };
    
    window.testTemplateInsertion = function() {
        console.log('🧪 Testing template insertion');
        insertTemplate('article-intro');
    };
}

function showMessage(message, type = 'info') {
    const alertClass = type === 'success' ? 'alert-success' : 
                      type === 'error' ? 'alert-danger' : 'alert-info';
    
    const messageDiv = document.createElement('div');
    messageDiv.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
    messageDiv.style.top = '20px';
    messageDiv.style.right = '20px';
    messageDiv.style.zIndex = '9999';
    messageDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(messageDiv);
    
    setTimeout(() => {
        if (messageDiv.parentNode) {
            messageDiv.remove();
        }
    }, 3000);
}

function setupFormFeatures() {
    console.log('🔧 Setting up form features');
    
    // Featured image preview
    setupImagePreview();
    
    // Gallery preview
    setupGalleryPreview();
    
    // Auto-fill meta from title
    setupMetaAutoFill();
    
    // Character counters
    setupCharacterCounters();
}

function setupImagePreview() {
    const featuredImageInput = document.getElementById('featured_image');
    const previewDiv = document.getElementById('featured_image_preview');
    const removeBtn = document.getElementById('remove_featured_image');
    
    if (featuredImageInput && previewDiv) {
        featuredImageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewDiv.innerHTML = `
                        <img src="${e.target.result}" class="img-fluid rounded" style="max-height: 200px;">
                    `;
                    if (removeBtn) removeBtn.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    if (removeBtn) {
        removeBtn.addEventListener('click', function() {
            featuredImageInput.value = '';
            previewDiv.innerHTML = `
                <div class="border rounded p-3" style="background-color: #f8f9fa;">
                    <i class="fas fa-image fa-2x text-muted mb-2"></i>
                    <div class="small text-muted">Pilih gambar utama</div>
                </div>
            `;
            removeBtn.style.display = 'none';
        });
    }
}

function setupGalleryPreview() {
    const galleryInput = document.getElementById('gallery');
    const previewDiv = document.getElementById('gallery_preview');
    
    if (galleryInput && previewDiv) {
        galleryInput.addEventListener('change', function(e) {
            previewDiv.innerHTML = '';
            const files = Array.from(e.target.files);
            
            files.forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imgDiv = document.createElement('div');
                        imgDiv.className = 'col-4 mb-2';
                        imgDiv.innerHTML = `
                            <div class="position-relative">
                                <img src="${e.target.result}" class="img-fluid rounded" style="width: 100%; height: 80px; object-fit: cover;">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" 
                                        onclick="removeGalleryImage(${index})" style="font-size: 10px; padding: 2px 6px;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        `;
                        previewDiv.appendChild(imgDiv);
                    };
                    reader.readAsDataURL(file);
                }
            });
            
            if (files.length > 0) {
                previewDiv.className = 'mt-2 row';
            }
        });
    }
}

function setupMetaAutoFill() {
    const titleInput = document.getElementById('title');
    const metaTitleInput = document.getElementById('meta_title');
    const ogTitleInput = document.getElementById('og_title');
    
    if (titleInput && metaTitleInput && ogTitleInput) {
        titleInput.addEventListener('input', function() {
            const title = this.value.trim();
            if (title && !metaTitleInput.value) {
                metaTitleInput.value = title.substring(0, 60);
            }
            if (title && !ogTitleInput.value) {
                ogTitleInput.value = title;
            }
        });
    }
}

function setupCharacterCounters() {
    // Meta title counter
    const metaTitleInput = document.getElementById('meta_title');
    if (metaTitleInput) {
        metaTitleInput.addEventListener('input', function() {
            const length = this.value.length;
            const formText = this.parentNode.querySelector('.form-text');
            if (formText) {
                formText.textContent = `${length}/60 karakter untuk hasil terbaik di Google`;
                formText.className = length > 60 ? 'form-text text-danger' : 'form-text';
            }
        });
    }
    
    // Meta description counter
    const metaDescInput = document.getElementById('meta_description');
    if (metaDescInput) {
        metaDescInput.addEventListener('input', function() {
            const length = this.value.length;
            const formText = this.parentNode.querySelector('.form-text');
            if (formText) {
                formText.textContent = `${length}/160 karakter untuk hasil terbaik di Google`;
                formText.className = length > 160 ? 'form-text text-danger' : 'form-text';
            }
        });
    }
}

// Global functions for tags
function addTag(tagName) {
    const tagsInput = document.getElementById('tags');
    if (tagsInput) {
        const currentTags = tagsInput.value.trim();
        const tagsArray = currentTags ? currentTags.split(',').map(tag => tag.trim()) : [];
        
        if (!tagsArray.includes(tagName)) {
            tagsArray.push(tagName);
            tagsInput.value = tagsArray.join(', ');
        }
    }
}

function removeGalleryImage(index) {
    const galleryInput = document.getElementById('gallery');
    if (galleryInput && galleryInput.files) {
        const dt = new DataTransfer();
        const files = Array.from(galleryInput.files);
        
        files.forEach((file, i) => {
            if (i !== index) {
                dt.items.add(file);
            }
        });
        
        galleryInput.files = dt.files;
        
        // Trigger change event to update preview
        galleryInput.dispatchEvent(new Event('change'));
    }
}

// Form validation and action handling
document.getElementById('articleForm').addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    const content = window.tinymceEditor ? window.tinymceEditor.getContent() : document.getElementById('content').value.trim();
    
    // Get action (save or publish)
    const action = e.submitter ? e.submitter.value : 'save';
    
    if (!title) {
        e.preventDefault();
        alert('Judul artikel harus diisi!');
        return false;
    }
    
    if (!content || content === '<p></p>' || content === '') {
        e.preventDefault();
        alert('Konten artikel harus diisi!');
        return false;
    }
    
    // Set status based on action
    const statusSelect = document.getElementById('status');
    if (action === 'publish') {
        statusSelect.value = 'published';
        console.log('✅ Publishing article');
    } else if (action === 'save') {
        statusSelect.value = 'draft';
        console.log('✅ Saving as draft');
    }
    
    console.log('✅ Form validation passed, action:', action);
});

// Setup action buttons
document.addEventListener('DOMContentLoaded', function() {
    const saveBtn = document.querySelector('button[value="save"]');
    const publishBtn = document.querySelector('button[value="publish"]');
    
    if (saveBtn) {
        saveBtn.addEventListener('click', function() {
            console.log('💾 Save as draft clicked');
        });
    }
    
    if (publishBtn) {
        publishBtn.addEventListener('click', function() {
            console.log('📤 Publish clicked');
        });
    }
});
</script>
@endsection
