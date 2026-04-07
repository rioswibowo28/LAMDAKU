/**
 * WordPress-like Rich Editor Enhancements
 * Advanced TinyMCE Configuration for Laravel CMS
 */

// Enhanced TinyMCE Configuration - Fully compatible with TinyMCE 6 (FREE VERSION)
const advancedEditorConfig = {
    selector: '#content',
    height: 600,
    menubar: 'file edit view insert format tools table help',
    
    // Suppress API key warning for free usage
    promotion: false,
    branding: false,
    
    // Core plugins compatible with TinyMCE 6 (only free, non-premium plugins)
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'help', 'wordcount'
    ],
    // Updated toolbar for TinyMCE 6 - free features only
    toolbar1: 'undo redo | blocks | bold italic underline strikethrough',
    toolbar2: 'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink anchor',
    toolbar3: 'table image media | searchreplace visualblocks | fullscreen preview code help',
    
    // Enhanced styling
    content_style: `
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            font-size: 16px; 
            line-height: 1.7; 
            margin: 2rem;
            max-width: none;
            color: #374151;
        }
        
        h1, h2, h3, h4, h5, h6 { 
            font-weight: 600; 
            margin-top: 2rem; 
            margin-bottom: 1rem; 
            color: #111827;
            line-height: 1.3;
        }
        
        h1 { font-size: 2.5em; }
        h2 { font-size: 2em; }
        h3 { font-size: 1.5em; }
        h4 { font-size: 1.25em; }
        h5 { font-size: 1.125em; }
        h6 { font-size: 1em; }
        
        p { 
            margin-bottom: 1.5rem; 
            text-align: justify;
        }
        
        blockquote { 
            border-left: 4px solid #3b82f6; 
            margin: 2rem 0; 
            padding: 1rem 1.5rem; 
            font-style: italic; 
            background: #f8fafc;
            border-radius: 0 8px 8px 0;
        }
        
        pre { 
            background: #1f2937; 
            color: #f9fafb;
            border: 1px solid #374151; 
            border-radius: 8px; 
            padding: 1.5rem; 
            overflow-x: auto;
            font-family: 'JetBrains Mono', 'Fira Code', Consolas, monospace;
            line-height: 1.5;
        }
        
        code { 
            background: #f3f4f6; 
            color: #dc2626;
            padding: 2px 6px; 
            border-radius: 4px; 
            font-family: 'JetBrains Mono', 'Fira Code', Consolas, monospace;
            font-size: 0.875em;
        }
        
        pre code {
            background: transparent;
            color: inherit;
            padding: 0;
        }
        
        ul, ol {
            margin: 1rem 0;
            padding-left: 2rem;
        }
        
        li {
            margin-bottom: 0.5rem;
        }
        
        a {
            color: #3b82f6;
            text-decoration: none;
        }
        
        a:hover {
            text-decoration: underline;
        }
        
        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 1.5rem 0;
        }
        
        th, td {
            border: 1px solid #d1d5db;
            padding: 0.75rem;
            text-align: left;
        }
        
        th {
            background: #f9fafb;
            font-weight: 600;
        }
        
        .callout {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin: 1.5rem 0;
            border-left: 4px solid;
        }
        
        .callout.info {
            background: #eff6ff;
            border-color: #3b82f6;
            color: #1e40af;
        }
        
        .callout.warning {
            background: #fffbeb;
            border-color: #f59e0b;
            color: #92400e;
        }
        
        .callout.danger {
            background: #fef2f2;
            border-color: #ef4444;
            color: #dc2626;
        }
        
        .callout.success {
            background: #f0fdf4;
            border-color: #10b981;
            color: #065f46;
        }    `,
    
    // Basic formatting options (free version)
    block_formats: 'Paragraph=p; Header 1=h1; Header 2=h2; Header 3=h3; Header 4=h4; Header 5=h5; Header 6=h6; Preformatted=pre; Blockquote=blockquote',
    
    // Image handling
    image_advtab: true,    image_caption: true,
    image_title: true,
    image_description: false,
    
    // Paste options - simplified for TinyMCE 6
    paste_data_images: true,
    
    // Link options
    link_assume_external_targets: true,
    
    // Table options - simplified for TinyMCE 6
    table_class_list: [
        {title: 'Default', value: 'table'},
        {title: 'Striped', value: 'table table-striped'},
        {title: 'Bordered', value: 'table table-bordered'}
    ],
    
    // Auto-save functionality and custom buttons setup
    setup: function (editor) {
        // Auto-save
        editor.on('change keyup', function () {
            const content = editor.getContent();
            const articleId = document.querySelector('input[name="_method"]') ? 
                window.location.pathname.split('/').pop() : 'new';
            localStorage.setItem(`article_draft_${articleId}`, content);
        });
        
        // Load auto-saved content
        editor.on('init', function () {
            const articleId = document.querySelector('input[name="_method"]') ? 
                window.location.pathname.split('/').pop() : 'new';
            const savedContent = localStorage.getItem(`article_draft_${articleId}`);
            
            if (savedContent && savedContent !== editor.getContent()) {
                if (confirm('Ditemukan draft yang tersimpan. Apakah Anda ingin memulihkannya?')) {
                    editor.setContent(savedContent);
                }
            }
        });
          // Custom toolbar buttons
        editor.ui.registry.addButton('customImage', {
            text: 'Media',
            icon: 'image',
            onAction: function () {
                showMediaLibrary(function(url, title) {
                    editor.insertContent(`<img src="${url}" alt="${title || ''}" style="max-width: 100%; height: auto; border-radius: 8px;">`);
                });
            }
        });    },
    
    // Context menu
    contextmenu: 'link image table',
    
    // Word count
    wordcount_countregex: /[\w\u2019\'-]+/g,
    
    // Spell checker
    browser_spellcheck: true,
};

