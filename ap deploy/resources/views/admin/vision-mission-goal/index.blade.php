@extends('admin.layout-simple')

@section('title', 'Visi, Misi & Tujuan - LAMDAKU Admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Card -->
    <div class="card bg-gradient-primary text-white border-0 shadow-lg mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="mb-2 fw-bold">
                        <i class="fas fa-bullseye me-3"></i>Visi, Misi & Tujuan
                    </h3>
                    <p class="mb-0 opacity-90">Kelola visi, misi, dan tujuan perusahaan LAMDAKU</p>
                </div>
                <a href="{{ route('admin.vision-mission-goal.create') }}" class="btn btn-light">
                    <i class="fas fa-plus me-2"></i>Tambah Item
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
              @if($groupedItems['vision']->count() > 0 || $groupedItems['mission']->count() > 0 || $groupedItems['goals']->count() > 0)
                <!-- Content Preview Section -->
                <div class="row g-4 mb-4">
                    <div class="col-12">
                        <h5 class="mb-3 fw-bold text-dark">
                            <i class="fas fa-eye me-2 text-primary"></i>Preview Konten
                        </h5>
                    </div>
                    
                    <!-- Vision Section -->
                    @if($groupedItems['vision']->count() > 0)
                    <div class="col-12">
                        <div class="card border-primary border-start border-5 mb-4">
                            <div class="card-header bg-primary bg-opacity-10">
                                <h6 class="mb-0 text-primary fw-bold">
                                    <i class="fas fa-eye me-2"></i>Visi LAMDAKU
                                </h6>
                            </div>
                            <div class="card-body">
                                @foreach($groupedItems['vision'] as $vision)
                                <div class="d-flex align-items-start">
                                    <div class="me-3">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px; background-color: {{ $vision->background_color }}; color: white;">
                                            <i class="{{ $vision->icon_class }}"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-bold mb-2">{{ $vision->title }}</h6>
                                        <p class="mb-1 text-muted">{{ $vision->content }}</p>
                                        @if($vision->description)
                                        <small class="text-muted fst-italic">{{ $vision->description }}</small>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif                    <!-- Mission Section -->
                    @if($groupedItems['mission']->count() > 0)
                    <div class="col-12">
                        <div class="card border-success border-start border-5 mb-4">
                            <div class="card-header bg-success bg-opacity-10">
                                <h6 class="mb-0 text-success fw-bold">
                                    <i class="fas fa-check-circle me-2"></i>Misi LAMDAKU
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    @foreach($groupedItems['mission'] as $mission)
                                    <div class="col-md-6">
                                        <div class="card border-success border-opacity-25 h-100">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="me-2">
                                                        <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                                             style="width: 30px; height: 30px; background-color: {{ $mission->background_color }}; color: white;">
                                                            <i class="{{ $mission->icon_class }}" style="font-size: 12px;"></i>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted fw-semibold">Misi {{ $mission->sort_order }}</small>
                                                </div>
                                                <p class="mb-1 small">{{ $mission->content }}</p>
                                                @if($mission->description)
                                                <small class="text-muted fst-italic">{{ $mission->description }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif                    <!-- Goals Section -->
                    @if($groupedItems['goals']->count() > 0)
                    <div class="col-12">
                        <div class="card border-warning border-start border-5 mb-4">
                            <div class="card-header bg-warning bg-opacity-10">
                                <h6 class="mb-0 text-warning fw-bold">
                                    <i class="fas fa-bullseye me-2"></i>Tujuan LAMDAKU
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    @foreach($groupedItems['goals'] as $goal)
                                    <div class="col-md-4">
                                        <div class="card border-warning border-opacity-25 h-100">
                                            <div class="card-body text-center">
                                                <div class="mb-3">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                                                         style="width: 60px; height: 60px; background-color: {{ $goal->background_color }}; color: white;">
                                                        <i class="{{ $goal->icon_class }}"></i>
                                                    </div>
                                                </div>
                                                <h6 class="fw-bold mb-2">{{ $goal->title }}</h6>
                                                <p class="small mb-2 text-muted">{{ $goal->content }}</p>
                                                @if($goal->description)
                                                <small class="text-muted fst-italic">{{ $goal->description }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <hr class="my-4">
            @endif            <!-- Data Management Section -->
            <div class="row g-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-table me-2 text-primary"></i>Data Management
                        </h5>
                        <div class="d-flex gap-2">
                            <span class="badge bg-primary">{{ $groupedItems['vision']->count() }} Visi</span>
                            <span class="badge bg-success">{{ $groupedItems['mission']->count() }} Misi</span>
                            <span class="badge bg-warning">{{ $groupedItems['goals']->count() }} Tujuan</span>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="12%">Tipe</th>
                                    <th width="25%">Judul</th>
                                    <th width="35%">Konten</th>
                                    <th width="8%">Urutan</th>
                                    <th width="10%">Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($items as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $item->type === 'vision' ? 'primary' : ($item->type === 'mission' ? 'success' : 'warning') }}">
                                            {{ $item->getTypeDisplayName() }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ Str::limit($item->title, 35) }}</div>
                                        @if($item->description)
                                        <small class="text-muted">{{ Str::limit($item->description, 40) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <p class="mb-0 small">{{ Str::limit($item->content, 80) }}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark">{{ $item->sort_order }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $item->is_active ? 'success' : 'secondary' }}">
                                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.vision-mission-goal.show', $item) }}" 
                                               class="btn btn-info btn-sm" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.vision-mission-goal.edit', $item) }}" 
                                               class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.vision-mission-goal.toggle-active', $item) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="btn btn-{{ $item->is_active ? 'secondary' : 'success' }} btn-sm" 
                                                        title="{{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}"
                                                        onclick="return confirm('Yakin ingin {{ $item->is_active ? 'menonaktifkan' : 'mengaktifkan' }} item ini?')">
                                                    <i class="fas fa-{{ $item->is_active ? 'pause' : 'play' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.vision-mission-goal.destroy', $item) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger btn-sm" 
                                                        title="Hapus"
                                                        onclick="return confirm('Yakin ingin menghapus item ini? Data yang dihapus tidak dapat dikembalikan.')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">
                                        <div class="py-4">
                                            <i class="fas fa-inbox fa-3x mb-3 text-muted opacity-50"></i>
                                            <h6 class="text-muted">Belum ada data visi, misi, atau tujuan</h6>
                                            <p class="small text-muted mb-3">Mulai tambahkan konten untuk organisasi Anda</p>
                                            <a href="{{ route('admin.vision-mission-goal.create') }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-plus me-2"></i>Tambah Item Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #4285f4 0%, #34a853 100%) !important;
    }
    
    .border-start {
        border-left-width: 3px !important;
    }
    
    .border-5 {
        border-width: 5px !important;
    }
    
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }
    
    .table th {
        border-top: none;
        font-weight: 600;
        font-size: 0.875rem;
    }
    
    .btn-group .btn {
        border-radius: 0.375rem;
        margin-right: 2px;
    }
    
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    
    .shadow-sm {
        box-shadow: 0 2px 10px rgba(0,0,0,0.08) !important;
    }
</style>
@endsection
