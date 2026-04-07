@extends('admin.layout-simple')
@section('title', 'Dashboard - LAMDAKU Admin')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Home</a>
    </li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid px-4">
    <!-- Welcome Section with Company Info -->
    @if($company)
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white border-0 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="mb-2 fw-bold">
                                <i class="fas fa-building me-2"></i>
                                {{ $company->company_name }}
                            </h3>
                            <p class="mb-1 opacity-90">{{ $company->description }}</p>
                            <div class="d-flex flex-wrap gap-3 mt-3">
                                <span><i class="fas fa-envelope me-1"></i> {{ $company->email }}</span>
                                <span><i class="fas fa-phone me-1"></i> {{ $company->phone }}</span>
                                <span><i class="fas fa-globe me-1"></i> {{ $company->website }}</span>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="text-white opacity-75">
                                {{ now()->format('l, F j, Y') }}
                            </div>
                            <div class="h4 mb-0 fw-bold">{{ now()->format('H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Enhanced Stats Cards Row -->
    <div class="row g-4 mb-4">
        <!-- Services Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-primary border-0 shadow-sm h-100">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $stats['services'] ?? 0 }}</div>
                        <div>Layanan Akreditasi</div>
                        <div class="small text-white-50">Total Services</div>
                        @if(isset($monthlyGrowth['services']) && $monthlyGrowth['services'] != 0)
                        <div class="small">
                            <i class="fas fa-arrow-{{ $monthlyGrowth['services'] > 0 ? 'up' : 'down' }} me-1"></i>
                            {{ abs($monthlyGrowth['services']) }}% this month
                        </div>
                        @endif
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.services.index') }}">View All Services</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.services.create') }}">Add New Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart1" height="70"></canvas>
                </div>
            </div>
        </div>

        <!-- Articles Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-info border-0 shadow-sm h-100">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $stats['articles'] ?? 0 }}</div>
                        <div>Artikel & Berita</div>
                        <div class="small text-white-50">Published Articles</div>
                        @if(isset($monthlyGrowth['articles']) && $monthlyGrowth['articles'] != 0)
                        <div class="small">
                            <i class="fas fa-arrow-{{ $monthlyGrowth['articles'] > 0 ? 'up' : 'down' }} me-1"></i>
                            {{ abs($monthlyGrowth['articles']) }}% this month
                        </div>
                        @endif
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.articles.index') }}">View All Articles</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.articles.create') }}">Create New Article</a></li>
                        </ul>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart2" height="70"></canvas>
                </div>
            </div>
        </div>

        <!-- Contacts Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-warning border-0 shadow-sm h-100">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $stats['contacts'] ?? 0 }}</div>
                        <div>Pesan Kontak</div>
                        <div class="small text-white-50">Contact Messages</div>
                        @if(isset($monthlyGrowth['contacts']) && $monthlyGrowth['contacts'] != 0)
                        <div class="small">
                            <i class="fas fa-arrow-{{ $monthlyGrowth['contacts'] > 0 ? 'up' : 'down' }} me-1"></i>
                            {{ abs($monthlyGrowth['contacts']) }}% this month
                        </div>
                        @endif
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.contacts.index') }}">View All Messages</a></li>
                            <li><a class="dropdown-item" href="#">Export Report</a></li>
                        </ul>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart3" height="70"></canvas>
                </div>
            </div>
        </div>

        <!-- Events Card -->
        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-success border-0 shadow-sm h-100">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $stats['events'] ?? 0 }}</div>
                        <div>Acara & Kegiatan</div>
                        <div class="small text-white-50">Scheduled Events</div>
                        @if(isset($monthlyGrowth['events']) && $monthlyGrowth['events'] != 0)
                        <div class="small">
                            <i class="fas fa-arrow-{{ $monthlyGrowth['events'] > 0 ? 'up' : 'down' }} me-1"></i>
                            {{ abs($monthlyGrowth['events']) }}% this month
                        </div>
                        @endif
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.events.index') }}">View All Events</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.events.create') }}">Create New Event</a></li>
                        </ul>
                    </div>
                </div>
                <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                    <canvas class="chart" id="card-chart4" height="70"></canvas>
                </div>            </div>
        </div>
    </div>

    <!-- Main Dashboard Grid -->
    <div class="row g-4">
        <!-- Left Column - Main Content (70%) -->
        <div class="col-lg-8">            <!-- LAMDAKU Vision, Mission & Goals Section -->
            @if($visionMissionGoals->count() > 0)
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-gradient-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-bullseye me-2"></i>
                                Visi, Misi & Tujuan LAMDAKU
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                @foreach($visionMissionGoals->groupBy('type') as $type => $items)
                                <div class="col-md-4 mb-3">
                                    <h6 class="fw-bold mb-3 text-{{ $type === 'vision' ? 'primary' : ($type === 'mission' ? 'success' : 'warning') }}">
                                        <i class="{{ $items->first()->icon_class ?? 'fas fa-circle' }} me-2"></i>
                                        {{ $type === 'vision' ? 'VISI' : ($type === 'mission' ? 'MISI' : 'TUJUAN') }}
                                    </h6>
                                    @foreach($items->take(3) as $item)
                                    <div class="mb-2">
                                        <div class="d-flex align-items-start">
                                            <div class="me-2 mt-1">
                                                <span class="badge bg-{{ $type === 'vision' ? 'primary' : ($type === 'mission' ? 'success' : 'warning') }} 
                                                             rounded-circle" style="width: 8px; height: 8px;"></span>
                                            </div>
                                            <small class="text-muted">{{ $item->content }}</small>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                            <div class="text-center mt-3">
                                <a href="{{ route('admin.vision-mission-goal.index') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>
                                    Lihat Semua
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif            <!-- Recent Activities Section -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header d-flex justify-content-between align-items-center bg-light">
                            <div>
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-clock me-2 text-primary"></i>
                                    Aktivitas Terbaru
                                </h5>
                                <small class="text-muted">Update content & activity terbaru</small>
                            </div>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary btn-sm active">All</button>
                                <button class="btn btn-outline-secondary btn-sm">Articles</button>
                                <button class="btn btn-outline-secondary btn-sm">Events</button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <tbody>
                                @if(isset($recentActivities) && $recentActivities->count() > 0)
                                    @foreach($recentActivities as $activity)
                                    <tr>
                                        <td style="width: 50px;">
                                            <div class="avatar bg-{{ $activity['color'] }} text-white rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="{{ $activity['icon'] }}"></i>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ Str::limit($activity['title'], 50) }}</div>
                                            <small class="text-muted">{{ $activity['description'] }}</small>
                                        </td>
                                        <td class="text-end">
                                            <small class="text-muted">{{ $activity['time']->diffForHumans() }}</small>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    @if($recent_articles->count() > 0)
                                        @foreach($recent_articles->take(3) as $article)
                                        <tr>
                                            <td style="width: 50px;">
                                                <div class="avatar bg-info text-white rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-newspaper"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fw-semibold">{{ Str::limit($article->title ?? 'New Article', 50) }}</div>
                                                <small class="text-muted">Article published</small>
                                            </td>
                                            <td class="text-end">
                                                <small class="text-muted">{{ $article->created_at->diffForHumans() ?? '1 hour ago' }}</small>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                    
                                    @if($recent_events->count() > 0)
                                        @foreach($recent_events->take(2) as $event)
                                        <tr>
                                            <td style="width: 50px;">
                                                <div class="avatar bg-success text-white rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-calendar"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fw-semibold">{{ Str::limit($event->title ?? 'New Event', 50) }}</div>
                                                <small class="text-muted">Event scheduled</small>
                                            </td>
                                            <td class="text-end">
                                                <small class="text-muted">{{ $event->created_at->diffForHumans() ?? '2 hours ago' }}</small>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif

                                    @if($recent_contacts->count() > 0)
                                        @foreach($recent_contacts->take(2) as $contact)
                                        <tr>
                                            <td style="width: 50px;">
                                                <div class="avatar bg-warning text-white rounded-circle d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fw-semibold">{{ $contact->name ?? 'New Contact' }}</div>
                                                <small class="text-muted">{{ Str::limit($contact->subject ?? 'Contact message', 40) }}</small>
                                            </td>
                                            <td class="text-end">
                                                <small class="text-muted">{{ $contact->created_at->diffForHumans() ?? '30 minutes ago' }}</small>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif

                                    <!-- Fallback activities if no real data -->
                                    @if($recent_articles->count() == 0 && $recent_events->count() == 0 && $recent_contacts->count() == 0)
                                    <tr>
                                        <td style="width: 50px;">
                                            <div class="avatar bg-info text-white rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="fas fa-newspaper"></i>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">LAMDAKU Company Profile Updated</div>
                                            <small class="text-muted">Article published</small>
                                        </td>
                                        <td class="text-end">
                                            <small class="text-muted">2 hours ago</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50px;">
                                            <div class="avatar bg-success text-white rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="fas fa-handshake"></i>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">Akreditasi Konsultasi Service Updated</div>
                                            <small class="text-muted">Service portfolio updated</small>
                                        </td>
                                        <td class="text-end">
                                            <small class="text-muted">5 hours ago</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50px;">
                                            <div class="avatar bg-warning text-white rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">Business Inquiry from Client</div>
                                            <small class="text-muted">New contact message received</small>
                                        </td>
                                        <td class="text-end">
                                            <small class="text-muted">1 day ago</small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 50px;">
                                            <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">New Team Member Added</div>
                                            <small class="text-muted">Organizational structure updated</small>
                                        </td>
                                        <td class="text-end">
                                            <small class="text-muted">2 days ago</small>
                                        </td>
                                    </tr>
                                    @endif
                                @endif                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer bg-light text-center">
                                <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-primary btn-sm me-2">
                                    <i class="fas fa-newspaper me-1"></i>View All Articles
                                </a>
                                <a href="{{ route('admin.events.index') }}" class="btn btn-outline-success btn-sm me-2">
                                    <i class="fas fa-calendar me-1"></i>View All Events
                                </a>
                                <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-envelope me-1"></i>View All Messages
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        <!-- Right Sidebar - Quick Stats & Actions (30%) -->
        <div class="col-lg-4">
            <!-- Additional Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-6">
                    <div class="card text-white bg-gradient-primary border-0 shadow-sm h-100">
                        <div class="card-body text-center p-3">
                            <div class="text-white">
                                <i class="fas fa-users fa-lg mb-2"></i>
                            </div>
                            <div class="fs-5 fw-semibold">{{ $stats['users'] ?? 8 }}</div>
                            <div class="text-uppercase text-white-50 small">Admin Users</div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card text-white bg-gradient-info border-0 shadow-sm h-100">
                        <div class="card-body text-center p-3">
                            <div class="text-white">
                                <i class="fas fa-file-alt fa-lg mb-2"></i>
                            </div>
                            <div class="fs-5 fw-semibold">{{ $stats['pages'] ?? 5 }}</div>
                            <div class="text-uppercase text-white-50 small">Pages</div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card text-white bg-gradient-success border-0 shadow-sm h-100">
                        <div class="card-body text-center p-3">
                            <div class="text-white">
                                <i class="fas fa-timeline fa-lg mb-2"></i>
                            </div>
                            <div class="fs-5 fw-semibold">{{ $stats['timelines'] ?? 6 }}</div>
                            <div class="text-uppercase text-white-50 small">Timeline</div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card text-white bg-gradient-warning border-0 shadow-sm h-100">
                        <div class="card-body text-center p-3">
                            <div class="text-white">
                                <i class="fas fa-sitemap fa-lg mb-2"></i>
                            </div>
                            <div class="fs-5 fw-semibold">{{ $stats['organizationalStructures'] ?? 8 }}</div>
                            <div class="text-uppercase text-white-50 small">Staff</div>
                        </div>
                    </div>
                </div>
            </div>            <!-- Organizational Structure Preview -->
            @if($organizationalStructure->count() > 0)
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="fas fa-sitemap me-2 text-primary"></i>
                                Struktur Organisasi
                            </h6>
                        </div>
                        <div class="card-body">
                            @foreach($organizationalStructure->groupBy('level_order') as $level => $positions)
                            <div class="mb-3">
                                <div class="small text-muted fw-semibold mb-2">
                                    Level {{ $level }} - 
                                    {{ $level == 1 ? 'Direktur' : ($level == 2 ? 'Manager' : ($level == 3 ? 'Supervisor' : 'Staff')) }}
                                </div>                                @foreach($positions->take(2) as $position)
                                <div class="d-flex align-items-center mb-2">
                                    <div class="me-3">
                                        @if($position->photo)
                                            <img src="{{ $position->photo_url }}" alt="{{ $position->name }}" 
                                                 class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover;">
                                        @else
                                            <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                                 style="width: 32px; height: 32px; background-color: {{ $position->background_color ?? '#e3f2fd' }};">
                                                <i class="{{ $position->icon_class ?? 'fas fa-user' }} text-white" style="font-size: 12px;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold small">{{ $position->name }}</div>
                                        <div class="text-muted" style="font-size: 11px;">{{ $position->position }}</div>
                                    </div>
                                </div>
                                @endforeach
                                @if($positions->count() > 2)
                                <div class="text-center">
                                    <small class="text-muted">+{{ $positions->count() - 2 }} lainnya</small>
                                </div>
                                @endif
                            </div>
                            @endforeach
                            <div class="text-center mt-3">
                                <a href="{{ route('admin.organizational-structure.index') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>
                                    Lihat Struktur Lengkap
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif            <!-- Quick Actions & Services -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">
                                <i class="fas fa-bolt me-2 text-warning"></i>
                                Quick Actions
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('admin.articles.create') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-plus me-2"></i>Buat Artikel Baru
                                </a>
                                <a href="{{ route('admin.events.create') }}" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-calendar-plus me-2"></i>Tambah Event
                                </a>
                                <a href="{{ route('admin.services.create') }}" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-handshake me-2"></i>Tambah Layanan
                                </a>
                                <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-envelope me-2"></i>
                                    Cek Pesan ({{ $stats['contacts'] ?? 0 }})
                                </a>
                            </div>

                            <!-- Recent Services -->
                            @if($recent_services->count() > 0)
                            <hr class="my-3">
                            <h6 class="text-muted small mb-2">
                                <i class="fas fa-history me-1"></i>Layanan Terbaru
                            </h6>
                            @foreach($recent_services->take(3) as $service)
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="badge bg-primary rounded-circle" style="width: 8px; height: 8px;"></span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="small fw-semibold">{{ Str::limit($service->name ?? 'Akreditasi Service', 25) }}</div>
                                    <div class="text-muted" style="font-size: 10px;">{{ $service->updated_at->diffForHumans() ?? 'Recently updated' }}</div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <hr class="my-3">
                            <h6 class="text-muted small mb-2">
                                <i class="fas fa-handshake me-1"></i>Layanan LAMDAKU
                            </h6>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="badge bg-primary rounded-circle" style="width: 8px; height: 8px;"></span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="small fw-semibold">Akreditasi Klinik</div>
                                    <div class="text-muted" style="font-size: 10px;">Layanan akreditasi klinik profesional</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="badge bg-success rounded-circle" style="width: 8px; height: 8px;"></span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="small fw-semibold">Konsultasi Manajemen</div>
                                    <div class="text-muted" style="font-size: 10px;">Layanan konsultasi strategis</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="badge bg-info rounded-circle" style="width: 8px; height: 8px;"></span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="small fw-semibold">Pelatihan SDM</div>
                                    <div class="text-muted" style="font-size: 10px;">Training & development program</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="badge bg-warning rounded-circle" style="width: 8px; height: 8px;"></span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="small fw-semibold">Audit & Assessment</div>
                                    <div class="text-muted" style="font-size: 10px;">Comprehensive quality audit</div>
                                </div>
                            </div>
                            @endif
                              <div class="text-center mt-3">
                                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>Lihat Semua Layanan
                                </a>
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