// Media Library Modal
function showMediaLibrary(callback) {
    // Create modal
    const modal = document.createElement('div');
    modal.className = 'media-library-modal';
    modal.innerHTML = `
        <div class="modal-overlay" onclick="closeMediaLibrary()">
            <div class="modal-content" onclick="event.stopPropagation()">
                <div class="modal-header">
                    <h3>Media Library</h3>
                    <button onclick="closeMediaLibrary()" class="btn-close">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="upload-area">
                        <input type="file" id="mediaUpload" accept="image/*" multiple style="display: none;">
                        <button onclick="document.getElementById('mediaUpload').click()" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Upload Images
                        </button>
                    </div>
                    <div class="media-grid" id="mediaGrid">
                        <div class="loading">Loading media...</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button onclick="closeMediaLibrary()" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    `;
    
    // Add styles
    const style = document.createElement('style');
    style.textContent = `
        .media-library-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10000;
        }
        
        .modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            background: white;
            border-radius: 8px;
            width: 90%;
            max-width: 800px;
            max-height: 80vh;
            display: flex;
            flex-direction: column;
        }
        
        .modal-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .btn-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .modal-body {
            padding: 1.5rem;
            flex: 1;
            overflow-y: auto;
        }
        
        .upload-area {
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .media-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 1rem;
        }
        
        .media-item {
            position: relative;
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .media-item:hover {
            border-color: #3b82f6;
        }
        
        .media-item img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }
        
        .media-item-info {
            padding: 0.5rem;
            background: #f9fafb;
            font-size: 0.75rem;
            text-align: center;
        }
        
        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }
        
        .loading {
            text-align: center;
            padding: 2rem;
            color: #6b7280;
        }
    `;
    
    document.head.appendChild(style);
    document.body.appendChild(modal);
    
    // Load media files
    loadMediaFiles(callback);
    
    // Handle file upload
    document.getElementById('mediaUpload').addEventListener('change', function(e) {
        uploadMediaFiles(e.files, callback);
    });
    
    // Global close function
    window.closeMediaLibrary = function() {
        document.body.removeChild(modal);
        document.head.removeChild(style);
        delete window.closeMediaLibrary;
    };
}

// Load media files from server
function loadMediaFiles(callback) {
    fetch('/admin/media/browse')
        .then(response => response.json())
        .then(data => {
            const grid = document.getElementById('mediaGrid');
            
            if (data.success && data.files.length > 0) {
                grid.innerHTML = data.files.map(file => `
                    <div class="media-item" onclick="selectMedia('${file.url}', '${file.name}', ${JSON.stringify(callback)})">
                        <img src="${file.url}" alt="${file.name}">
                        <div class="media-item-info">
                            <div>${file.name}</div>
                            <div>${formatFileSize(file.size)}</div>
                        </div>
                    </div>
                `).join('');
            } else {
                grid.innerHTML = '<div class="loading">No media files found. Upload some images to get started.</div>';
            }
        })
        .catch(error => {
            console.error('Error loading media:', error);
            document.getElementById('mediaGrid').innerHTML = '<div class="loading">Error loading media files.</div>';
        });
}

// Upload media files
function uploadMediaFiles(files, callback) {
    const formData = new FormData();
    Array.from(files).forEach(file => {
        formData.append('file', file);
    });
    
    // Add CSRF token
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if (csrfToken) {
        formData.append('_token', csrfToken);
    }
    
    fetch('/admin/media/upload', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Reload media grid
            loadMediaFiles(callback);
        } else {
            alert('Upload failed: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Upload error:', error);
        alert('Upload failed. Please try again.');
    });
}

// Select media file
window.selectMedia = function(url, name, callback) {
    callback(url, name);
    closeMediaLibrary();
};

// Format file size
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}
