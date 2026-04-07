@extends('admin.layout-coreui-simple')
@section('title', 'Dashboard - LAMDAKU Admin')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Header Row with Stats -->
    <div class="row g-3 mb-4">
        <!-- Sale Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">Rp {{ number_format(($stats['pages'] ?? 0) * 1000000, 0, ',', '.') }}</div>
                        <div>Sales</div>
                        <div class="small text-white-50">January - June 2025</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown">
                            <i class="icon cil-options"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.pages.index') }}">View Details</a>
                            <a class="dropdown-item" href="{{ route('admin.pages.create') }}">Add New</a>
                        </div>
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
                        <div class="fs-4 fw-semibold">{{ number_format(($stats['services'] ?? 0) * 15000, 0, ',', '.') }}</div>
                        <div>Traffic</div>
                        <div class="small text-white-50">January 1, 2024 - December 31, 2024</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown">
                            <i class="icon cil-options"></i>
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

        <!-- Customers Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ number_format(($stats['articles'] ?? 0) * 7890 + 44725, 0, ',', '.') }}</div>
                        <div>Customers</div>
                        <div class="small text-white-50 d-flex align-items-center">
                            <span class="text-danger">(-12.4% ↓)</span>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown">
                            <i class="icon cil-options"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.articles.index') }}">View All</a>
                            <a class="dropdown-item" href="{{ route('admin.articles.create') }}">Add New</a>
                        </div>
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
                        <div class="fs-4 fw-semibold">{{ number_format(($stats['contacts'] ?? 0) * 50 + 385, 0, ',', '.') }}</div>
                        <div>Orders</div>
                        <div class="small text-white-50 d-flex align-items-center">
                            <span class="text-success">(17.2% ↑)</span>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown">
                            <i class="icon cil-options"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.contacts.index') }}">View All</a>
                            <a class="dropdown-item" href="{{ route('admin.events.index') }}">Events</a>
                        </div>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart4" height="70"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <!-- Main Chart Section -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title mb-0">Traffic</h4>
                            <div class="small text-body-secondary">January - July 2025</div>
                        </div>
                        <div class="btn-toolbar d-none d-md-block" role="toolbar">
                            <div class="btn-group btn-group-toggle mx-3" data-coreui-toggle="buttons">
                                <input class="btn-check" id="option1" type="radio" name="options" autocomplete="off">
                                <label class="btn btn-outline-secondary" for="option1">Day</label>
                                <input class="btn-check" id="option2" type="radio" name="options" autocomplete="off" checked>
                                <label class="btn btn-outline-secondary active" for="option2">Month</label>
                                <input class="btn-check" id="option3" type="radio" name="options" autocomplete="off">
                                <label class="btn btn-outline-secondary" for="option3">Year</label>
                            </div>
                            <button class="btn btn-primary" type="button">
                                <i class="icon cil-cloud-download"></i>
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
                            <div class="text-body-secondary">Visits</div>
                            <strong>29.703 Users (40%)</strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 40%"></div>
                            </div>
                        </div>
                        <div class="col mb-sm-2 mb-0">
                            <div class="text-body-secondary">Unique</div>
                            <strong>24.093 Users (20%)</strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 20%"></div>
                            </div>
                        </div>
                        <div class="col mb-sm-2 mb-0">
                            <div class="text-body-secondary">Pageviews</div>
                            <strong>78.706 Views (60%)</strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 60%"></div>
                            </div>
                        </div>
                        <div class="col mb-sm-2 mb-0">
                            <div class="text-body-secondary">New Users</div>
                            <strong>22.123 Users (80%)</strong>
                            <div class="progress progress-xs mt-2">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 80%"></div>
                            </div>
                        </div>
                        <div class="col mb-sm-2 mb-0">
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
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Users</strong>
                        <div class="small text-body-secondary">{{ number_format(1232150) }} registered users</div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="text-primary fs-4 fw-bold">26K</div>
                            <div class="small text-body-secondary">(-12.4% ↓)</div>
                            <div class="small text-body-secondary">Users</div>
                        </div>
                        <button class="btn btn-primary btn-sm">
                            <i class="icon cil-user-plus me-1"></i>Add new user
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Country</th>
                                    <th>Usage</th>
                                    <th>Activity</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        <div class="avatar avatar-md">
                                            <img class="avatar-img" src="https://ui-avatars.com/api/?name=Yorgos+Avraamu&background=007bff&color=fff" alt="Yorgos Avraamu">
                                        </div>
                                    </td>
                                    <td>
                                        <div>Yorgos Avraamu</div>
                                        <div class="small text-body-secondary">
                                            <span>New</span> | Registered: Jan 1, 2025
                                        </div>
                                    </td>
                                    <td>
                                        <div class="country-flag">🇺🇸</div>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-start">
                                                <strong>50%</strong>
                                            </div>
                                            <div class="float-end">
                                                <small class="text-body-secondary">Jun 11, 2025 - Jul 10, 2025</small>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small text-body-secondary">Last login</div>
                                        <strong>10 sec ago</strong>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown">
                                                <i class="icon cil-options"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Info</a>
                                                <a class="dropdown-item" href="#">Edit</a>
                                                <a class="dropdown-item" href="#">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Add more sample users here -->
                                <tr>
                                    <td class="text-center">
                                        <div class="avatar avatar-md">
                                            <img class="avatar-img" src="https://ui-avatars.com/api/?name=Admin+User&background=28a745&color=fff" alt="Admin User">
                                        </div>
                                    </td>
                                    <td>
                                        <div>Admin User</div>
                                        <div class="small text-body-secondary">
                                            <span>Admin</span> | Registered: Jan 1, 2025
                                        </div>
                                    </td>
                                    <td>
                                        <div class="country-flag">🇮🇩</div>
                                    </td>
                                    <td>
                                        <div class="clearfix">
                                            <div class="float-start">
                                                <strong>95%</strong>
                                            </div>
                                            <div class="float-end">
                                                <small class="text-body-secondary">Active daily</small>
                                            </div>
                                        </div>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 95%"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small text-body-secondary">Last login</div>
                                        <strong>Online</strong>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown">
                                                <i class="icon cil-options"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Info</a>
                                                <a class="dropdown-item" href="#">Edit</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>        </div>
    </div>
