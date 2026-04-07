@extends('admin.layout-simple')
@section('title', 'Dashboard - LAMDAKU Admin')
@section('page-title', 'Dashboard')
@section('styles')
<style>
/* DASHBOARD FIXED - TANPA EFEK GERAK BERLEBIHAN */

/* Enhanced Stats Cards - FIXED VERSION */
.stats-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    margin-bottom: 20px;
    border: 1px solid rgba(0, 0, 0, 0.05);
    position: relative;
    overflow: hidden;
           <div class="card recent-contacts-card">
            <div class="card-header bg-gradient-primary text-white">
                <h6 class="card-title mb-0">
                    <i class="fas fa-envelope me-2"></i>
                    Pesan Terbaru
                </h6>
            </div>US semua transition dan animation */
}

/* Hover hanya mengubah shadow sedikit, TIDAK bergerak */
.stats-card:hover {
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
    /* TIDAK ADA transform, scale, translateY, dll */
}

.stats-card.pages {
    border-top: 4px solid #667eea;
}

.stats-card.services {
    border-top: 4px solid #10b981;
}

.stats-card.timelines {
    border-top: 4px solid #3b82f6;
}

.stats-card.contacts {
    border-top: 4px solid #f59e0b;
}

/* Stats Icon - FIXED - Tidak Bergerak */
.stats-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    position: relative;
    /* HAPUS semua transition dan animation */
}

/* Hover icon hanya mengubah warna, TIDAK bergerak */
.stats-card:hover .stats-icon {
    color: #667eea;
    /* TIDAK ADA transform, rotation, scale, dll */
}

.stats-number {
    font-size: 2.8rem;
    font-weight: 700;
    margin: 15px 0 8px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    /* Angka langsung tampil, TIDAK ada animasi counter */
}

/* Welcome Card - FIXED */
.welcome-card {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    position: relative;
    overflow: hidden;
    /* HAPUS entrance animation */
}

/* Quick Actions - FIXED */
.quick-action-btn {
    position: relative;
    overflow: hidden;
    /* HAPUS transition berlebihan */
}

.quick-action-btn:hover {
    background-color: #f8f9fa;
    /* HAPUS translateY dan box-shadow berlebihan */
}

/* Contact Items - FIXED */
.contact-item {
    border-radius: 12px;
    padding: 15px;
    margin: 10px 0;
    position: relative;
    /* HAPUS transition */
}

.contact-item:hover {
    background: #f8f9fa;
    /* HAPUS transform translateX */
}

/* System Info - FIXED */
.system-info-card {
    /* HAPUS entrance animation */
}

/* Responsive - FIXED */
@media (max-width: 768px) {
    .stats-card:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        /* HAPUS transform apapun */
    }
}

/* Cards Umum - FIXED */
.card {
    border: none;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
    border-radius: 16px;
    /* HAPUS transition berlebihan */
}

.card:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
    /* TIDAK ADA transform */
}

/* Stagger Items - HAPUS SEMUA ANIMASI */
.stagger-item {
    /* HAPUS semua animation dan entrance effect */
    opacity: 1 !important;
}

/* Icons - FIXED - Tidak Bergerak */
.icon-hover {
    /* HAPUS semua transition dan transform */
}

.icon-hover:hover {
    color: #667eea !important;
    /* TIDAK ADA scale, rotate, atau transform apapun */
}

/* Button Hover - MINIMAL */
.btn:hover {
    /* Hanya perubahan warna, TIDAK ada transform */
}

/* Badge - FIXED */
.badge {
    /* HAPUS transition dan animation */
    position: relative;
    overflow: hidden;
}

.badge::before {
    /* HAPUS shimmer effect */
    display: none;
}

.badge:hover {
    /* TIDAK ADA transform scale atau box-shadow berlebihan */
}

/* HAPUS SEMUA KEYFRAMES ANIMATION */
/* Tidak ada @keyframes apapun */

</style>
@endsection

