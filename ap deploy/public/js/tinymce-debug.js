// Debug script untuk TinyMCE di Laravel Create Article
console.log('=== TINYMCE DEBUG SCRIPT LOADED ===');

// Function untuk debug TinyMCE
function debugTinyMCE() {
    console.log('🔍 DEBUGGING TINYMCE:');
    console.log('- TinyMCE available:', typeof tinymce !== 'undefined');
    console.log('- Page URL:', window.location.href);
    
    const textarea = document.getElementById('content');
    console.log('- Textarea found:', !!textarea);
    if (textarea) {
        console.log('  - ID:', textarea.id);
        console.log('  - Classes:', textarea.className);
        console.log('  - Style:', textarea.style.cssText);
        console.log('  - Visible:', textarea.offsetParent !== null);
    }
    
    const toolbar = document.querySelector('.editor-toolbar');
    console.log('- Toolbar found:', !!toolbar);
    
    if (typeof tinymce !== 'undefined') {
        console.log('- TinyMCE editors count:', tinymce.editors ? tinymce.editors.length : 0);
        const contentEditor = tinymce.get('content');
        console.log('- Content editor found:', !!contentEditor);
        if (contentEditor) {
            console.log('  - Editor initialized:', contentEditor.initialized);
            console.log('  - Editor destroyed:', contentEditor.destroyed);
        }
    }
    
    console.log('- Body classes:', document.body.className);
}

// Function untuk force initialize TinyMCE
function forceInitTinyMCE() {
    console.log('🔧 FORCE INITIALIZING TINYMCE...');
    
    if (typeof tinymce === 'undefined') {
        console.error('❌ TinyMCE not available');
        return;
    }
    
    // Remove existing editor if any
    const existingEditor = tinymce.get('content');
    if (existingEditor) {
        console.log('🗑️ Removing existing editor...');
        existingEditor.remove();
    }
    
    // Clear body class
    document.body.classList.remove('tinymce-active');
    
    const textarea = document.getElementById('content');
    if (!textarea) {
        console.error('❌ Textarea not found');
        return;
    }
    
    // Make sure textarea is visible
    textarea.style.position = 'static';
    textarea.style.visibility = 'visible';
    textarea.style.left = 'auto';
    textarea.style.width = 'auto';
    textarea.style.height = 'auto';
    
    console.log('🚀 Starting TinyMCE initialization...');
      tinymce.init({
        selector: '#content',
        height: 400,
        menubar: false,
        promotion: false,
        branding: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | code fullscreen',
        content_style: `
            body { 
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                font-size: 14px; 
                line-height: 1.6; 
                margin: 1rem;
                color: #333;
            }
            h1, h2, h3, h4, h5, h6 { 
                font-weight: 600; 
                margin-top: 1.5rem; 
                margin-bottom: 0.75rem; 
                color: #222;
            }
            p { margin-bottom: 1rem; }
        `,
        setup: function(editor) {
            console.log('🔧 TinyMCE setup callback');
            
            editor.on('init', function() {
                console.log('✅ TinyMCE SUCCESSFULLY INITIALIZED!');
                console.log('Editor container:', editor.getContainer());
                
                // Hide textarea
                document.body.classList.add('tinymce-active');
                
                // Show success message
                const toolbar = document.querySelector('.editor-toolbar');
                if (toolbar) {
                    const successDiv = document.createElement('div');
                    successDiv.className = 'alert alert-success p-2 mt-2';
                    successDiv.innerHTML = '<i class="fas fa-check"></i> <strong>Editor berhasil dimuat!</strong> TinyMCE aktif.';
                    toolbar.appendChild(successDiv);
                    
                    setTimeout(() => {
                        if (successDiv.parentNode) {
                            successDiv.remove();
                        }
                    }, 5000);
                }
                  // Make editor globally accessible
                window.tinymceEditor = editor;
                window.debugTinyMCE = debugTinyMCE;
                
                console.log('✅ Editor stored globally as window.tinymceEditor');
            });
            
            editor.on('change', function() {
                console.log('📝 Editor content changed');
            });
        }
    }).then(function(editors) {
        console.log('✅ TinyMCE init promise resolved:', editors.length, 'editors created');
    }).catch(function(error) {
        console.error('❌ TinyMCE init error:', error);
        
        const toolbar = document.querySelector('.editor-toolbar');
        if (toolbar) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'alert alert-danger p-2 mt-2';
            errorDiv.innerHTML = '<i class="fas fa-exclamation-triangle"></i> <strong>Error:</strong> ' + error.message;
            toolbar.appendChild(errorDiv);
        }
    });
}

// Auto-debug when script loads
setTimeout(() => {
    debugTinyMCE();
    
    // Auto-initialize if no editor found
    if (typeof tinymce !== 'undefined' && (!tinymce.get('content') || !document.body.classList.contains('tinymce-active'))) {
        console.log('⚠️ No active editor found, force initializing...');
        forceInitTinyMCE();
    }
}, 2000);

// Make functions globally available
window.debugTinyMCE = debugTinyMCE;
window.forceInitTinyMCE = forceInitTinyMCE;
window.testTemplateInsertion = testTemplateInsertion;

console.log('=== DEBUG SCRIPT READY ===');
console.log('Available functions: debugTinyMCE(), forceInitTinyMCE()');