</div>

    <!-- Main Content Row -->
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
    // Card Chart 1 - Sales (Blue line)
    const cardChart1 = new Chart(document.getElementById('card-chart1'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                data: [65, 59, 84, 84, 51, 55],
                borderColor: 'rgba(255,255,255,.5)',
                backgroundColor: 'transparent',
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

    // Card Chart 2 - Traffic (Bar chart)
    const cardChart2 = new Chart(document.getElementById('card-chart2'), {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                data: [78, 81, 80, 45, 34, 12, 40, 85, 65, 23, 12, 98],
                backgroundColor: 'rgba(255,255,255,.2)',
                borderColor: 'rgba(255,255,255,.5)',
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

    // Card Chart 3 - Customers (Line with area)
    const cardChart3 = new Chart(document.getElementById('card-chart3'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                data: [78, 81, 80, 45, 34, 12],
                borderColor: 'rgba(255,255,255,.5)',
                backgroundColor: 'rgba(255,255,255,.1)',
                borderWidth: 2,
                fill: true,
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

    // Card Chart 4 - Orders (Line chart)
    const cardChart4 = new Chart(document.getElementById('card-chart4'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                data: [1, 18, 9, 17, 34, 22],
                borderColor: 'rgba(255,255,255,.5)',
                backgroundColor: 'transparent',
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

    // Main Chart - Traffic Dashboard
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
                data: [165, 180, 270, 200, 220, 165, 210, 270, 180, 230, 275, 250],
                fill: false,
                tension: 0.4
            }, {
                label: 'My Second dataset',
                backgroundColor: 'transparent',
                borderColor: '#39F',
                pointHoverBackgroundColor: '#39F',
                borderWidth: 2,
                data: [92, 97, 180, 156, 186, 197, 183, 198, 187, 198, 193, 183],
                fill: false,
                tension: 0.4
            }, {
                label: 'My Third dataset',
                backgroundColor: 'transparent',
                borderColor: '#2EB85C',
                pointHoverBackgroundColor: '#2EB85C',
                borderWidth: 2,
                data: [50, 50, 145, 120, 142, 154, 155, 156, 150, 161, 155, 148],
                fill: false,
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
                    grid: {
                        drawOnChartArea: false
                    }
                },
                y: {
                    ticks: {
                        beginAtZero: true,
                        maxTicksLimit: 5,
                        stepSize: Math.ceil(300 / 5),
                        max: 300
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
