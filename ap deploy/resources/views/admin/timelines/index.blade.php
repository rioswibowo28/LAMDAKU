@extends('admin.layout-simple')

@section('title', 'Kelola Timeline - LAMDAKU Admin')
@section('page-title', 'Kelola Timeline')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-history me-2"></i>Company Timeline</h5>
                <a href="{{ route('admin.timelines.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Timeline Event
                </a>
            </div>
            <div class="card-body p-0">
                @if($timelines->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Year</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th>Sort Order</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($timelines as $timeline)
                                <tr>
                                    <td>
                                        <span class="badge bg-info fs-6">{{ $timeline->year }}</span>
                                    </td>
                                    <td>
                                        <strong>{{ $timeline->title }}</strong>
                                    </td>
                                    <td>{{ Str::limit($timeline->description, 80) }}</td>
                                    <td>
                                        @if($timeline->icon)
                                            <i class="{{ $timeline->icon }} fa-lg text-primary"></i>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($timeline->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $timeline->sort_order }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.timelines.show', $timeline) }}" class="btn btn-outline-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.timelines.edit', $timeline) }}" class="btn btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.timelines.destroy', $timeline) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete" 
                                                        onclick="return confirm('Are you sure you want to delete this timeline event?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-history fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No Timeline Events Found</h5>
                        <p class="text-muted">Start building your company history by adding timeline events.</p>
                        <a href="{{ route('admin.timelines.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add First Timeline Event
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Timeline Preview -->
@if($timelines->where('is_active', true)->count() > 0)
<div class="row mt-4">
    <div class="col-12">
        <div class="content-card">
            <div class="card-header">
                <h6><i class="fas fa-eye me-2"></i>Timeline Preview</h6>
            </div>
            <div class="card-body">
                <div class="timeline-preview">
                    @foreach($timelines->where('is_active', true)->sortBy('year') as $timeline)
                        <div class="timeline-item d-flex mb-4">
                            <div class="timeline-marker me-3">
                                <div class="timeline-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 40px; height: 40px; min-width: 40px;">
                                    @if($timeline->icon)
                                        <i class="{{ $timeline->icon }}"></i>
                                    @else
                                        <i class="fas fa-calendar"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-year text-primary fw-bold">{{ $timeline->year }}</div>
                                <h6 class="timeline-title mb-1">{{ $timeline->title }}</h6>
                                <p class="timeline-description text-muted mb-0">{{ $timeline->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-3">
                    <a href="http://localhost:3000#history" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-external-link-alt me-1"></i>View on Website
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<style>
.timeline-item:not(:last-child) .timeline-marker::after {
    content: '';
    position: absolute;
    left: 50%;
    top: 40px;
    width: 2px;
    height: 50px;
    background: #dee2e6;
    transform: translateX(-50%);
}

.timeline-marker {
    position: relative;
}
</style>
@endsection
