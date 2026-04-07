@extends('admin.layout-coreui-simple')
@section('title', 'Dashboard - LAMDAKU Admin')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 mb-2 text-gray-800">Dashboard Overview</h1>
            <p class="text-muted mb-0">Welcome back! Here's what's happening with LAMDAKU today.</p>
        </div>
        <div class="col-md-4 text-end">            <div class="text-muted small">
                <i class="fas fa-calendar-alt me-1"></i>
                {{ now()->format('l, F d, Y') }}
            </div>
            <div class="text-muted small">
                <i class="fas fa-clock me-1"></i>
                <span id="current-time">{{ now()->format('H:i:s') }}</span>
            </div>
        </div>
    </div>
    
    <!-- Header Row with Stats -->
    <div class="row g-3 mb-4">
        <!-- Sale Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-semibold">Rp {{ number_format(($stats['pages'] ?? 5) * 1000000, 0, ',', '.') }}</div>
                            <div>Sales</div>
                            <div class="small text-white-50">January - June 2025</div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-transparent text-white p-0" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.pages.index') }}">View Details</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.pages.create') }}">Add New</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-3">
                        <canvas id="card-chart1" height="70"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Traffic Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-semibold">{{ number_format(($stats['services'] ?? 3) * 15000, 0, ',', '.') }}</div>
                            <div>Traffic</div>
                            <div class="small text-white-50">January 1, 2024 - December 31, 2024</div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-transparent text-white p-0" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.services.index') }}">View All</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.services.create') }}">Add New</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-3">
                        <canvas id="card-chart2" height="70"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customers Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-semibold">{{ number_format(($stats['articles'] ?? 8) * 7890 + 44725, 0, ',', '.') }}</div>
                            <div>Customers</div>
                            <div class="small text-white-50">
                                <span class="text-danger">(-12.4% ↓)</span>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-transparent text-white p-0" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.articles.index') }}">View All</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.articles.create') }}">Add New</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-3">
                        <canvas id="card-chart3" height="70"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fs-4 fw-semibold">{{ number_format(($stats['contacts'] ?? 12) * 50 + 385, 0, ',', '.') }}</div>
                            <div>Orders</div>
                            <div class="small text-white-50">
                                <span class="text-success">(17.2% ↑)</span>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-transparent text-white p-0" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.contacts.index') }}">View All</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.events.index') }}">Events</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-3">
                        <canvas id="card-chart4" height="70"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Panel -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-bolt text-warning me-2"></i>
                            Quick Actions
                        </h5>
                        <small class="text-muted">Common tasks</small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('admin.pages.create') }}" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="fas fa-plus-circle me-2"></i>
                                <span>New Page</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.articles.create') }}" class="btn btn-outline-success w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="fas fa-edit me-2"></i>
                                <span>New Article</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.services.create') }}" class="btn btn-outline-info w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="fas fa-cogs me-2"></i>
                                <span>New Service</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-warning w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="fas fa-envelope me-2"></i>
                                <span>View Messages</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <!-- Main Chart Section -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title mb-0">Traffic Analytics</h4>
                            <div class="small text-body-secondary">January - July 2025</div>
                        </div>
                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                            <label class="btn btn-outline-secondary btn-sm" for="btnradio1">Day</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                            <label class="btn btn-outline-secondary btn-sm" for="btnradio2">Month</label>
                            
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                            <label class="btn btn-outline-secondary btn-sm" for="btnradio3">Year</label>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="main-chart" style="height:300px;"></canvas>
                </div>
                <div class="card-footer">
                    <div class="row text-center">
                        <div class="col">
                            <div class="text-body-secondary">Visits</div>
                            <strong>29.703 Users (40%)</strong>
                            <div class="progress progress-sm mt-2">
                                <div class="progress-bar bg-success" style="width: 40%"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-body-secondary">Unique</div>
                            <strong>24.093 Users (20%)</strong>
                            <div class="progress progress-sm mt-2">
                                <div class="progress-bar bg-info" style="width: 20%"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-body-secondary">Pageviews</div>
                            <strong>78.706 Views (60%)</strong>
                            <div class="progress progress-sm mt-2">
                                <div class="progress-bar bg-warning" style="width: 60%"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-body-secondary">New Users</div>
                            <strong>22.123 Users (80%)</strong>
                            <div class="progress progress-sm mt-2">
                                <div class="progress-bar bg-danger" style="width: 80%"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-body-secondary">Bounce Rate</div>
                            <strong>40.15%</strong>
                            <div class="progress progress-sm mt-2">
                                <div class="progress-bar" style="width: 40%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Content -->
        <div class="col-md-4">
            <!-- Social Traffic -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Social Traffic</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto">
                            <i class="fab fa-facebook fa-lg text-primary"></i>
                        </div>
                        <div class="col">
                            <div class="fs-6 fw-semibold">Facebook</div>
                            <div class="text-body-secondary small">
                                <span class="text-success">▲</span> 12.5%
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="text-end">
                                <div class="fs-6 fw-semibold">1.23k</div>
                                <div class="text-body-secondary small">Users</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-auto">
                            <i class="fab fa-twitter fa-lg text-info"></i>
                        </div>
                        <div class="col">
                            <div class="fs-6 fw-semibold">Twitter</div>
                            <div class="text-body-secondary small">
                                <span class="text-success">▲</span> 8.1%
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="text-end">
                                <div class="fs-6 fw-semibold">876</div>
                                <div class="text-body-secondary small">Users</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-auto">
                            <i class="fab fa-linkedin fa-lg text-primary"></i>
                        </div>
                        <div class="col">
                            <div class="fs-6 fw-semibold">LinkedIn</div>
                            <div class="text-body-secondary small">
                                <span class="text-danger">▼</span> -2.4%
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="text-end">
                                <div class="fs-6 fw-semibold">432</div>
                                <div class="text-body-secondary small">Users</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">New Page Created</h6>
                                <p class="timeline-description">"About LAMDAKU" page has been created</p>
                                <small class="text-muted">2 hours ago</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Article Published</h6>
                                <p class="timeline-description">"LAMDAKU Company Profile" published successfully</p>
                                <small class="text-muted">4 hours ago</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-info"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Service Updated</h6>
                                <p class="timeline-description">Consulting service portfolio updated</p>
                                <small class="text-muted">6 hours ago</small>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Contact Received</h6>
                                <p class="timeline-description">New business inquiry from potential client</p>
                                <small class="text-muted">8 hours ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Users</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Role</th>
                                    <th>Activity</th>
                                    <th>Articles</th>
                                    <th>Last Seen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">
                                                <span class="avatar-initials bg-primary">AD</span>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">Admin LAMDAKU</div>
                                                <div class="text-body-secondary small">Administrator</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger">Admin</span>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-start">95%</div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" style="width: 95%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">12</span> published
                                    </td>
                                    <td>
                                        <small class="text-body-secondary">Online now</small>
                                        <br>
                                        <small class="text-success fw-semibold">● Active</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">
                                                <span class="avatar-initials bg-info">JD</span>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">John Doe</div>
                                                <div class="text-body-secondary small">Content Writer</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">Penulis</span>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-start">78%</div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" style="width: 78%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">8</span> published
                                    </td>
                                    <td>
                                        <small class="text-body-secondary">Last seen</small>
                                        <br>
                                        <small class="text-muted">5 minutes ago</small>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">
                                                <span class="avatar-initials bg-warning">JS</span>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">Jane Smith</div>
                                                <div class="text-body-secondary small">Content Editor</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">Penulis</span>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-start">65%</div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" style="width: 65%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold">6</span> published
                                    </td>
                                    <td>
                                        <small class="text-body-secondary">Last seen</small>
                                        <br>
                                        <small class="text-muted">2 hours ago</small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Toast Container -->
    <div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <!-- Toasts will be dynamically inserted here -->
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Enhanced Dashboard Styling */
    .card.text-white .dropdown-menu {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: none;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        border-radius: 12px;
    }
    
    .card.text-white .dropdown-item {
        color: #374151;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        margin: 2px 0;
        transition: all 0.3s ease;
    }
    
    .card.text-white .dropdown-item:hover {
        background: linear-gradient(135deg, #321FDB 0%, #667eea 100%);
        color: white;
        transform: translateX(4px);
    }
    
    .fs-4.fw-semibold {
        font-size: 2.5rem !important;
        font-weight: 700 !important;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .small.text-white-50 {
        opacity: 0.8;
        font-weight: 500;
    }
    
    /* Timeline Styling */
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 6px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(180deg, #321FDB 0%, #667eea 100%);
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 20px;
    }
    
    .timeline-marker {
        position: absolute;
        left: -31px;
        top: 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .timeline-title {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 4px;
    }
    
    .timeline-description {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 4px;
        line-height: 1.4;
    }
    
    /* Avatar styling */
    .avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .avatar-initials {
        color: white;
    }
    
    /* Chart container */
    .c-chart-wrapper,
    canvas {
        position: relative;
    }
    
    /* Social icons */
    .fab {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Enhanced card hover effects */
    .card.bg-primary:hover,
    .card.bg-info:hover,
    .card.bg-warning:hover,
    .card.bg-success:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 12px 48px rgba(0,0,0,0.2);
    }
    
    /* Quick Actions Styling */
    .btn.w-100.d-flex {
        border: 2px solid;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn.w-100.d-flex::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    
    .btn.w-100.d-flex:hover::before {
        left: 100%;
    }
    
    .btn.w-100.d-flex:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    /* Real-time clock styling */
    #current-time {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: #28a745;
        text-shadow: 0 0 5px rgba(40, 167, 69, 0.3);
    }
    
    /* Counter animation */
    .fs-4.fw-semibold {
        transition: all 0.3s ease;
    }
    
    /* Enhanced pulse animation */
    .pulse-animation {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.7; }
        100% { opacity: 1; }
    }
    
    /* Loading button states */
    .btn[disabled] {
        opacity: 0.7;
        cursor: not-allowed;
    }
    
    /* Enhanced card animations */
    .card {
        animation: slideInUp 0.6s ease-out;
    }
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Stagger animation for cards */
    .row .col-sm-6:nth-child(1) .card { animation-delay: 0.1s; }
    .row .col-sm-6:nth-child(2) .card { animation-delay: 0.2s; }
    .row .col-sm-6:nth-child(3) .card { animation-delay: 0.3s; }
    .row .col-sm-6:nth-child(4) .card { animation-delay: 0.4s; }
</style>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Real-time clock
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', { 
            hour12: false,
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        const clockElement = document.getElementById('current-time');
        if (clockElement) {
            clockElement.textContent = timeString;
        }
    }
    
    // Update clock every second
    setInterval(updateClock, 1000);
    updateClock(); // Initial call
    
    // Animate counters on page load
    function animateCounters() {
        const counters = document.querySelectorAll('.fs-4.fw-semibold');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent.replace(/[^\d]/g, ''));
            if (target && target > 0) {
                let current = 0;
                const increment = target / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = counter.textContent.replace(/[\d,]+/, target.toLocaleString());
                        clearInterval(timer);
                    } else {
                        const displayValue = Math.floor(current).toLocaleString();
                        counter.textContent = counter.textContent.replace(/[\d,]+/, displayValue);
                    }
                }, 30);
            }
        });
    }
    
    // Run counter animation after a short delay
    setTimeout(animateCounters, 500);
    
    // Add loading states to quick action buttons
    document.querySelectorAll('.btn[href]').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
            this.disabled = true;
            
            // Re-enable after navigation (in case of SPA)
            setTimeout(() => {
                this.innerHTML = originalText;
                this.disabled = false;
            }, 2000);
        });
    });
    
    // Add pulse animation to online status
    const onlineIndicator = document.querySelector('.text-success.fw-semibold');
    if (onlineIndicator && onlineIndicator.textContent.includes('Active')) {
        setInterval(() => {
            onlineIndicator.style.opacity = '0.5';
            setTimeout(() => {
                onlineIndicator.style.opacity = '1';
            }, 500);
        }, 2000);
    }

    // Card Charts with enhanced animations
    const cardChart1 = new Chart(document.getElementById('card-chart1'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                data: [65, 59, 84, 84, 51, 55],
                borderColor: 'rgba(255, 255, 255, 0.8)',
                backgroundColor: 'rgba(255, 255, 255, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { 
                x: { display: false }, 
                y: { display: false } 
            },
            elements: { point: { radius: 0 } },
            maintainAspectRatio: false
        }
    });

    const cardChart2 = new Chart(document.getElementById('card-chart2'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                data: [1, 18, 9, 17, 34, 22],
                borderColor: 'rgba(255, 255, 255, 0.8)',
                backgroundColor: 'rgba(255, 255, 255, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { 
                x: { display: false }, 
                y: { display: false } 
            },
            elements: { point: { radius: 0 } },
            maintainAspectRatio: false
        }
    });

    const cardChart3 = new Chart(document.getElementById('card-chart3'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                data: [78, 81, 80, 45, 34, 12],
                borderColor: 'rgba(255, 255, 255, 0.8)',
                backgroundColor: 'rgba(255, 255, 255, 0.2)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { 
                x: { display: false }, 
                y: { display: false } 
            },
            elements: { point: { radius: 0 } },
            maintainAspectRatio: false
        }
    });

    const cardChart4 = new Chart(document.getElementById('card-chart4'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                data: [35, 23, 56, 22, 97, 23],
                backgroundColor: 'rgba(255, 255, 255, 0.6)',
                borderColor: 'rgba(255, 255, 255, 0.8)',
                borderWidth: 1
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { 
                x: { display: false }, 
                y: { display: false } 
            },
            maintainAspectRatio: false
        }
    });

    // Main Chart
    const mainChart = new Chart(document.getElementById('main-chart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Current',
                data: [65, 59, 84, 84, 51, 55, 40],
                borderColor: '#321FDB',
                backgroundColor: 'rgba(50, 31, 219, 0.1)',
                fill: true
            }, {
                label: 'Previous',
                data: [28, 48, 40, 19, 86, 27, 90],
                borderColor: '#39F',
                backgroundColor: 'rgba(51, 153, 255, 0.1)',
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Notification system
    function showNotification(message, type = 'success', duration = 3000) {
        const toastContainer = document.getElementById('toast-container');
        const toastId = 'toast-' + Date.now();
        
        const toastHTML = `
            <div id="${toastId}" class="toast align-items-center text-white bg-${type} border-0" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-check-circle me-2"></i>
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="dismissToast('${toastId}')"></button>
                </div>
            </div>
        `;
        
        toastContainer.insertAdjacentHTML('beforeend', toastHTML);
        
        const toastElement = document.getElementById(toastId);
        toastElement.classList.add('show');
        
        // Auto-dismiss after duration
        setTimeout(() => {
            dismissToast(toastId);
        }, duration);
    }
    
    function dismissToast(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }
    }
    
    // Show welcome notification after page load
    setTimeout(() => {
        showNotification('Welcome to LAMDAKU Admin Dashboard! 🎉', 'primary', 4000);
    }, 1000);
    
    // Show random activity notifications
    const activities = [
        'New page view detected',
        'Database backup completed',
        'Cache optimized successfully',
        'System performance excellent'
    ];
    
    setInterval(() => {
        const randomActivity = activities[Math.floor(Math.random() * activities.length)];
        if (Math.random() > 0.7) { // 30% chance every interval
            showNotification(randomActivity, 'info', 2000);
        }
    }, 30000); // Every 30 seconds

    console.log('Dashboard charts initialized successfully');
});
</script>
@endsection
