@extends('admin.layout-simple')

@section('page-title', $page->title)

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
    <li class="breadcrumb-item active">{{ $page->title }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-file-alt me-2"></i>{{ $page->title }}</h5>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit Page
                    </a>
                    <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" 
                                onclick="return confirm('Are you sure you want to delete this page?')">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <!-- Page Content -->
                <div class="mb-4">
                    <h6 class="fw-bold text-muted mb-3">Page Content</h6>
                    <div class="content-display border rounded p-3" style="background: #f8f9fa; max-height: 400px; overflow-y: auto;">
                        {!! nl2br(e($page->content)) !!}
                    </div>
                </div>

                <!-- SEO Information -->
                @if($page->meta_description || $page->meta_keywords)
                <div class="mb-4">
                    <h6 class="fw-bold text-muted mb-3">SEO Information</h6>
                    <div class="row">
                        @if($page->meta_description)
                        <div class="col-md-12 mb-3">
                            <small class="text-muted d-block fw-bold">Meta Description</small>
                            <p class="mb-0">{{ $page->meta_description }}</p>
                            <small class="text-muted">{{ strlen($page->meta_description) }}/160 characters</small>
                        </div>
                        @endif
                        
                        @if($page->meta_keywords)
                        <div class="col-md-12">
                            <small class="text-muted d-block fw-bold">Meta Keywords</small>
                            <div>
                                @foreach(explode(',', $page->meta_keywords) as $keyword)
                                    <span class="badge bg-light text-dark me-1">{{ trim($keyword) }}</span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                
                <hr>
                
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit Page
                    </a>
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Pages
                    </a>
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Create New Page
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <!-- Page Information -->
        <div class="content-card">
            <div class="card-header">
                <h6><i class="fas fa-info-circle me-2"></i>Page Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <small class="text-muted d-block">Status</small>
                    @if($page->is_published)
                        <span class="badge bg-success fs-6">Published</span>
                    @else
                        <span class="badge bg-danger fs-6">Draft</span>
                    @endif
                </div>
                
                <div class="mb-3">
                    <small class="text-muted d-block">URL Slug</small>
                    <code>/{{ $page->slug }}</code>
                </div>
                
                <div class="mb-3">
                    <small class="text-muted d-block">Sort Order</small>
                    <span class="badge bg-secondary">{{ $page->sort_order }}</span>
                </div>
                
                <hr>
                
                <div class="mb-2">
                    <small class="text-muted d-block">Created</small>
                    <small>{{ $page->created_at->format('M d, Y H:i') }}</small>
                </div>
                
                <div>
                    <small class="text-muted d-block">Last Updated</small>
                    <small>{{ $page->updated_at->format('M d, Y H:i') }}</small>
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
                    @if($page->is_published)
                        <form action="{{ route('admin.pages.update', $page) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="title" value="{{ $page->title }}">
                            <input type="hidden" name="content" value="{{ $page->content }}">
                            <input type="hidden" name="meta_description" value="{{ $page->meta_description }}">
                            <input type="hidden" name="meta_keywords" value="{{ $page->meta_keywords }}">
                            <input type="hidden" name="sort_order" value="{{ $page->sort_order }}">
                            <input type="hidden" name="is_published" value="0">
                            <button type="submit" class="btn btn-warning btn-sm">
                                <i class="fas fa-eye-slash me-1"></i>Unpublish Page
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.pages.update', $page) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="title" value="{{ $page->title }}">
                            <input type="hidden" name="content" value="{{ $page->content }}">
                            <input type="hidden" name="meta_description" value="{{ $page->meta_description }}">
                            <input type="hidden" name="meta_keywords" value="{{ $page->meta_keywords }}">
                            <input type="hidden" name="sort_order" value="{{ $page->sort_order }}">
                            <input type="hidden" name="is_published" value="1">
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-eye me-1"></i>Publish Page
                            </button>
                        </form>
                    @endif
                    
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>Create New Page
                    </a>
                </div>
            </div>
        </div>
        
        <!-- API Information -->
        <div class="content-card mt-4">
            <div class="card-header">
                <h6><i class="fas fa-code me-2"></i>API Information</h6>
            </div>
            <div class="card-body text-center">
                <div class="mb-3">
                    <i class="fas fa-link fa-2x text-warning mb-2"></i>
                    <h6 class="text-muted">API Endpoint</h6>
                    <small class="text-muted d-block">GET /api/v1/pages/{{ $page->id }}</small>
                    <a href="{{ url('/api/v1/pages/' . $page->id) }}" target="_blank" class="btn btn-warning btn-sm mt-1">
                        <i class="fas fa-external-link-alt me-1"></i>View JSON
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Content Statistics -->
        <div class="content-card mt-4">
            <div class="card-header">
                <h6><i class="fas fa-chart-bar me-2"></i>Content Statistics</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="mb-2">
                            <strong>{{ str_word_count($page->content) }}</strong>
                            <small class="d-block text-muted">Words</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-2">
                            <strong>{{ strlen($page->content) }}</strong>
                            <small class="d-block text-muted">Characters</small>
                        </div>
                    </div>
                </div>
                
                @if($page->meta_description)
                <hr>
                <div class="text-center">
                    <small class="text-muted">Meta Description: {{ strlen($page->meta_description) }}/160 chars</small>
                    <div class="progress mt-1" style="height: 4px;">
                        <div class="progress-bar" style="width: {{ (strlen($page->meta_description) / 160) * 100 }}%"></div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
