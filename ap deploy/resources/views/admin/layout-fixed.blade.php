<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', ($company->company_name ?? 'LAMDAKU') . ' Admin Dashboard')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v={{ filemtime(public_path('favicon.png')) }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v={{ filemtime(public_path('favicon.ico')) }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v={{ filemtime(public_path('favicon.ico')) }}">
    <meta name="theme-color" content="#2563eb">
    
    <!-- Bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            width: 250px;
            overflow-y: auto;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            border-radius: 8px;
            margin: 2px 10px;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }
        
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
            padding: 20px;
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
        }
        
        .logo-text {
            font-size: 1.2rem;
            font-weight: bold;
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }
        
        .user-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .user-info {
                position: relative;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-text">
            @if($company && $company->logo)
                <img src="{{ asset('storage/logos/' . $company->logo) }}" 
                     alt="{{ $company->company_name }}" 
                     class="me-2"
                     style="height: 48px; width: auto;">
                <br>
                {{ $company->company_name ?? 'LAMDAKU Admin' }}
            @else
                <i class="fas fa-shield-alt me-2"></i>
                {{ $company->company_name ?? 'LAMDAKU Admin' }}
            @endif
        </div>
        
        <nav class="nav flex-column mt-3" style="padding-bottom: 180px;">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt me-2"></i>
                Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('admin.company.*') ? 'active' : '' }}" href="{{ route('admin.company.index') }}">
                <i class="fas fa-building me-2"></i>
                Info Perusahaan
            </a>
            <a class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
                <i class="fas fa-cogs me-2"></i>
                Layanan
            </a>
            <a class="nav-link {{ request()->routeIs('admin.timelines.*') ? 'active' : '' }}" href="{{ route('admin.timelines.index') }}">
                <i class="fas fa-history me-2"></i>
                Timeline
            </a>
            <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" href="{{ route('admin.contacts.index') }}">
                <i class="fas fa-envelope me-2"></i>
                Pesan Kontak
                @php
                    $unreadCount = \App\Models\Contact::where('is_read', false)->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="badge bg-danger ms-2">{{ $unreadCount }}</span>
                @endif
            </a>
            <a class="nav-link {{ request()->routeIs('admin.organizational-structure.*') ? 'active' : '' }}" href="{{ route('admin.organizational-structure.index') }}">
                <i class="fas fa-sitemap me-2"></i>
                Struktur Organisasi
            </a>
            <a class="nav-link {{ request()->routeIs('admin.vision-mission-goal.*') ? 'active' : '' }}" href="{{ route('admin.vision-mission-goal.index') }}">
                <i class="fas fa-bullseye me-2"></i>
                Visi, Misi & Tujuan
            </a>
            <a class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}" href="{{ route('admin.pages.index') }}">
                <i class="fas fa-file-alt me-2"></i>
                Halaman
            </a>
            <a class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}" href="{{ route('admin.articles.index') }}">
                <i class="fas fa-newspaper me-2"></i>
                Artikel
            </a>
            <a class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}" href="{{ route('admin.events.index') }}">
                <i class="fas fa-calendar me-2"></i>
                Event
            </a>
            @if(session('admin_role') === 'admin')
            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users me-2"></i>
                Manajemen User
            </a>
            @endif
        </nav>
        
        <div class="user-info">
            <div class="text-center mb-3">
                <div class="text-white-50 small">Logged as:</div>
                <div class="fw-bold">{{ session('admin_user', 'Administrator') }}</div>
                @if(session('admin_role'))
                    <div class="text-white-50 small">
                        {{ session('admin_role') === 'admin' ? 'Administrator' : 'Penulis' }}
                    </div>
                @endif
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm w-100" onclick="return confirm('Yakin ingin keluar?')">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    Keluar
                </button>
            </form>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0">@yield('page-title', 'Dashboard')</h1>
            <div>                <a href="{{ $globalWebsiteUrl }}" target="_blank" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-external-link-alt me-1"></i>
                    Lihat Website
                </a>
            </div>
        </div>
        
        <!-- Flash Messages -->
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

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    @yield('scripts')
    @stack('scripts')
</body>
</html>