<style>
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
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4285f4 0%, #34a853 100%) !important;
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8 0%, #007bff 100%) !important;
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%) !important;
    }
    
    .progress-xs {
        height: 4px;
    }
    
    .table > :not(caption) > * > * {
        padding: 0.75rem 0.5rem;
    }
    
    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
    }
    
    .c-chart-wrapper {
        position: relative;
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }
    
    .shadow-sm {
        box-shadow: 0 2px 10px rgba(0,0,0,0.08) !important;
    }
    
    .shadow-lg {
        box-shadow: 0 10px 35px rgba(0,0,0,0.15) !important;
    }
    
    .border-0 {
        border: none !important;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    .text-white-50 {
        color: rgba(255,255,255,0.75) !important;
    }
    
    .opacity-90 {
        opacity: 0.9;
    }
    
    .btn-group-sm > .btn, .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    
    /* Improved responsive layout */
    @media (max-width: 768px) {
        .col-lg-8, .col-lg-4 {
            margin-bottom: 2rem;
        }
        
        .card-body {
            padding: 1rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('LAMDAKU Dashboard initialized');
    
    // Enhanced Chart configurations with LAMDAKU colors
    const primaryColor = '#4285f4';
    const successColor = '#28a745';
    const infoColor = '#17a2b8';
    const warningColor = '#ffc107';
    
    // Services Chart (Card 1)
    const cardChart1Element = document.getElementById('card-chart1');
    if (cardChart1Element) {
        const cardChart1 = new Chart(cardChart1Element, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    data: [{{ $stats['services'] ?? 3 }}, {{ ($stats['services'] ?? 3) + 1 }}, {{ ($stats['services'] ?? 3) + 2 }}, {{ ($stats['services'] ?? 3) + 1 }}, {{ ($stats['services'] ?? 3) + 3 }}, {{ $stats['services'] ?? 3 }}],
                    borderColor: 'rgba(255,255,255,0.8)',
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
                    legend: { display: false }
                }
            }
        });
    }

    // Articles Chart (Card 2)
    const cardChart2Element = document.getElementById('card-chart2');
    if (cardChart2Element) {
        const cardChart2 = new Chart(cardChart2Element, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    data: [
                        {{ max(1, ($stats['articles'] ?? 15) * 0.6) }},
                        {{ max(1, ($stats['articles'] ?? 15) * 0.8) }},
                        {{ max(1, ($stats['articles'] ?? 15) * 0.7) }},
                        {{ max(1, ($stats['articles'] ?? 15) * 0.5) }},
                        {{ max(1, ($stats['articles'] ?? 15) * 0.9) }},
                        {{ max(1, ($stats['articles'] ?? 15) * 0.4) }},
                        {{ max(1, ($stats['articles'] ?? 15) * 0.6) }},
                        {{ max(1, ($stats['articles'] ?? 15) * 1.2) }},
                        {{ max(1, ($stats['articles'] ?? 15) * 0.8) }},
                        {{ max(1, ($stats['articles'] ?? 15) * 1.1) }},
                        {{ max(1, ($stats['articles'] ?? 15) * 0.7) }},
                        {{ $stats['articles'] ?? 15 }}
                    ],
                    backgroundColor: 'rgba(255,255,255,0.8)',
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
                    legend: { display: false }
                }
            }
        });
    }

    // Contacts Chart (Card 3)
    const cardChart3Element = document.getElementById('card-chart3');
    if (cardChart3Element) {
        const cardChart3 = new Chart(cardChart3Element, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    data: [{{ max(1, ($stats['contacts'] ?? 12) * 0.3) }}, {{ max(1, ($stats['contacts'] ?? 12) * 0.7) }}, {{ max(1, ($stats['contacts'] ?? 12) * 0.5) }}, {{ max(1, ($stats['contacts'] ?? 12) * 0.8) }}, {{ max(1, ($stats['contacts'] ?? 12) * 1.2) }}, {{ $stats['contacts'] ?? 12 }}],
                    borderColor: 'rgba(255,255,255,0.8)',
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
        });
    }

    // Events Chart (Card 4)
    const cardChart4Element = document.getElementById('card-chart4');
    if (cardChart4Element) {
        const cardChart4 = new Chart(cardChart4Element, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    data: [{{ max(1, ($stats['events'] ?? 7) * 0.5) }}, {{ max(1, ($stats['events'] ?? 7) * 0.4) }}, {{ max(1, ($stats['events'] ?? 7) * 0.9) }}, {{ max(1, ($stats['events'] ?? 7) * 0.6) }}, {{ max(1, ($stats['events'] ?? 7) * 1.3) }}, {{ $stats['events'] ?? 7 }}],
                    borderColor: 'rgba(255,255,255,0.8)',
                    backgroundColor: 'rgba(255,255,255,0.2)',
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
                    legend: { display: false }
                }
            }
        });
    }

    console.log('✅ LAMDAKU Dashboard loaded successfully with enhanced design');
});
</script>
@endsection