@section('content')
<div class="row">
    <!-- Welcome Message -->
    <div class="col-12 mb-4">
        <div class="card welcome-card">
            <div class="card-body position-relative">
                <h5 class="card-title">
                    <i class="fas fa-home me-2"></i>
                    Selamat Datang di LAMDAKU Admin Dashboard
                </h5>
                <p class="card-text mb-3 text-white-50">
                    Kelola konten website dan data perusahaan dari sini dengan mudah dan efisien.
                </p>
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <small class="text-white-50">
                            <i class="fas fa-user me-1"></i>
                            Login sebagai: <strong class="text-white">{{ session('admin_user', 'Administrator') }}</strong>
                        </small>
                        <br>
                        <small class="text-white-50">
                            <i class="fas fa-clock me-1"></i>
                            Terakhir login: {{ now()->format('d M Y H:i') }}
                        </small>
                    </div>
                    <div class="col-md-4 text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <span class="badge bg-white text-primary px-3 py-2 border">
                                <i class="fas fa-shield-alt me-1"></i>
                                Super Admin
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($company)
<!-- Company Information -->
<div class="row">
    <div class="col-12 mb-4">
        <div class="card company-info-card">
            <div class="card-header bg-gradient-primary text-white">
                <h6 class="card-title mb-0">
                    <i class="fas fa-building me-2"></i>
                    Informasi Perusahaan
                </h6>
            </div>
            <div class="card-body" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white;">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        @if($company->logo)
                            <img src="{{ asset('storage/logos/' . $company->logo) }}" 
                                 alt="{{ $company->company_name }}" 
                                 class="img-fluid rounded"
                                 style="max-height: 80px; width: auto;"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <div style="display: none;" class="text-white-50">
                                <i class="fas fa-building fa-3x"></i>
                                <small class="d-block mt-2">Logo tidak tersedia</small>
                            </div>
                        @else
                            <div class="text-white-50">
                                <i class="fas fa-building fa-3x"></i>
                                <small class="d-block mt-2">Belum ada logo</small>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-7">
                        <h5 class="mb-1 text-white">{{ $company->company_name }}</h5>
                        <p class="text-white-50 mb-2">{{ $company->description ?: 'Tidak ada deskripsi' }}</p>
                        <div class="row">
                            <div class="col-6">
                                <small class="text-white-50 d-block">
                                    <i class="fas fa-envelope me-1"></i>
                                    {{ $company->email ?: 'Email tidak tersedia' }}
                                </small>
                                <small class="text-white-50 d-block">
                                    <i class="fas fa-phone me-1"></i>
                                    {{ $company->phone ?: 'Telepon tidak tersedia' }}
                                </small>
                            </div>
                            <div class="col-6">
                                <small class="text-white-50 d-block">
                                    <i class="fas fa-mobile-alt me-1"></i>
                                    {{ $company->mobile ?: 'Mobile tidak tersedia' }}
                                </small>
                                <small class="text-white-50 d-block">
                                    <i class="fas fa-globe me-1"></i>
                                    {{ $company->website ?: 'Website tidak tersedia' }}
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-end">
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('admin.company.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-edit me-1"></i>
                                Kelola Perusahaan
                            </a>
                            <span class="badge bg-{{ $company->is_active ? 'success' : 'warning' }} px-3 py-2">
                                <i class="fas fa-{{ $company->is_active ? 'check-circle' : 'pause-circle' }} me-1"></i>
                                {{ $company->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<!-- No Company Information -->
<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-warning">
            <div class="card-body text-center py-4">
                <i class="fas fa-exclamation-triangle fa-2x text-warning mb-3"></i>
                <h6 class="card-title">Informasi Perusahaan Belum Diatur</h6>
                <p class="card-text text-muted mb-3">
                    Tambahkan informasi perusahaan dan logo untuk melengkapi profil.
                </p>
                <a href="{{ route('admin.company.create') }}" class="btn btn-warning">
                    <i class="fas fa-plus me-1"></i>
                    Tambah Informasi Perusahaan
                </a>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
    <!-- Stats Cards -->
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stats-card pages" data-count="{{ $stats['pages'] ?? 0 }}">
            <div class="stats-icon text-primary">
                <i class="fas fa-file-alt fa-2x"></i>
            </div>
            <div class="stats-number">{{ $stats['pages'] ?? 0 }}</div>
            <div class="text-secondary fw-medium">Halaman</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stats-card services" data-count="{{ $stats['services'] ?? 0 }}">
            <div class="stats-icon text-success">
                <i class="fas fa-cogs fa-2x"></i>
            </div>
            <div class="stats-number">{{ $stats['services'] ?? 0 }}</div>
            <div class="text-secondary fw-medium">Layanan</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stats-card timelines" data-count="{{ $stats['timelines'] ?? 0 }}">
            <div class="stats-icon text-info">
                <i class="fas fa-history fa-2x"></i>
            </div>
            <div class="stats-number">{{ $stats['timelines'] ?? 0 }}</div>
            <div class="text-secondary fw-medium">Timeline</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stats-card contacts" data-count="{{ $stats['contacts'] ?? 0 }}">
            <div class="stats-icon text-warning">
                <i class="fas fa-envelope fa-2x"></i>
            </div>
            <div class="stats-number">{{ $stats['contacts'] ?? 0 }}</div>
            <div class="text-secondary fw-medium">
                Kontak
                @if(($stats['unread_contacts'] ?? 0) > 0)
                    <span class="badge bg-danger ms-1">{{ $stats['unread_contacts'] }}</span>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Article Statistics Row -->
<div class="row">
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stats-card articles" data-count="{{ $stats['total_articles'] ?? 0 }}">
            <div class="stats-icon text-primary">
                <i class="fas fa-newspaper fa-2x"></i>
            </div>
            <div class="stats-number">{{ $stats['total_articles'] ?? 0 }}</div>
            <div class="text-secondary fw-medium">Total Artikel</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stats-card published" data-count="{{ $stats['published_articles'] ?? 0 }}">
            <div class="stats-icon text-success">
                <i class="fas fa-globe fa-2x"></i>
            </div>
            <div class="stats-number">{{ $stats['published_articles'] ?? 0 }}</div>
            <div class="text-secondary fw-medium">Published</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stats-card drafts" data-count="{{ $stats['draft_articles'] ?? 0 }}">
            <div class="stats-icon text-warning">
                <i class="fas fa-file-alt fa-2x"></i>
            </div>
            <div class="stats-number">{{ $stats['draft_articles'] ?? 0 }}</div>
            <div class="text-secondary fw-medium">Draft</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-4">
        <div class="stats-card featured" data-count="{{ $stats['featured_articles'] ?? 0 }}">
            <div class="stats-icon text-info">
                <i class="fas fa-star fa-2x"></i>
            </div>
            <div class="stats-number">{{ $stats['featured_articles'] ?? 0 }}</div>
            <div class="text-secondary fw-medium">Featured</div>
        </div>
    </div>
</div>

@if(session('admin_role') === 'penulis')
<!-- Penulis Personal Stats -->
<div class="row">
    <div class="col-md-6 mb-4">
        <div class="stats-card my-articles" data-count="{{ $stats['my_articles'] ?? 0 }}">
            <div class="stats-icon text-purple">
                <i class="fas fa-pen fa-2x"></i>
            </div>
            <div class="stats-number">{{ $stats['my_articles'] ?? 0 }}</div>
            <div class="text-secondary fw-medium">Artikel Saya</div>
        </div>
    </div>
    <div class="col-md-6 mb-4">
        <div class="stats-card my-published" data-count="{{ $stats['my_published'] ?? 0 }}">
            <div class="stats-icon text-success">
                <i class="fas fa-check-circle fa-2x"></i>
            </div>
            <div class="stats-number">{{ $stats['my_published'] ?? 0 }}</div>
            <div class="text-secondary fw-medium">Saya Published</div>
        </div>
    </div>
</div>
@endif

<div class="row">
    <!-- Quick Actions -->
    <div class="col-md-6 mb-4">
        <div class="card quick-actions-card">
            <div class="card-header bg-gradient-primary text-white">
                <h6 class="card-title mb-0">
                    <i class="fas fa-bolt me-2"></i>
                    Quick Actions
                </h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6">
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-outline-primary w-100 quick-action-btn">
                            <i class="fas fa-plus-circle mb-2 d-block"></i>
                            <small>Tambah Artikel</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.services.create') }}" class="btn btn-outline-success w-100 quick-action-btn">
                            <i class="fas fa-cogs mb-2 d-block"></i>
                            <small>Tambah Layanan</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.pages.create') }}" class="btn btn-outline-info w-100 quick-action-btn">
                            <i class="fas fa-file-plus mb-2 d-block"></i>
                            <small>Tambah Halaman</small>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.company.index') }}" class="btn btn-outline-secondary w-100 quick-action-btn">
                            <i class="fas fa-building mb-2 d-block"></i>
                            <small>Info Perusahaan</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Articles or Contacts -->
    <div class="col-md-6 mb-4">
        @if(isset($recent_articles) && $recent_articles->count() > 0)
        <div class="card recent-articles-card">
            <div class="card-header bg-gradient-primary text-white">
                <h6 class="card-title mb-0">
                    <i class="fas fa-newspaper me-2"></i>
                    Artikel Terbaru
                </h6>
            </div>
            <div class="card-body">
                @foreach($recent_articles->take(4) as $article)
                    <div class="contact-item {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center mb-1">
                                    <strong class="text-dark">{{ Str::limit($article->title, 40) }}</strong>
                                    @php
                                        $statusClass = match($article->status) {
                                            'published' => 'bg-success',
                                            'draft' => 'bg-warning text-dark',
                                            'archived' => 'bg-secondary',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $statusClass }} ms-2">{{ ucfirst($article->status) }}</span>
                                </div>
                                <small class="text-muted d-block">
                                    <i class="fas fa-user me-1"></i>{{ $article->author->name }}
                                    <i class="fas fa-eye ms-2 me-1"></i>{{ number_format($article->view_count) }}
                                </small>
                            </div>
                            <div class="text-end">
                                <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="mt-3">
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-primary btn-sm w-100 quick-action-btn">
                        <i class="fas fa-eye me-1"></i>
                        Lihat Semua Artikel
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="card recent-contacts-card">
            <div class="card-header bg-gradient-primary text-white">
                <h6 class="card-title mb-0">
                    <i class="fas fa-envelope me-2"></i>
                    Pesan Terbaru
                </h6>
            </div>
            <div class="card-body">
                @if(isset($recent_contacts) && $recent_contacts->count() > 0)
                    @foreach($recent_contacts->take(4) as $contact)
                        <div class="contact-item {{ !$loop->last ? 'border-bottom' : '' }}">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-1">
                                        <strong class="text-dark">{{ $contact->name }}</strong>
                                        @if(!$contact->is_read)
                                            <span class="badge bg-danger ms-2">Baru</span>
                                        @endif
                                    </div>
                                    <small class="text-muted d-block">{{ Str::limit($contact->message, 50) }}</small>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-3">
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-primary btn-sm w-100 quick-action-btn">
                            <i class="fas fa-eye me-1"></i>
                            Lihat Semua Pesan
                        </a>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                        <p class="text-muted mb-0">Belum ada pesan kontak.</p>
                    </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

@if(isset($top_articles) && $top_articles->count() > 0)
<!-- Top Performing Articles -->
<div class="row">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header bg-gradient-primary text-white">
                <h6 class="card-title mb-0">
                    <i class="fas fa-trophy me-2"></i>
                    Artikel Terpopuler
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Judul</th>
                                <th width="120">Penulis</th>
                                <th width="80">Views</th>
                                <th width="100">Published</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($top_articles as $article)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('admin.articles.show', $article) }}" class="text-decoration-none">
                                            {{ Str::limit($article->title, 60) }}
                                        </a>
                                        @if($article->is_featured)
                                            <i class="fas fa-star text-warning ms-1" title="Featured"></i>
                                        @endif
                                    </td>
                                    <td>{{ $article->author->name }}</td>
                                    <td><strong>{{ number_format($article->view_count) }}</strong></td>
                                    <td>{{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
    <!-- System Info -->
    <div class="col-12">
        <div class="card system-info-card">
            <div class="card-header bg-gradient-primary text-white">
                <h6 class="card-title mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Informasi Sistem
                </h6>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-code text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">{{ app()->version() }}</h6>
                                <small class="text-muted">Laravel Version</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fab fa-php text-success"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">{{ PHP_VERSION }}</h6>
                                <small class="text-muted">PHP Version</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-server text-info"></i>
                            </div>
                            <div>
                                <h6 class="mb-0">{{ app()->environment() }}</h6>
                                <small class="text-muted">Environment</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-clock text-warning"></i>
                            </div>
                            <div>
                                <h6 class="mb-0" id="server-time">{{ now()->format('H:i:s') }}</h6>
                                <small class="text-muted">Server Time</small>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    // SIMPLE VERSION - Tanpa animasi berlebihan
    
    // Update server time tanpa animasi
    function updateServerTime() {
        const timeElement = document.getElementById('server-time');
        if (timeElement) {
            const now = new Date();
            const newTime = now.toLocaleTimeString('id-ID');
            timeElement.textContent = newTime;
        }
    }
    setInterval(updateServerTime, 1000);
    
    console.log('Dashboard loaded - FIXED VERSION (no excessive animations)');
});
</script>
@endsection
