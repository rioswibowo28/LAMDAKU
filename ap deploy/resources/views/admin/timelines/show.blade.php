@extends('admin.layout-simple')

@section('title', 'Detail Timeline - LAMDAKU Admin')
@section('page-title', 'Detail Timeline')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-history me-2"></i>{{ $timeline->year }} - {{ $timeline->title }}</h5>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.timelines.edit', $timeline) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit Event
                    </a>
                    <form action="{{ route('admin.timelines.destroy', $timeline) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" 
                                onclick="return confirm('Are you sure you want to delete this timeline event?')">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <!-- Timeline Preview -->
                <div class="timeline-preview mb-4 p-4" style="background: #f8f9fa; border-radius: 0.375rem;">
                    <h6 class="fw-bold text-muted mb-3">How it appears on website:</h6>
                    <div class="timeline-item d-flex">
                        <div class="timeline-marker me-3">
                            <div class="timeline-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                 style="width: 50px; height: 50px; min-width: 50px;">
                                @if($timeline->icon)
                                    <i class="{{ $timeline->icon }} fa-lg"></i>
                                @else
                                    <i class="fas fa-calendar fa-lg"></i>
                                @endif
                            </div>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-year text-primary fw-bold h5 mb-1">{{ $timeline->year }}</div>
                            <h6 class="timeline-title mb-2">{{ $timeline->title }}</h6>
                            <p class="timeline-description text-muted mb-0">{{ $timeline->description }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <h6 class="fw-bold text-muted mb-2">Event Description</h6>
                        <p class="mb-4">{{ $timeline->description }}</p>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card p-3" style="background: #f8f9fa; border-radius: 0.375rem;">
                            <h6 class="fw-bold mb-3">Event Information</h6>
                            
                            <div class="mb-3">
                                <small class="text-muted d-block">Year</small>
                                <span class="badge bg-info fs-6">{{ $timeline->year }}</span>
                            </div>
                            
                            <div class="mb-3">
                                <small class="text-muted d-block">Status</small>
                                @if($timeline->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </div>
                            
                            @if($timeline->icon)
                            <div class="mb-3">
                                <small class="text-muted d-block">Icon</small>
                                <div class="d-flex align-items-center">
                                    <i class="{{ $timeline->icon }} fa-2x text-primary me-2"></i>
                                    <code class="small">{{ $timeline->icon }}</code>
                                </div>
                            </div>
                            @endif
                            
                            <div class="mb-3">
                                <small class="text-muted d-block">Sort Order</small>
                                <span class="badge bg-secondary">{{ $timeline->sort_order }}</span>
                            </div>
                            
                            <hr>
                            
                            <div class="mb-2">
                                <small class="text-muted d-block">Created</small>
                                <small>{{ $timeline->created_at->format('M d, Y H:i') }}</small>
                            </div>
                            
                            <div>
                                <small class="text-muted d-block">Last Updated</small>
                                <small>{{ $timeline->updated_at->format('M d, Y H:i') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.timelines.edit', $timeline) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Event
                    </a>
                    <a href="{{ route('admin.timelines.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Timeline
                    </a>
                    <a href="{{ route('admin.timelines.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Add New Event
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="content-card">
            <div class="card-header">
                <h6><i class="fas fa-chart-bar me-2"></i>Event Analytics</h6>
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-eye fa-2x text-info mb-2"></i>
                    <h6 class="text-muted">Preview on Website</h6>
                    <a href="http://localhost:3000#history" target="_blank" class="btn btn-info btn-sm">
                        <i class="fas fa-external-link-alt me-1"></i>View Timeline
                    </a>
                </div>
                
                <hr>
                
                <div class="mb-3">
                    <i class="fas fa-code fa-2x text-warning mb-2"></i>
                    <h6 class="text-muted">API Endpoint</h6>
                    <small class="text-muted d-block">GET /api/v1/timelines/{{ $timeline->id }}</small>
                    <a href="{{ url('/api/v1/timelines/' . $timeline->id) }}" target="_blank" class="btn btn-warning btn-sm mt-1">
                        <i class="fas fa-link me-1"></i>View JSON
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="content-card mt-4">
            <div class="card-header">
                <h6><i class="fas fa-bolt me-2"></i>Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    @if($timeline->is_active)
                        <form action="{{ route('admin.timelines.update', $timeline) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="year" value="{{ $timeline->year }}">
                            <input type="hidden" name="title" value="{{ $timeline->title }}">
                            <input type="hidden" name="description" value="{{ $timeline->description }}">
                            <input type="hidden" name="icon" value="{{ $timeline->icon }}">
                            <input type="hidden" name="sort_order" value="{{ $timeline->sort_order }}">
                            <input type="hidden" name="is_active" value="0">
                            <button type="submit" class="btn btn-warning btn-sm">
                                <i class="fas fa-pause me-1"></i>Hide from Timeline
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.timelines.update', $timeline) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="year" value="{{ $timeline->year }}">
                            <input type="hidden" name="title" value="{{ $timeline->title }}">
                            <input type="hidden" name="description" value="{{ $timeline->description }}">
                            <input type="hidden" name="icon" value="{{ $timeline->icon }}">
                            <input type="hidden" name="sort_order" value="{{ $timeline->sort_order }}">
                            <input type="hidden" name="is_active" value="1">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-play me-1"></i>Show on Timeline
                            </button>
                        </form>
                    @endif
                    
                    <a href="{{ route('admin.timelines.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>Add New Event
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Related Timeline Events -->
        @php
            $relatedEvents = App\Models\Timeline::where('id', '!=', $timeline->id)
                ->where('is_active', true)
                ->orderBy('year', 'desc')
                ->take(5)
                ->get();
        @endphp
        
        @if($relatedEvents->count() > 0)
        <div class="content-card mt-4">
            <div class="card-header">
                <h6><i class="fas fa-list me-2"></i>Other Timeline Events</h6>
            </div>
            <div class="card-body">
                @foreach($relatedEvents as $event)
                    <div class="d-flex align-items-center mb-2 {{ !$loop->last ? 'border-bottom pb-2' : '' }}">
                        <div class="timeline-icon bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" 
                             style="width: 30px; height: 30px; min-width: 30px; font-size: 0.75rem;">
                            @if($event->icon)
                                <i class="{{ $event->icon }}"></i>
                            @else
                                <i class="fas fa-calendar"></i>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <small class="text-primary fw-bold">{{ $event->year }}</small>
                                    <div class="small">{{ Str::limit($event->title, 30) }}</div>
                                </div>
                                <a href="{{ route('admin.timelines.show', $event) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
