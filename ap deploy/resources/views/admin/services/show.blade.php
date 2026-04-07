@extends('admin.layout-simple')

@section('title', 'Detail Layanan - LAMDAKU Admin')
@section('page-title', 'Detail Layanan')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-cogs me-2"></i>{{ $service->title }}</h5>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit Service
                    </a>
                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" 
                                onclick="return confirm('Are you sure you want to delete this service?')">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h6 class="fw-bold text-muted mb-2">Description</h6>
                        <p class="mb-3">{{ $service->description }}</p>
                        
                        <h6 class="fw-bold text-muted mb-2">Full Content</h6>
                        <div class="content-preview" style="max-height: 300px; overflow-y: auto; border: 1px solid #dee2e6; padding: 1rem; border-radius: 0.375rem;">
                            {!! nl2br(e($service->content)) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card p-3" style="background: #f8f9fa; border-radius: 0.375rem;">
                            <h6 class="fw-bold mb-3">Service Information</h6>
                            
                            <div class="mb-3">
                                <small class="text-muted d-block">Status</small>
                                @if($service->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </div>
                            
                            <div class="mb-3">
                                <small class="text-muted d-block">Slug</small>
                                <code>{{ $service->slug }}</code>
                            </div>
                            
                            @if($service->icon)
                            <div class="mb-3">
                                <small class="text-muted d-block">Icon</small>
                                <i class="{{ $service->icon }} fa-2x text-primary"></i>
                            </div>
                            @endif
                            
                            @if($service->price)
                            <div class="mb-3">
                                <small class="text-muted d-block">Price</small>
                                <span class="fw-bold text-success">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                            </div>
                            @endif
                            
                            <div class="mb-3">
                                <small class="text-muted d-block">Sort Order</small>
                                <span class="badge bg-secondary">{{ $service->sort_order }}</span>
                            </div>
                            
                            @if($service->image)
                            <div class="mb-3">
                                <small class="text-muted d-block">Image</small>
                                <img src="{{ $service->image }}" alt="{{ $service->title }}" 
                                     class="img-fluid rounded" style="max-height: 150px;">
                            </div>
                            @endif
                            
                            <hr>
                            
                            <div class="mb-2">
                                <small class="text-muted d-block">Created</small>
                                <small>{{ $service->created_at->format('M d, Y H:i') }}</small>
                            </div>
                            
                            <div>
                                <small class="text-muted d-block">Last Updated</small>
                                <small>{{ $service->updated_at->format('M d, Y H:i') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Service
                    </a>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Services
                    </a>
                    <a href="{{ route('admin.services.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Add New Service
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="content-card">
            <div class="card-header">
                <h6><i class="fas fa-chart-bar me-2"></i>Service Analytics</h6>
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-eye fa-2x text-info mb-2"></i>
                    <h6 class="text-muted">Preview on Website</h6>
                    <a href="http://localhost:3000#services" target="_blank" class="btn btn-info btn-sm">
                        <i class="fas fa-external-link-alt me-1"></i>View on Site
                    </a>
                </div>
                
                <hr>
                
                <div class="mb-3">
                    <i class="fas fa-code fa-2x text-warning mb-2"></i>
                    <h6 class="text-muted">API Endpoint</h6>
                    <small class="text-muted d-block">GET /api/v1/services/{{ $service->id }}</small>
                    <a href="{{ url('/api/v1/services/' . $service->id) }}" target="_blank" class="btn btn-warning btn-sm mt-1">
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
                    @if($service->is_active)
                        <form action="{{ route('admin.services.update', $service) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="title" value="{{ $service->title }}">
                            <input type="hidden" name="description" value="{{ $service->description }}">
                            <input type="hidden" name="content" value="{{ $service->content }}">
                            <input type="hidden" name="icon" value="{{ $service->icon }}">
                            <input type="hidden" name="image" value="{{ $service->image }}">
                            <input type="hidden" name="price" value="{{ $service->price }}">
                            <input type="hidden" name="sort_order" value="{{ $service->sort_order }}">
                            <input type="hidden" name="is_active" value="0">
                            <button type="submit" class="btn btn-warning btn-sm">
                                <i class="fas fa-pause me-1"></i>Deactivate Service
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.services.update', $service) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="title" value="{{ $service->title }}">
                            <input type="hidden" name="description" value="{{ $service->description }}">
                            <input type="hidden" name="content" value="{{ $service->content }}">
                            <input type="hidden" name="icon" value="{{ $service->icon }}">
                            <input type="hidden" name="image" value="{{ $service->image }}">
                            <input type="hidden" name="price" value="{{ $service->price }}">
                            <input type="hidden" name="sort_order" value="{{ $service->sort_order }}">
                            <input type="hidden" name="is_active" value="1">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-play me-1"></i>Activate Service
                            </button>
                        </form>
                    @endif
                    
                    <a href="{{ route('admin.services.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>Add New Service
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
