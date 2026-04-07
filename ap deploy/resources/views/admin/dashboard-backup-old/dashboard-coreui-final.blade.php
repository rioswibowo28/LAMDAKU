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
            <h1 class="h3 mb-2 fw-bold text-dark">Dashboard Overview</h1>
            <p class="text-muted mb-0">Welcome back! Here's what's happening with LAMDAKU today.</p>
        </div>
        <div class="col-md-4 text-end">
            <div class="text-muted small">
                <i class="fas fa-calendar-alt me-1"></i>
                {{ now()->format('l, F d, Y') }}
            </div>
            <div class="text-muted small">
                <i class="fas fa-clock me-1"></i>
                <span id="current-time">{{ now()->format('H:i:s') }}</span>
            </div>
        </div>
    </div>

    <!-- CoreUI Stats Cards -->
    <div class="row g-3 mb-4">
        <!-- Sales Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">Rp {{ number_format(($stats['pages'] ?? 5) * 1000000, 0, ',', '.') }}</div>
                        <div>Sale</div>
                        <div class="small text-white-50">Monthly June 2024</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-bs-toggle="dropdown">
                            <i class="cil-options"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.pages.index') }}">View All</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.pages.create') }}">Add New</a></li>
                        </ul>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
            </div>
        </div>

        <!-- Traffic Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ number_format(($stats['services'] ?? 3) * 30000, 0, ',', '.') }}</div>
                        <div>Traffic</div>
                        <div class="small text-white-50">Jan 1, 2024 - Dec 31, 2024</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-bs-toggle="dropdown">
                            <i class="cil-options"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.services.index') }}">View All</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.services.create') }}">Add New</a></li>
                        </ul>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart2" height="70"></canvas>
                </div>
            </div>
        </div>

        <!-- Customers Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ number_format(($stats['articles'] ?? 15) * 5000 + 50000, 0, ',', '.') }}</div>
                        <div>Customers</div>
                        <div class="small text-white-50">Monthly</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-bs-toggle="dropdown">
                            <i class="cil-options"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.articles.index') }}">View All</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.articles.create') }}">Add New</a></li>
                        </ul>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart3" height="70"></canvas>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-success">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ ($stats['contacts'] ?? 12) * 35 + 85 }}</div>
                        <div>Orders</div>
                        <div class="small text-white-50">Monthly</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-bs-toggle="dropdown">
                            <i class="cil-options"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.contacts.index') }}">View All</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.events.index') }}">Events</a></li>
                        </ul>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart4" height="70"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Panel -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0 fw-semibold">
                        <i class="cil-bolt me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('admin.pages.create') }}" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="cil-plus me-2"></i>
                                <span>New Page</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.articles.create') }}" class="btn btn-outline-success w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="cil-pencil me-2"></i>
                                <span>New Article</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.services.create') }}" class="btn btn-outline-info w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="cil-settings me-2"></i>
                                <span>New Service</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-warning w-100 d-flex align-items-center justify-content-center py-3">
                                <i class="cil-envelope-letter me-2"></i>
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
                            <label class="btn btn-outline-secondary" for="btnradio1">Day</label>
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                            <label class="btn btn-outline-secondary" for="btnradio2">Month</label>
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                            <label class="btn btn-outline-secondary" for="btnradio3">Year</label>
                        </div>
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
                            <div class="text-body-secondary">Visits</div>
                            <strong>29.703 Users (40%)</strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 40%"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-body-secondary">Unique</div>
                            <strong>24.093 Users (20%)</strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 20%"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-body-secondary">Pageviews</div>
                            <strong>78.706 Views (60%)</strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 60%"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-body-secondary">New Users</div>
                            <strong>22.123 Users (80%)</strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 80%"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-body-secondary">Bounce Rate</div>
                            <strong>Average Rate (40.15%)</strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar" role="progressbar" style="width: 40%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Section -->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Users</strong>
                    <span class="badge bg-secondary ms-2">{{ ($stats['users'] ?? 8) }} Users</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>User</th>
                                    <th class="text-center">Country</th>
                                    <th>Usage</th>
                                    <th class="text-center">Activity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">
                                                <span class="avatar-initials bg-primary">YZ</span>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">Yiorgos Avraamu</div>
                                                <div class="text-body-secondary small">New</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">🇺🇸</td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-start">
                                                <strong>50%</strong>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-body-secondary">Last login</small>
                                        <br>
                                        <small class="text-success fw-semibold">● 10 sec ago</small>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar me-3">
                                                <span class="avatar-initials bg-danger">AD</span>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">Admin LAMDAKU</div>
                                                <div class="text-body-secondary small">Administrator</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">🇮🇩</td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-start">
                                                <strong>95%</strong>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 95%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-body-secondary">Last login</small>
                                        <br>
                                        <small class="text-success fw-semibold">● Online now</small>
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
                                                <div class="text-body-secondary small">Editor</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">🇬🇧</td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-start">
                                                <strong>72%</strong>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 72%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-body-secondary">Last login</small>
                                        <br>
                                        <small class="text-warning fw-semibold">● 2 hours ago</small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>Recent Content Activity</strong>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @if(($stats['pages'] ?? 0) > 0)
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="cil-layers text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold text-dark">{{ $stats['pages'] }} Pages Created</div>
                                    <small class="text-muted">Content management system</small>
                                </div>
                                <small class="text-muted">Active</small>
                            </div>
                        </div>
                        @endif
                        
                        @if(($stats['services'] ?? 0) > 0)
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="cil-settings text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold text-dark">{{ $stats['services'] }} Services Available</div>
                                    <small class="text-muted">Service portfolio updated</small>
                                </div>
                                <small class="text-muted">2 hours ago</small>
                            </div>
                        </div>
                        @endif
                        
                        @if(($stats['articles'] ?? 0) > 0)
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="cil-newspaper text-warning"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold text-dark">{{ $stats['articles'] }} Articles Published</div>
                                    <small class="text-muted">Latest content updates</small>
                                </div>
                                <small class="text-muted">Yesterday</small>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>Communication</strong>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @if(($stats['contacts'] ?? 0) > 0)
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="cil-envelope-letter text-danger"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold text-dark">{{ $stats['contacts'] }} New Messages</div>
                                    <small class="text-muted">Customer inquiries received</small>
                                </div>
                                <span class="badge bg-danger">New</span>
                            </div>
                        </div>
                        @endif
                        
                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="cil-calendar text-info"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold text-dark">System Status</div>
                                    <small class="text-muted">All systems operational</small>
                                </div>
                                <span class="badge bg-success">Online</span>
                            </div>
                        </div>

                        <div class="list-group-item border-0 px-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="cil-shield-alt text-success"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-semibold text-dark">Security Update</div>
                                    <small class="text-muted">Admin session secured</small>
                                </div>
                                <span class="badge bg-primary">Active</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Dashboard CoreUI Final initialized');
    
    // Real-time clock
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', { hour12: false });
        const clockElement = document.getElementById('current-time');
        if (clockElement) {
            clockElement.textContent = timeString;
        }
    }
    
    updateClock(); // Run immediately
    setInterval(updateClock, 1000);
      // Card Charts
    const cardChart1Element = document.getElementById('card-chart1');
    if (cardChart1Element) {
        console.log('Initializing chart 1');
        const cardChart1 = new Chart(cardChart1Element, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    data: [65, 59, 84, 84, 51, 55],
                    borderColor: 'rgba(255,255,255,0.55)',
                backgroundColor: 'transparent',
                borderWidth: 2,
                pointRadius: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: { display: false },
                y: { display: false }
            },
            elements: {
                line: { tension: 0.4 }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });    const cardChart2Element = document.getElementById('card-chart2');
    if (cardChart2Element) {
        console.log('Initializing chart 2');
        const cardChart2 = new Chart(cardChart2Element, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    data: [1, 18, 9, 17, 34, 22],
                    borderColor: 'rgba(255,255,255,0.55)',
                backgroundColor: 'transparent',
                borderWidth: 2,
                pointRadius: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: { display: false },
                y: { display: false }
            },
            elements: {
                line: { tension: 0.4 }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });    const cardChart3Element = document.getElementById('card-chart3');
    if (cardChart3Element) {
        console.log('Initializing chart 3');
        const cardChart3 = new Chart(cardChart3Element, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    data: [78, 81, 80, 45, 34, 12],
                    backgroundColor: 'rgba(255,255,255,0.55)',
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: { display: false },
                y: { display: false }
            },
            plugins: {
                legend: { display: false }            }
        }
    });
    }

    const cardChart4Element = document.getElementById('card-chart4');
    if (cardChart4Element) {
        console.log('Initializing chart 4');
        const cardChart4 = new Chart(cardChart4Element, {
            type: 'line',
            data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                data: [35, 23, 56, 22, 97, 23],
                borderColor: 'rgba(255,255,255,0.55)',
                backgroundColor: 'rgba(255,255,255,0.1)',
                borderWidth: 2,
                pointRadius: 0,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: { display: false },
                y: { display: false }
            },
            elements: {
                line: { tension: 0.4 }
            },
            plugins: {
                legend: { display: false }            }
        }
    });
    }

    // Main Chart
    const mainChartElement = document.getElementById('main-chart');
    if (mainChartElement) {
        console.log('Initializing main chart');
        const mainChart = new Chart(mainChartElement, {
            type: 'line',
            data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [
                {
                    label: 'Pages & Content',
                    backgroundColor: 'rgba(50, 31, 219, 0.1)',
                    borderColor: 'rgba(50, 31, 219, 1)',
                    pointBackgroundColor: 'rgba(50, 31, 219, 1)',
                    pointBorderColor: '#fff',
                    data: [65, 59, 84, 84, 51, 55, 40, 69, 82, 59, 92, 65]
                },
                {
                    label: 'User Activity',
                    backgroundColor: 'rgba(108, 117, 125, 0.1)',
                    borderColor: 'rgba(108, 117, 125, 1)',
                    pointBackgroundColor: 'rgba(108, 117, 125, 1)',
                    pointBorderColor: '#fff',
                    data: [28, 48, 40, 19, 86, 27, 90, 98, 75, 44, 67, 89]
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Value'
                    }
                }
            },
            elements: {
                line: {
                    tension: 0.4
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }            }
        }
    });
    }

    console.log('✅ CoreUI Dashboard Final loaded successfully');
});
</script>
@endsection
