@extends('admin.layout-simple')

@section('title', 'Edit Layanan - LAMDAKU Admin')
@section('page-title', 'Edit Layanan')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="content-card">
            <div class="card-header">
                <h5><i class="fas fa-edit me-2"></i>Edit Service</h5>
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

                <form action="{{ route('admin.services.update', $service) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label">Service Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" 
                                       value="{{ old('title', $service->title) }}" required>
                                <div class="form-text">The title will be displayed on the website</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="icon" class="form-label">Icon Class</label>
                                <input type="text" class="form-control" id="icon" name="icon" 
                                       value="{{ old('icon', $service->icon) }}" placeholder="fas fa-cogs">
                                <div class="form-text">FontAwesome icon class</div>
                                @if($service->icon)
                                    <div class="mt-2">
                                        <small class="text-muted">Current: </small>
                                        <i class="{{ $service->icon }} fa-lg text-primary"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Short Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $service->description) }}</textarea>
                        <div class="form-text">Brief description for service cards</div>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Full Content <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="content" name="content" rows="6" required>{{ old('content', $service->content) }}</textarea>
                        <div class="form-text">Detailed service content</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image" class="form-label">Image URL</label>
                                <input type="url" class="form-control" id="image" name="image" 
                                       value="{{ old('image', $service->image) }}" placeholder="https://example.com/image.jpg">
                                <div class="form-text">URL to service image</div>
                                @if($service->image)
                                    <div class="mt-2">
                                        <img src="{{ $service->image }}" alt="{{ $service->title }}" 
                                             class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price (IDR)</label>
                                <input type="number" class="form-control" id="price" name="price" 
                                       value="{{ old('price', $service->price) }}" min="0" step="1000">
                                <div class="form-text">Service price in Indonesian Rupiah</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" 
                                       value="{{ old('sort_order', $service->sort_order) }}" min="0">
                                <div class="form-text">Lower numbers appear first</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                           {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active (visible on website)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Service
                        </button>
                        <a href="{{ route('admin.services.show', $service) }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list me-2"></i>All Services
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from title
    const titleInput = document.getElementById('title');
    const slugPreview = document.createElement('div');
    slugPreview.className = 'form-text mt-2';
    titleInput.parentNode.appendChild(slugPreview);
    
    function updateSlugPreview() {
        const slug = titleInput.value.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        slugPreview.innerHTML = slug ? `<strong>Slug preview:</strong> <code>${slug}</code>` : '';
    }
    
    titleInput.addEventListener('input', updateSlugPreview);
    updateSlugPreview(); // Initial call
});
</script>
@endsection