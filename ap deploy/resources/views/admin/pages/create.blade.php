@extends('admin.layout-simple')

@section('page-title', 'Create New Page')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
    <li class="breadcrumb-item active">Create Page</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="content-card">
            <div class="card-header">
                <h5><i class="fas fa-plus me-2"></i>Create New Page</h5>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <h6>Please correct the following errors:</h6>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.pages.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Page Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="{{ old('title') }}" required>
                        <div class="form-text">The title will be displayed as the page heading and browser title</div>
                        <div id="slug-preview" class="form-text mt-2"></div>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Page Content <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="content" name="content" rows="12" required>{{ old('content') }}</textarea>
                        <div class="form-text">The main content of the page (HTML allowed)</div>
                    </div>

                    <!-- SEO Section -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-muted mb-3">
                            <i class="fas fa-search me-2"></i>SEO Settings
                        </h6>
                        
                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea class="form-control" id="meta_description" name="meta_description" 
                                      rows="2" maxlength="160">{{ old('meta_description') }}</textarea>
                            <div class="form-text">
                                Brief description for search engines (max 160 characters)
                                <span id="meta-counter" class="ms-2"></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="meta_keywords" class="form-label">Meta Keywords</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" 
                                   value="{{ old('meta_keywords') }}" placeholder="keyword1, keyword2, keyword3">
                            <div class="form-text">Comma-separated keywords related to this page</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" 
                                       value="{{ old('sort_order', 0) }}" min="0">
                                <div class="form-text">Lower numbers appear first in navigation</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_published" name="is_published" 
                                           {{ old('is_published', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_published">
                                        Published (visible on website)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Preview -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-muted mb-3">
                            <i class="fas fa-eye me-2"></i>Content Preview
                        </h6>
                        <div class="border rounded p-3" style="background: #f8f9fa; max-height: 200px; overflow-y: auto;">
                            <div id="content-preview">
                                <p class="text-muted">Content preview will appear here as you type...</p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Create Page
                        </button>
                        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const contentInput = document.getElementById('content');
    const metaDescriptionInput = document.getElementById('meta_description');
    const slugPreview = document.getElementById('slug-preview');
    const contentPreview = document.getElementById('content-preview');
    const metaCounter = document.getElementById('meta-counter');

    // Auto-generate slug from title
    function updateSlugPreview() {
        const slug = titleInput.value.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        
        if (slug) {
            slugPreview.innerHTML = `<strong>URL Preview:</strong> <code>{{ url('/') }}/${slug}</code>`;
        } else {
            slugPreview.innerHTML = '';
        }
    }

    // Update content preview
    function updateContentPreview() {
        const content = contentInput.value;
        if (content.trim()) {
            // Simple HTML rendering (be careful with user input in production)
            contentPreview.innerHTML = content.replace(/\n/g, '<br>');
        } else {
            contentPreview.innerHTML = '<p class="text-muted">Content preview will appear here as you type...</p>';
        }
    }

    // Update meta description counter
    function updateMetaCounter() {
        const length = metaDescriptionInput.value.length;
        const remaining = 160 - length;
        metaCounter.innerHTML = `(${length}/160 characters)`;
        
        if (remaining < 0) {
            metaCounter.className = 'ms-2 text-danger';
        } else if (remaining < 20) {
            metaCounter.className = 'ms-2 text-warning';
        } else {
            metaCounter.className = 'ms-2 text-muted';
        }
    }

    titleInput.addEventListener('input', updateSlugPreview);
    contentInput.addEventListener('input', updateContentPreview);
    metaDescriptionInput.addEventListener('input', updateMetaCounter);

    // Initial updates
    updateSlugPreview();
    updateContentPreview();
    updateMetaCounter();
});
</script>
@endsection
