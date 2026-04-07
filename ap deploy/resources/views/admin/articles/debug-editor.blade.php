<?php
// Debug script untuk cek apakah file advanced-editor.js bisa diakses
?>
<script>
console.log('=== ADVANCED EDITOR DEBUG ===');

// Test loading advanced-editor.js
fetch('{{ asset('js/advanced-editor.js') }}')
    .then(response => {
        console.log('📄 Advanced editor file response:', response.status, response.statusText);
        return response.text();
    })
    .then(content => {
        console.log('📄 Advanced editor file content length:', content.length);
        console.log('📄 Content preview:', content.substring(0, 200) + '...');
        
        // Try to execute the content
        try {
            eval(content);
            console.log('✅ Advanced editor file executed successfully');
            console.log('📍 advancedEditorConfig available after eval:', typeof advancedEditorConfig !== 'undefined');
        } catch (error) {
            console.error('❌ Error executing advanced editor file:', error);
        }
    })
    .catch(error => {
        console.error('❌ Error loading advanced editor file:', error);
    });

// Test basic TinyMCE config
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
    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link unlink | image media | code fullscreen'
};

// Initialize immediately with basic config
setTimeout(function() {
    console.log('🔄 Starting immediate basic TinyMCE initialization...');
    
    if (typeof tinymce !== 'undefined') {
        tinymce.init(basicConfig).then(function(editors) {
            console.log('✅ Immediate basic TinyMCE initialized, editors:', editors.length);
            if (editors.length > 0) {
                document.body.classList.add('tinymce-active');
                console.log('✅ Body class added');
            }
        }).catch(function(error) {
            console.error('❌ Immediate basic TinyMCE failed:', error);
        });
    } else {
        console.error('❌ TinyMCE not available for immediate init');
    }
}, 500);

console.log('=== END DEBUG ===');
</script>
