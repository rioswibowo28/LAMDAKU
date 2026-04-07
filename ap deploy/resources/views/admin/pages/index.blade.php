@extends('admin.layout-simple')

@section('title', 'Kelola Halaman - LAMDAKU Admin')
@section('page-title', 'Kelola Halaman')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-file-alt me-2"></i>Website Pages</h5>
                <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add New Page
                </a>
            </div>
            <div class="card-body p-0">
                @if($pages->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Last Modified</th>
                                    <th>Sort Order</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pages as $page)
                                <tr>
                                    <td>{{ $page->id }}</td>
                                    <td>
                                        <strong>{{ $page->title }}</strong>
                                        @if($page->meta_description)
                                            <br><small class="text-muted">{{ Str::limit($page->meta_description, 60) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <code>/{{ $page->slug }}</code>
                                    </td>
                                    <td>
                                        @if($page->is_published)
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-danger">Draft</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $page->updated_at->format('M d, Y') }}
                                        <br><small class="text-muted">{{ $page->updated_at->format('H:i') }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $page->sort_order }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.pages.show', $page) }}" class="btn btn-outline-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete" 
                                                        onclick="return confirm('Are you sure you want to delete this page?')">
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
                        <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No Pages Found</h5>
                        <p class="text-muted">Create your first page to get started.</p>
                        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Create First Page
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Page Statistics -->
@if($pages->count() > 0)
<div class="row mt-4">
    <div class="col-md-3">
        <div class="stats-card primary">
            <div class="stats-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <h4>{{ $pages->count() }}</h4>
            <p>Total Pages</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card success">
            <div class="stats-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h4>{{ $pages->where('is_published', true)->count() }}</h4>
            <p>Published</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card warning">
            <div class="stats-icon">
                <i class="fas fa-edit"></i>
            </div>
            <h4>{{ $pages->where('is_published', false)->count() }}</h4>
            <p>Drafts</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card info">
            <div class="stats-icon">
                <i class="fas fa-clock"></i>
            </div>
            <h4>{{ $pages->where('updated_at', '>=', now()->subDays(7))->count() }}</h4>
            <p>Updated This Week</p>
        </div>
    </div>
</div>
@endif
@endsection
