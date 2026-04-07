<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title', 'LAMDAKU Admin Dashboard')</title>
    <meta name="description" content="LAMDAKU Admin Dashboard powered by CoreUI">
    <meta name="author" content="LAMDAKU">
    
    <!-- CoreUI CSS -->
    <link href="https://unpkg.com/@coreui/coreui@5.5.0/dist/css/coreui.min.css" rel="stylesheet">
    
    <!-- CoreUI Icons -->
    <link href="https://unpkg.com/@coreui/icons@3.0.1/css/all.min.css" rel="stylesheet">
      <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Flag Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    
    <style>
        body {
            font-family: "Inter", "Segoe UI", "Helvetica Neue", Arial, sans-serif;
            background-color: #f8f9fc;
        }
        
        .sidebar {
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            width: 260px;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 14px 24px;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover {
            color: #fff;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: #fff !important;
            transform: translateX(4px) !important;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4) !important;
            border-left: 4px solid #321FDB;
        }
        
        .sidebar .nav-link.active .badge {
            background: rgba(255, 255, 255, 0.2) !important;
            color: #fff !important;
            animation: pulse 2s infinite;
        }
        
        .sidebar-brand {
            background: #1a252f;
            color: #fff;
            padding: 1.5rem;
        }
        
        .nav-title {
            color: rgba(255, 255, 255, 0.6);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 16px 24px 8px;
        }
          .main-content {
            margin-left: 260px;
            min-height: 100vh;
            background: #f8f9fc;
            transition: margin-left 0.3s ease;
        }
        
        .header {
            background: #fff;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .content-area {
            padding: 2rem;
            min-height: calc(100vh - 160px);
        }
        
        .card {
            box-shadow: 0 2px 20px rgba(31, 45, 61, 0.08);
            border: none;
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }
          .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 40px rgba(31, 45, 61, 0.15);
            transition: all 0.3s ease;
        }
        
        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #321FDB 0%, #667eea 100%);
            border-color: #321FDB;
        }
        
        /* Enhanced Tables */
        .table {
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table th {
            background: linear-gradient(135deg, #f8f9fc 0%, #f1f3f8 100%);
            border-top: none;
            font-weight: 700;
            color: #374151;
            padding: 1rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .table td {
            border-color: #f0f0f0;
            padding: 1rem;
            vertical-align: middle;
        }
        
        .table tbody tr:hover {
            background-color: rgba(50, 31, 219, 0.02);
        }
        
        /* Progress bars */
        .progress {
            border-radius: 50px;
            background-color: rgba(50, 31, 219, 0.1);
            height: 6px;
        }
        
        .progress-bar {
            border-radius: 50px;
        }
        
        @media (max-width: 991.98px) {
            .main-content {
                margin-left: 0;
            }
            
            .sidebar {
                transform: translateX(-100%);
                position: fixed;
                z-index: 1050;
                height: 100vh;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
    
    @yield('styles')
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
        <div class="sidebar-brand">
            <strong>LAMDAKU</strong> Admin
        </div>
          <ul class="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon cil-speedometer"></i> Dashboard
                    @if(request()->routeIs('admin.dashboard'))
                        <span class="badge bg-primary ms-auto">Active</span>
                    @endif
                </a>
            </li>
            
            <li class="nav-title">Content Management</li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.pages.index') }}">
                    <i class="nav-icon cil-layers"></i> Pages
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.articles.index') }}">
                    <i class="nav-icon cil-newspaper"></i> Articles
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.services.index') }}">
                    <i class="nav-icon cil-settings"></i> Services
                </a>
            </li>
            
            <li class="nav-title">Company Info</li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.company.index') }}">
                    <i class="nav-icon cil-building"></i> Company Profile
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.organizational-structure.index') }}">
                    <i class="nav-icon cil-people"></i> Organization
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.vision-mission-goal.index') }}">
                    <i class="nav-icon cil-star"></i> Vision & Mission
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.timelines.index') }}">
                    <i class="nav-icon cil-clock"></i> Timeline
                </a>
            </li>
            
            <li class="nav-title">Communication</li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.contacts.index') }}">
                    <i class="nav-icon cil-envelope-letter"></i> Messages
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.events.index') }}">
                    <i class="nav-icon cil-calendar"></i> Events
                </a>
            </li>
            
            <li class="nav-title">System</li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <i class="nav-icon cil-user"></i> Users
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button class="btn btn-outline-secondary d-md-none" type="button" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <nav aria-label="breadcrumb" class="d-inline-block ms-2">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Home</a>
                            </li>
                            @yield('breadcrumb')
                        </ol>
                    </nav>
                </div>
                
                <div class="dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> Admin
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        
        <!-- Content Area -->
        <main class="content-area">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            @yield('content')
        </main>
        
        <!-- Footer -->
        <footer class="bg-white border-top p-3 text-center">
            <div class="text-muted">
                Powered by <a href="https://coreui.io/" target="_blank">CoreUI</a> 
                &copy; {{ date('Y') }} LAMDAKU.
            </div>
        </footer>
    </div>
      <!-- CoreUI JavaScript -->
    <script src="https://unpkg.com/@coreui/coreui@5.5.0/dist/js/coreui.bundle.min.js"></script>
    
    <!-- Bootstrap 5 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }
        
        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const isClickInsideSidebar = sidebar.contains(e.target);
            const isToggleButton = e.target.closest('[onclick="toggleSidebar()"]');
            
            if (!isClickInsideSidebar && !isToggleButton && window.innerWidth <= 991) {
                sidebar.classList.remove('show');
            }
        });
        
        console.log('CoreUI Simple Layout loaded successfully');
    </script>
    
    @yield('scripts')
</body>
</html>
