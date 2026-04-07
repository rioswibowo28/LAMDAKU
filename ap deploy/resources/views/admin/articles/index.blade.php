@extends('admin.layout-simple')

@section('title', 'Kelola Artikel - LAMDAKU Admin')
@section('page-title', 'Kelola Artikel')

@section('content')
<div class="container-fluid">
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $articles->count() }}</div>
                        <div>Total Articles</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.articles.create') }}">Add New</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-success">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $articles->where('status', 'published')->count() }}</div>
                        <div>Published</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.articles.index', ['status' => 'published']) }}">View Published</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $articles->where('status', 'draft')->count() }}</div>
                        <div>Drafts</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.articles.index', ['status' => 'draft']) }}">View Drafts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $articles->where('created_at', '>=', now()->subDays(7))->count() }}</div>
                        <div>This Week</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.articles.create') }}">Add New</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-newspaper me-2"></i>Articles Management
                        </h4>
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add New Article
                        </a>
                    </div>
                </div>
                
                <!-- Filters -->
                <div class="card-body border-bottom">
                    <form method="GET" class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Search Articles</label>
                            <input type="text" name="search" class="form-control" placeholder="Search by title or content..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select">
                                <option value="">All Categories</option>
                                @foreach(['news', 'announcements', 'events', 'general'] as $cat)
                                    <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>
                                        {{ ucfirst($cat) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-outline-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    @if($articles->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Article</th>
                                        <th>Category</th>
                                        <th>Author</th>
                                        <th>Status</th>
                                        <th>Views</th>
                                        <th>Published</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($articles as $article)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($article->featured_image)
                                                    <img src="{{ asset('storage/' . $article->featured_image) }}" alt="Article Image" class="me-3" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                                                @else
                                                    <div class="me-3 bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 40px; border-radius: 4px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="fw-semibold">{{ Str::limit($article->title, 40) }}</div>
                                                    <small class="text-muted">{{ Str::limit(strip_tags($article->content), 50) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ ucfirst($article->category) }}</span>
                                        </td>
                                        <td>
                                            <div class="small">
                                                {{ $article->author->name ?? 'Unknown' }}
                                                <br><span class="text-muted">{{ $article->author->username ?? '-' }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $article->status === 'published' ? 'success' : 'warning' }}">
                                                {{ ucfirst($article->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-eye me-1 text-muted"></i>
                                                <span>{{ $article->views_count ?? 0 }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            @if($article->published_at)
                                                <div class="small">
                                                    {{ $article->published_at->format('M d, Y') }}
                                                    <br><span class="text-muted">{{ $article->published_at->format('H:i') }}</span>
                                                </div>
                                            @else
                                                <span class="text-muted">Not published</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.articles.show', $article) }}" class="btn btn-outline-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-outline-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger" title="Delete" 
                                                            onclick="return confirm('Are you sure you want to delete this article?')">
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
                        
                        @if(method_exists($articles, 'hasPages') && $articles->hasPages())
                            <div class="card-footer">
                                {{ $articles->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">No Articles Found</h5>
                            <p class="text-muted">Start by creating your first article.</p>
                            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Create First Article
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection