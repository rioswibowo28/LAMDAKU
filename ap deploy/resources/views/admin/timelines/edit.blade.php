@extends('admin.layout-simple')

@section('title', 'Edit Timeline - LAMDAKU Admin')
@section('page-title', 'Edit Timeline')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="content-card">
            <div class="card-header">
                <h5><i class="fas fa-edit me-2"></i>Edit Timeline Event</h5>
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

                <form action="{{ route('admin.timelines.update', $timeline) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="year" class="form-label">Year <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="year" name="year" 
                                       value="{{ old('year', $timeline->year) }}" min="1900" max="2100" required>
                                <div class="form-text">The year this event occurred</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="icon" class="form-label">Icon Class</label>
                                <input type="text" class="form-control" id="icon" name="icon" 
                                       value="{{ old('icon', $timeline->icon) }}" placeholder="fas fa-rocket">
                                <div class="form-text">FontAwesome icon class (optional)</div>
                                @if($timeline->icon)
                                    <div class="mt-2">
                                        <small class="text-muted">Current: </small>
                                        <i class="{{ $timeline->icon }} fa-lg text-primary"></i>
                                    </div>
                                @endif
                                <div id="icon-preview" class="mt-2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Event Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" 
                               value="{{ old('title', $timeline->title) }}" required placeholder="Company milestone or achievement">
                        <div class="form-text">Brief title describing the event</div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Event Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $timeline->description) }}</textarea>
                        <div class="form-text">Detailed description of what happened during this event</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" class="form-control" id="sort_order" name="sort_order" 
                                       value="{{ old('sort_order', $timeline->sort_order) }}" min="0">
                                <div class="form-text">Lower numbers appear first (0 for auto-sort by year)</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                           {{ old('is_active', $timeline->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active (visible on website)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Preview -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-muted mb-3">Preview</h6>
                        <div class="border rounded p-3" style="background: #f8f9fa;">
                            <div class="timeline-item d-flex" id="timeline-preview">
                                <div class="timeline-marker me-3">
                                    <div class="timeline-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 40px; height: 40px; min-width: 40px;">
                                        <i class="fas fa-calendar" id="preview-icon"></i>
                                    </div>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-year text-primary fw-bold" id="preview-year">{{ $timeline->year }}</div>
                                    <h6 class="timeline-title mb-1" id="preview-title">{{ $timeline->title }}</h6>
                                    <p class="timeline-description text-muted mb-0" id="preview-description">{{ $timeline->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Timeline Event
                        </button>
                        <a href="{{ route('admin.timelines.show', $timeline) }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <a href="{{ route('admin.timelines.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list me-2"></i>All Events
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const yearInput = document.getElementById('year');
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');
    const iconInput = document.getElementById('icon');
    
    const previewYear = document.getElementById('preview-year');
    const previewTitle = document.getElementById('preview-title');
    const previewDescription = document.getElementById('preview-description');
    const previewIcon = document.getElementById('preview-icon');
    const iconPreview = document.getElementById('icon-preview');

    function updatePreview() {
        previewYear.textContent = yearInput.value || new Date().getFullYear();
        previewTitle.textContent = titleInput.value || 'Event Title';
        previewDescription.textContent = descriptionInput.value || 'Event description will appear here...';
        
        if (iconInput.value) {
            previewIcon.className = iconInput.value;
            iconPreview.innerHTML = `<small class="text-muted">Preview: </small><i class="${iconInput.value} fa-lg text-primary"></i>`;
        } else {
            previewIcon.className = 'fas fa-calendar';
            if (iconInput.value !== '') {
                iconPreview.innerHTML = '';
            }
        }
    }

    yearInput.addEventListener('input', updatePreview);
    titleInput.addEventListener('input', updatePreview);
    descriptionInput.addEventListener('input', updatePreview);
    iconInput.addEventListener('input', updatePreview);
    
    // Initial update
    updatePreview();
    
    // Icon suggestions
    const iconSuggestions = [
        'fas fa-rocket', 'fas fa-building', 'fas fa-handshake', 'fas fa-award', 
        'fas fa-users', 'fas fa-chart-line', 'fas fa-globe', 'fas fa-certificate',
        'fas fa-star', 'fas fa-flag', 'fas fa-trophy', 'fas fa-briefcase'
    ];
    
    iconInput.addEventListener('focus', function() {
        if (!this.value) {
            const suggestionText = 'Suggestions: ' + iconSuggestions.slice(0, 6).join(', ');
            iconPreview.innerHTML = `<small class="text-muted">${suggestionText}</small>`;
        }
    });
});
</script>
@endsection
