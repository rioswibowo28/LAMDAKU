@extends('admin.layout-coreui')

@section('title', 'Dashboard - LAMDAKU Admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
    
    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Welcome to LAMDAKU Admin</h6>
                </div>
                <div class="card-body">
                    <p>Dashboard loaded successfully!</p>
                    <p>Current time: {{ now() }}</p>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white mb-3">
                                <div class="card-body">
                                    <h4>Pages</h4>
                                    <p>Manage content pages</p>
                                    <a href="{{ route('admin.pages.index') }}" class="btn btn-light btn-sm">View Pages</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card bg-success text-white mb-3">
                                <div class="card-body">
                                    <h4>Services</h4>
                                    <p>Manage services</p>
                                    <a href="{{ route('admin.services.index') }}" class="btn btn-light btn-sm">View Services</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card bg-warning text-white mb-3">
                                <div class="card-body">
                                    <h4>Articles</h4>
                                    <p>Manage articles</p>
                                    <a href="{{ route('admin.articles.index') }}" class="btn btn-light btn-sm">View Articles</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card bg-info text-white mb-3">
                                <div class="card-body">
                                    <h4>Messages</h4>
                                    <p>View messages</p>
                                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-light btn-sm">View Messages</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
            font-weight: bold;
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="fas fa-shield-alt"></i> LAMDAKU Admin Dashboard</h1>
                    <p>Selamat datang, {{ session('admin_user', 'Administrator') }}!</p>
                </div>
                <div class="col-md-6 text-end">
                    <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $stats['pages'] ?? 0 }}</div>
                    <div>Halaman</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $stats['services'] ?? 0 }}</div>
                    <div>Layanan</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $stats['timelines'] ?? 0 }}</div>
                    <div>Timeline</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $stats['contacts'] ?? 0 }}</div>
                    <div>Kontak</div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Menu Admin</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{ route('admin.company.index') }}" class="btn btn-outline-primary w-100 mb-2">Info Perusahaan</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-success w-100 mb-2">Kelola Layanan</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('admin.timelines.index') }}" class="btn btn-outline-info w-100 mb-2">Kelola Timeline</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-warning w-100 mb-2">Lihat Kontak</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary w-100 mb-2">Kelola Halaman</a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-dark w-100 mb-2">Lihat Website</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($recent_contacts) && $recent_contacts->count() > 0)
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Pesan Terbaru</h5>
                    </div>
                    <div class="card-body">
                        @foreach($recent_contacts as $contact)
                            <div class="border-bottom py-2">
                                <strong>{{ $contact->name }}</strong> - {{ $contact->email }}<br>
                                <small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small><br>
                                {{ Str::limit($contact->message, 100) }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Informasi Sistem</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Laravel Version:</strong> {{ app()->version() }}</p>
                        <p><strong>PHP Version:</strong> {{ PHP_VERSION }}</p>
                        <p><strong>Environment:</strong> {{ app()->environment() }}</p>
                        <p><strong>Waktu Server:</strong> {{ now()->format('d M Y H:i:s') }}</p>
                        <p><strong>Session Admin:</strong> {{ session('admin_authenticated') ? 'Aktif' : 'Tidak Aktif' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
