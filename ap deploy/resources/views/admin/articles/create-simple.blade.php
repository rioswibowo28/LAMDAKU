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
                                            </button>
                                        </div>
                                        
                                        <!-- Debug buttons -->
                                        <div class="mt-2" style="border-top: 1px dashed #dee2e6; padding-top: 0.5rem;">
                                            <button type="button" class="btn btn-sm btn-outline-warning me-2" onclick="debugTinyMCE()">
                                                <i class="fas fa-search"></i> Debug
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="forceInitTinyMCE()">
                                                <i class="fas fa-redo"></i> Init
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-success" onclick="testTemplateInsertion()">
                                                <i class="fas fa-plus"></i> Test
                                            </button>
                                        </div>
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
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Status -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-cog me-2"></i>Pengaturan
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="featured_image" class="form-label">Gambar Utama</label>
                                    <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                                           id="featured_image" name="featured_image" accept="image/*">
                                    @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="card">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary w-100 mb-2">
                                    <i class="fas fa-save me-2"></i>Simpan Artikel
                                </button>
                                <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary w-100">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

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
</style>

<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"></script>

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
});

function initTinyMCE() {
    console.log('🔧 Initializing TinyMCE...');
    
    // Clean up any existing editors
    if (typeof tinymce !== 'undefined' && tinymce.get('content')) {
        tinymce.get('content').remove();
    }
    
    // Simple TinyMCE configuration
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
                
                // Make editor globally accessible
                window.tinymceEditor = editor;
                
                // Show success message
                showMessage('Editor siap digunakan!', 'success');
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

// Form validation
document.getElementById('articleForm').addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    const content = window.tinymceEditor ? window.tinymceEditor.getContent() : document.getElementById('content').value.trim();
    
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
    
    console.log('✅ Form validation passed');
});
</script>
@endsection
