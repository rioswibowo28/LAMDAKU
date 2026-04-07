@extends('admin.layout-coreui')
@section('title', 'Dashboard - LAMDAKU Admin')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<!-- Welcome Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body bg-gradient text-white rounded" style="background: linear-gradient(135deg, #321FDB 0%, #4287f5 100%);">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h2 class="mb-2 fw-bold">Welcome to LAMDAKU Admin Dashboard</h2>
                        <p class="mb-0 opacity-75">Manage your content, monitor performance, and track your success metrics.</p>
                    </div>
                    <div class="col-md-4 text-end d-none d-md-block">
                        <i class="fas fa-chart-line fa-4x opacity-25"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <!-- Pages Card -->
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
                <div class="progress mb-3" style="height: 6px;">
                    <div class="progress-bar bg-primary" style="width: {{ ($stats['pages'] ?? 0) > 0 ? min(($stats['pages'] / 20) * 100, 100) : 10 }}%"></div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-primary btn-sm flex-fill">
                        <i class="fas fa-eye me-1"></i> View All
                    </a>
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary btn-sm flex-fill">
                        <i class="fas fa-plus me-1"></i> Add New
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Card -->
    <div class="col-sm-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <div class="text-success fs-1 fw-bold">{{ $stats['services'] ?? 0 }}</div>
                        <div class="text-muted fw-semibold">Total Services</div>
                    </div>
                    <div class="bg-success bg-opacity-10 rounded-3 p-3">
                        <i class="fas fa-cogs text-success fa-lg"></i>
                    </div>
                </div>
                <div class="progress mb-3" style="height: 6px;">
                    <div class="progress-bar bg-success" style="width: {{ ($stats['services'] ?? 0) > 0 ? min(($stats['services'] / 20) * 100, 100) : 30 }}%"></div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-success btn-sm flex-fill">
                        <i class="fas fa-eye me-1"></i> View All
                    </a>
                    <a href="{{ route('admin.services.create') }}" class="btn btn-success btn-sm flex-fill">
                        <i class="fas fa-plus me-1"></i> Add New
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Articles Card -->
    <div class="col-sm-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <div class="text-warning fs-1 fw-bold">{{ $stats['articles'] ?? 0 }}</div>
                        <div class="text-muted fw-semibold">Total Articles</div>
                    </div>
                    <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                        <i class="fas fa-newspaper text-warning fa-lg"></i>
                    </div>
                </div>
                <div class="progress mb-3" style="height: 6px;">
                    <div class="progress-bar bg-warning" style="width: {{ ($stats['articles'] ?? 0) > 0 ? min(($stats['articles'] / 20) * 100, 100) : 25 }}%"></div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-warning btn-sm flex-fill">
                        <i class="fas fa-eye me-1"></i> View All
                    </a>
                    <a href="{{ route('admin.articles.create') }}" class="btn btn-warning btn-sm flex-fill">
                        <i class="fas fa-plus me-1"></i> Add New
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages Card -->
    <div class="col-sm-6 col-lg-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <div class="text-danger fs-1 fw-bold">{{ $stats['contacts'] ?? 0 }}</div>
                        <div class="text-muted fw-semibold">Messages</div>
                    </div>
                    <div class="bg-danger bg-opacity-10 rounded-3 p-3">
                        <i class="fas fa-envelope text-danger fa-lg"></i>
                    </div>
                </div>
                <div class="progress mb-3" style="height: 6px;">
                    <div class="progress-bar bg-danger" style="width: {{ ($stats['contacts'] ?? 0) > 0 ? min(($stats['contacts'] / 20) * 100, 100) : 35 }}%"></div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-danger btn-sm flex-fill">
                        <i class="fas fa-eye me-1"></i> View All
                    </a>
                    <a href="{{ route('admin.events.index') }}" class="btn btn-danger btn-sm flex-fill">
                        <i class="fas fa-calendar me-1"></i> Events
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Row -->
<div class="row g-4 mb-4">
    <!-- Analytics Chart -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0 fw-bold text-dark">Analytics Overview</h5>
                    <p class="text-muted small mb-0">Your content performance metrics</p>
                </div>
                <div class="btn-group btn-group-sm" role="group">
                    <input type="radio" class="btn-check" name="period" id="day" autocomplete="off">
                    <label class="btn btn-outline-primary" for="day">Day</label>
                    <input type="radio" class="btn-check" name="period" id="month" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="month">Month</label>
                    <input type="radio" class="btn-check" name="period" id="year" autocomplete="off">
                    <label class="btn btn-outline-primary" for="year">Year</label>
                </div>
            </div>
            <div class="card-body">
                <div class="position-relative" style="height: 350px;">
                    <canvas id="main-chart"></canvas>
                </div>
            </div>
            <div class="card-footer bg-light border-0">
                <div class="row text-center">
                    <div class="col">
                        <div class="text-muted small">Total Views</div>
                        <div class="fw-bold text-primary">29,703</div>
                    </div>
                    <div class="col">
                        <div class="text-muted small">Unique Visitors</div>
                        <div class="fw-bold text-success">24,093</div>
                    </div>
                    <div class="col">
                        <div class="text-muted small">Page Views</div>
                        <div class="fw-bold text-warning">78,706</div>
                    </div>
                    <div class="col">
                        <div class="text-muted small">New Users</div>
                        <div class="fw-bold text-info">22,123</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Info -->
    <div class="col-lg-4">
        <div class="row g-4 h-100">
            <!-- Quick Actions -->
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0">
                        <h6 class="card-title mb-0 fw-bold text-dark">Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            <a href="{{ route('admin.pages.create') }}" class="btn btn-light border d-flex align-items-center text-start">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-file-alt text-primary"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold text-dark">Create Page</div>
                                    <small class="text-muted">Add new content page</small>
                                </div>
                            </a>

                            <a href="{{ route('admin.articles.create') }}" class="btn btn-light border d-flex align-items-center text-start">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-newspaper text-success"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold text-dark">Write Article</div>
                                    <small class="text-muted">Create new article</small>
                                </div>
                            </a>

                            <a href="{{ route('admin.services.create') }}" class="btn btn-light border d-flex align-items-center text-start">
                                <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-cogs text-warning"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold text-dark">Add Service</div>
                                    <small class="text-muted">New service offering</small>
                                </div>
                            </a>

                            <a href="{{ route('admin.company.index') }}" class="btn btn-light border d-flex align-items-center text-start">
                                <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-building text-info"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold text-dark">Company Info</div>
                                    <small class="text-muted">Update profile</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Status -->
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0">
                        <h6 class="card-title mb-0 fw-bold text-dark">System Status</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-6 text-center">
                                <div class="text-success fs-4 fw-bold">99.9%</div>
                                <div class="text-muted small">Uptime</div>
                            </div>
                            <div class="col-6 text-center">
                                <div class="text-primary fs-4 fw-bold">{{ ($stats['pages'] ?? 0) + ($stats['services'] ?? 0) + ($stats['articles'] ?? 0) }}</div>
                                <div class="text-muted small">Total Content</div>
                            </div>
                            <div class="col-6 text-center">
                                <div class="text-warning fs-4 fw-bold">2.3s</div>
                                <div class="text-muted small">Load Time</div>
                            </div>
                            <div class="col-6 text-center">
                                <div class="text-success fs-4 fw-bold">Active</div>
                                <div class="text-muted small">Status</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="row g-4">
    <!-- Recent Content -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-0 fw-bold text-dark">Recent Content</h6>
                    <p class="text-muted small mb-0">Latest updates</p>
                </div>
                <a href="{{ route('admin.pages.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                @if(($stats['pages'] ?? 0) > 0 || ($stats['articles'] ?? 0) > 0 || ($stats['services'] ?? 0) > 0)
                    <div class="list-group list-group-flush">
                        @if(($stats['pages'] ?? 0) > 0)
                            <div class="list-group-item border-0 px-0 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-file-alt text-primary"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold text-dark">Sample Page</div>
                                        <small class="text-muted">Last updated today</small>
                                    </div>
                                    <span class="badge bg-success">Published</span>
                                </div>
                            </div>
                        @endif
                        
                        @if(($stats['services'] ?? 0) > 0)
                            <div class="list-group-item border-0 px-0 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-cogs text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold text-dark">Service Portfolio</div>
                                        <small class="text-muted">Updated 2 hours ago</small>
                                    </div>
                                    <span class="badge bg-info">Active</span>
                                </div>
                            </div>
                        @endif
                        
                        @if(($stats['articles'] ?? 0) > 0)
                            <div class="list-group-item border-0 px-0 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-newspaper text-warning"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold text-dark">Latest Article</div>
                                        <small class="text-muted">Published yesterday</small>
                                    </div>
                                    <span class="badge bg-success">Published</span>
                                </div>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-plus-circle text-muted fa-3x mb-3"></i>
                        <h6 class="text-muted">No content created yet</h6>
                        <p class="text-muted small mb-3">Start by creating your first page or article</p>
                        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary btn-sm me-2">Create Page</a>
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-outline-primary btn-sm">Write Article</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Messages -->
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-0 fw-bold text-dark">Recent Messages</h6>
                    <p class="text-muted small mb-0">Customer inquiries</p>
                </div>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                @if(($stats['contacts'] ?? 0) > 0)
                    <div class="list-group list-group-flush">
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-envelope text-danger"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold text-dark">Customer Inquiry</div>
                                    <small class="text-muted">Received 1 hour ago</small>
                                </div>
                                <span class="badge bg-warning">Unread</span>
                            </div>
                        </div>
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-comment text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold text-dark">Feedback Message</div>
                                    <small class="text-muted">Received yesterday</small>
                                </div>
                                <span class="badge bg-success">Read</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-envelope-open text-muted fa-3x mb-3"></i>
                        <h6 class="text-muted">No messages yet</h6>
                        <p class="text-muted small mb-0">Customer messages will appear here</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Main Chart
    const mainChart = new Chart(document.getElementById('main-chart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Page Views',
                backgroundColor: 'rgba(50, 31, 219, 0.1)',
                borderColor: '#321FDB',
                pointBackgroundColor: '#321FDB',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                borderWidth: 3,
                data: [165, 180, 270, 200, 277, 250, 325, 365, 275, 391, 373, 338],
                fill: true,
                tension: 0.4
            }, {
                label: 'Unique Visitors',
                backgroundColor: 'rgba(46, 184, 92, 0.1)',
                borderColor: '#2EB85C',
                pointBackgroundColor: '#2EB85C',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                borderWidth: 3,
                data: [92, 97, 180, 156, 186, 197, 183, 198, 187, 198, 193, 183],
                fill: true,
                tension: 0.4
            }, {
                label: 'New Users',
                backgroundColor: 'rgba(51, 153, 255, 0.1)',
                borderColor: '#39F',
                pointBackgroundColor: '#39F',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                borderWidth: 3,
                data: [50, 50, 145, 120, 142, 154, 155, 156, 150, 161, 155, 148],
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: '#ddd',
                    borderWidth: 1
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 11
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        font: {
                            size: 11
                        }
                    }
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
            elements: {
                point: {
                    hoverRadius: 8,
                    hoverBorderWidth: 3
                }
            }
        }
    });

    // Add some animation to cards
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Add hover effects to quick action buttons
    const actionButtons = document.querySelectorAll('.btn-light.border');
    actionButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '';
        });
    });

    console.log('CoreUI Dashboard loaded successfully');
});
</script>
@endsection
