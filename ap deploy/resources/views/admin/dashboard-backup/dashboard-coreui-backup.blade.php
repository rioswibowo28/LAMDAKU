@extends('admin.layout-coreui')
@section('title', 'Dashboard - LAMDAKU Admin')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body bg-gradient-primary text-white rounded" style="background: linear-gradient(135deg, #321FDB 0%, #0066FF 100%);">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-2 fw-bold">Welcome to LAMDAKU Admin Dashboard</h2>
                        <p class="mb-0 opacity-75">Manage your content, monitor performance, and track your success metrics.</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <i class="fas fa-chart-line fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <div class="text-primary fs-1 fw-bold">{{ $stats['pages'] ?? 0 }}</div>
                        <div class="text-muted fw-semibold">Total Pages</div>
                    </div>
                    <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                        <i class="fas fa-file-alt text-primary fa-lg"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="progress" style="height: 4px;">
                            <div class="progress-bar bg-primary" style="width: {{ ($stats['pages'] ?? 0) > 0 ? min(($stats['pages'] / 10) * 100, 100) : 10 }}%"></div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-primary btn-sm me-2">
                        <i class="fas fa-eye me-1"></i> View All
                    </a>
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i> Add New
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-success">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">{{ $stats['services'] ?? 0 }}</div>
                    <div>Services</div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon icon-lg cil-options"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('admin.services.index') }}">View All</a>
                        <a class="dropdown-item" href="{{ route('admin.services.create') }}">Add New</a>
                    </div>
                </div>
            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <canvas class="chart" id="card-chart2" height="70"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-warning">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">{{ $stats['contacts'] ?? 0 }}</div>
                    <div>Contacts</div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon icon-lg cil-options"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('admin.contacts.index') }}">View All</a>
                    </div>
                </div>
            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <canvas class="chart" id="card-chart3" height="70"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-danger">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">{{ $stats['total_articles'] ?? 0 }}</div>
                    <div>Articles</div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon icon-lg cil-options"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('admin.articles.index') }}">View All</a>
                        <a class="dropdown-item" href="{{ route('admin.articles.create') }}">Add New</a>
                    </div>
                </div>
            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <canvas class="chart" id="card-chart4" height="70"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Main Chart -->
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title mb-0">Website Analytics</h4>
                        <div class="small text-body-secondary">January - December 2024</div>
                    </div>
                    <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                        <div class="btn-group btn-group-toggle mx-3" data-coreui-toggle="buttons">
                            <input class="btn-check" id="option1" type="radio" name="options" autocomplete="off">
                            <label class="btn btn-outline-secondary" for="option1">Day</label>
                            <input class="btn-check" id="option2" type="radio" name="options" autocomplete="off" checked="">
                            <label class="btn btn-outline-secondary active" for="option2">Month</label>
                            <input class="btn-check" id="option3" type="radio" name="options" autocomplete="off">
                            <label class="btn btn-outline-secondary" for="option3">Year</label>
                        </div>
                    </div>
                </div>
                <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
                    <canvas class="chart" id="main-chart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Articles -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <strong>Recent Articles</strong>
                <small class="text-body-secondary"> - Latest posts</small>
            </div>
            <div class="card-body">
                @if(isset($recent_articles) && $recent_articles->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Views</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_articles->take(5) as $article)
                                <tr>
                                    <td>
                                        <strong>{{ Str::limit($article->title, 40) }}</strong>
                                    </td>
                                    <td>{{ $article->author->name ?? 'Unknown' }}</td>
                                    <td>
                                        @if($article->status === 'published')
                                            <span class="badge bg-success">Published</span>
                                        @elseif($article->status === 'draft')
                                            <span class="badge bg-warning">Draft</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($article->status) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($article->view_count) }}</td>
                                    <td>{{ $article->created_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="cil-newspaper icon-2x text-muted mb-2"></i>
                        <p class="text-muted">No articles found</p>
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary btn-sm">Create First Article</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <strong>Quick Actions</strong>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                        <i class="cil-plus me-2"></i>New Article
                    </a>
                    <a href="{{ route('admin.services.create') }}" class="btn btn-success">
                        <i class="cil-settings me-2"></i>New Service
                    </a>
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-warning">
                        <i class="cil-layers me-2"></i>New Page
                    </a>
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-info">
                        <i class="cil-envelope-letter me-2"></i>View Messages
                    </a>
                </div>
                
                <hr>
                
                <div class="progress-group mb-4">
                    <div class="progress-group-prepend">
                        <span class="text-body-secondary small">Content Progress</span>
                    </div>
                    <div class="progress-group-bars">
                        <div class="progress progress-thin">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="progress-group-append">
                        <span class="text-body-secondary small">75%</span>
                    </div>
                </div>
                
                <div class="progress-group mb-4">
                    <div class="progress-group-prepend">
                        <span class="text-body-secondary small">Services Setup</span>
                    </div>
                    <div class="progress-group-bars">
                        <div class="progress progress-thin">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="progress-group-append">
                        <span class="text-body-secondary small">60%</span>
                    </div>
                </div>
            </div>        </div>
    </div>
</div>

    <!-- Stats Cards -->
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">{{ $stats['pages'] ?? 241 }}</div>
                    <div>Pages</div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon icon-lg cil-options"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('admin.pages.index') }}">View All</a>
                        <a class="dropdown-item" href="{{ route('admin.pages.create') }}">Add New</a>
                    </div>
                </div>
            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <canvas class="chart" id="card-chart1" height="70"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">{{ $stats['services'] ?? 178 }}</div>
                    <div>Services</div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon icon-lg cil-options"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('admin.services.index') }}">View All</a>
                        <a class="dropdown-item" href="{{ route('admin.services.create') }}">Add New</a>
                    </div>
                </div>
            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <canvas class="chart" id="card-chart2" height="70"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-warning">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">{{ $stats['contacts'] ?? 67 }}</div>
                    <div>Contacts</div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon icon-lg cil-options"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('admin.contacts.index') }}">View All</a>
                    </div>
                </div>
            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <canvas class="chart" id="card-chart3" height="70"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-danger">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">{{ $stats['total_articles'] ?? 89 }}</div>
                    <div>Articles</div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon icon-lg cil-options"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('admin.articles.index') }}">View All</a>
                        <a class="dropdown-item" href="{{ route('admin.articles.create') }}">Add New</a>
                    </div>
                </div>
            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <canvas class="chart" id="card-chart4" height="70"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Main Chart -->
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title mb-0">Traffic</h4>
                        <div class="small text-muted">January - July 2024</div>
                    </div>
                    <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
                        <div class="btn-group btn-group-toggle mx-3" data-coreui-toggle="buttons">
                            <input class="btn-check" id="option1" type="radio" name="options" autocomplete="off">
                            <label class="btn btn-outline-secondary" for="option1">Day</label>
                            <input class="btn-check" id="option2" type="radio" name="options" autocomplete="off" checked="">
                            <label class="btn btn-outline-secondary active" for="option2">Month</label>
                            <input class="btn-check" id="option3" type="radio" name="options" autocomplete="off">
                            <label class="btn btn-outline-secondary" for="option3">Year</label>
                        </div>
                        <button class="btn btn-primary" type="button">
                            <i class="icon icon-lg cil-cloud-download"></i>
                        </button>
                    </div>
                </div>
                <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
                    <canvas class="chart" id="main-chart" height="300"></canvas>
                </div>
            </div>
            <div class="card-footer">
                <div class="row row-cols-1 row-cols-md-5 text-center">
                    <div class="col mb-sm-2 mb-0">
                        <div class="text-muted">Visits</div>
                        <strong>29.703 Users (40%)</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col mb-sm-2 mb-0">
                        <div class="text-muted">Unique</div>
                        <strong>24.093 Users (20%)</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col mb-sm-2 mb-0">
                        <div class="text-muted">Pageviews</div>
                        <strong>78.706 Views (60%)</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col mb-sm-2 mb-0">
                        <div class="text-muted">New Users</div>
                        <strong>22.123 Users (80%)</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="col mb-sm-2 mb-0">
                        <div class="text-muted">Bounce Rate</div>
                        <strong>Average Rate (40.15%)</strong>
                        <div class="progress progress-xs mt-2">
                            <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Articles -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <strong>Recent Articles</strong>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-primary float-end">View All</a>
            </div>
            <div class="card-body">
                @if(isset($recent_articles) && $recent_articles->count() > 0)
                    @foreach($recent_articles->take(5) as $article)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <div class="fw-semibold">{{ Str::limit($article->title, 40) }}</div>
                                <div class="small text-muted">{{ $article->author->name }}</div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-{{ $article->status === 'published' ? 'success' : ($article->status === 'draft' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                                <div class="small text-muted">{{ number_format($article->view_count) }} views</div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-4">
                        <i class="cil-newspaper icon-2xl text-muted"></i>
                        <p class="text-muted mt-2">No articles found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Contacts -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <strong>Recent Contacts</strong>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-primary float-end">View All</a>
            </div>
            <div class="card-body">
                @if(isset($recent_contacts) && $recent_contacts->count() > 0)
                    @foreach($recent_contacts->take(5) as $contact)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <div class="fw-semibold">{{ $contact->name }}</div>
                                <div class="small text-muted">{{ $contact->email }}</div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-{{ $contact->is_read ? 'success' : 'warning' }}">
                                    {{ $contact->is_read ? 'Read' : 'Unread' }}
                                </span>
                                <div class="small text-muted">{{ $contact->created_at->format('M d') }}</div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-4">
                        <i class="cil-envelope-open icon-2xl text-muted"></i>
                        <p class="text-muted mt-2">No contacts found</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- System Status -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <strong>System Status</strong>
            </div>
            <div class="card-body">
                <div class="progress-group mb-4">
                    <div class="progress-group-prepend">
                        <span class="text-muted">Monday</span>
                    </div>
                    <div class="progress-group-bars">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 34%" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="progress-group mb-4">
                    <div class="progress-group-prepend">
                        <span class="text-muted">Tuesday</span>
                    </div>
                    <div class="progress-group-bars">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 94%" aria-valuenow="94" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="progress-group mb-4">
                    <div class="progress-group-prepend">
                        <span class="text-muted">Wednesday</span>
                    </div>
                    <div class="progress-group-bars">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="progress-group mb-4">
                    <div class="progress-group-prepend">
                        <span class="text-muted">Thursday</span>
                    </div>
                    <div class="progress-group-bars">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 91%" aria-valuenow="91" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="progress-group mb-4">
                    <div class="progress-group-prepend">
                        <span class="text-muted">Friday</span>
                    </div>
                    <div class="progress-group-bars">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 73%" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="progress-group mb-4">
                    <div class="progress-group-prepend">
                        <span class="text-muted">Saturday</span>
                    </div>
                    <div class="progress-group-bars">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 53%" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                <div class="progress-group mb-4">
                    <div class="progress-group-prepend">
                        <span class="text-muted">Sunday</span>
                    </div>
                    <div class="progress-group-bars">
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 9%" aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress progress-xs">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 69%" aria-valuenow="69" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <strong>Quick Actions</strong>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6">
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary w-100 py-3">
                            <i class="cil-plus icon-lg mb-2 d-block"></i>
                            <small>New Article</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.services.create') }}" class="btn btn-info w-100 py-3">
                            <i class="cil-settings icon-lg mb-2 d-block"></i>
                            <small>New Service</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.pages.create') }}" class="btn btn-warning w-100 py-3">
                            <i class="cil-layers icon-lg mb-2 d-block"></i>
                            <small>New Page</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.company.index') }}" class="btn btn-success w-100 py-3">
                            <i class="cil-building icon-lg mb-2 d-block"></i>
                            <small>Company Info</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Card Charts
    const cardChart1 = new Chart(document.getElementById('card-chart1'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                data: [65, 59, 84, 84, 51, 55, 40],
                borderColor: 'rgba(255,255,255,.55)',
                borderWidth: 2,
                fill: false,
                pointRadius: 0,
                pointHoverRadius: 0,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    display: false
                },
                y: {
                    display: false
                }
            },
            elements: {
                line: {
                    borderWidth: 1
                },
                point: {
                    radius: 4,
                    hitRadius: 10,
                    hoverRadius: 4
                }
            }
        }
    });

    const cardChart2 = new Chart(document.getElementById('card-chart2'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                data: [1, 18, 9, 17, 34, 22, 11],
                borderColor: 'rgba(255,255,255,.55)',
                borderWidth: 2,
                fill: false,
                pointRadius: 0,
                pointHoverRadius: 0,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    display: false
                },
                y: {
                    display: false
                }
            }
        }
    });

    const cardChart3 = new Chart(document.getElementById('card-chart3'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                data: [78, 81, 80, 45, 34, 12, 40],
                borderColor: 'rgba(255,255,255,.55)',
                borderWidth: 2,
                fill: false,
                pointRadius: 0,
                pointHoverRadius: 0,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    display: false
                },
                y: {
                    display: false
                }
            }
        }
    });

    const cardChart4 = new Chart(document.getElementById('card-chart4'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                data: [78, 81, 80, 45, 34, 12, 40, 85, 65, 23, 12, 98],
                backgroundColor: 'rgba(255,255,255,.2)',
                borderColor: 'rgba(255,255,255,.55)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    display: false
                },
                y: {
                    display: false
                }
            }
        }
    });

    // Main Chart
    const mainChart = new Chart(document.getElementById('main-chart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'My First dataset',
                backgroundColor: 'transparent',
                borderColor: '#321FDB',
                pointHoverBackgroundColor: '#321FDB',
                borderWidth: 2,
                data: [165, 180, 70, 69, 77, 57, 125, 165, 172, 91, 173, 138]
            }, {
                label: 'My Second dataset',
                backgroundColor: 'transparent',
                borderColor: '#39F',
                pointHoverBackgroundColor: '#39F',
                borderWidth: 2,
                data: [92, 97, 80, 100, 86, 97, 83, 98, 87, 98, 93, 83]
            }, {
                label: 'My Third dataset',
                backgroundColor: 'transparent',
                borderColor: '#2EB85C',
                pointHoverBackgroundColor: '#2EB85C',
                borderWidth: 2,
                data: [50, 50, 45, 60, 42, 54, 55, 56, 50, 61, 55, 48]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    grid: {
                        drawOnChartArea: false
                    }
                },
                y: {
                    ticks: {
                        beginAtZero: true,
                        maxTicksLimit: 5,
                        stepSize: Math.ceil(250 / 5),
                        max: 250
                    }
                }
            },
            elements: {
                point: {
                    radius: 0,
                    hitRadius: 10,
                    hoverRadius: 4,
                    hoverBorderWidth: 3
                }
            }
        }
    });
});
</script>
@endsection
