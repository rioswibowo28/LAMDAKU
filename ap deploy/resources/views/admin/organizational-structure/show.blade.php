@extends('admin.layout-simple')

@section('title', 'Detail Struktur Organisasi - LAMDAKU Admin')
@section('page-title', 'Detail Struktur Organisasi')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-eye me-2"></i>Detail Posisi: {{ $organizationalStructure->name }}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Nama</label>
                            <p class="h6">{{ $organizationalStructure->name }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Jabatan</label>
                            <p class="h6">{{ $organizationalStructure->position }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Level Organisasi</label>
                            <p>
                                <span class="badge bg-info fs-6">Level {{ $organizationalStructure->level_order }}</span>
                            </p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Urutan dalam Level</label>
                            <p>
                                <span class="badge bg-secondary fs-6">{{ $organizationalStructure->position_order }}</span>
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Status</label>
                            <p>
                                <span class="badge bg-{{ $organizationalStructure->is_active ? 'success' : 'warning' }} fs-6">
                                    {{ $organizationalStructure->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Warna Background</label>
                            <p>
                                <span class="badge" style="background-color: {{ $organizationalStructure->background_color }}; color: #333;">
                                    {{ $organizationalStructure->background_color }}
                                </span>
                            </p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Icon</label>
                            <p>
                                <i class="{{ $organizationalStructure->icon_class }} fa-lg me-2"></i>
                                <code>{{ $organizationalStructure->icon_class }}</code>
                            </p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Dibuat</label>
                            <p class="text-muted">{{ $organizationalStructure->created_at->format('d M Y H:i') }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label text-muted">Terakhir Diupdate</label>
                            <p class="text-muted">{{ $organizationalStructure->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                
                @if($organizationalStructure->description)
                <div class="mb-3">
                    <label class="form-label text-muted">Deskripsi Tanggung Jawab</label>
                    <div class="card bg-light">
                        <div class="card-body">
                            <p class="mb-0">{{ $organizationalStructure->description }}</p>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.organizational-structure.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <div>
                        <a href="{{ route('admin.organizational-structure.edit', $organizationalStructure) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <form action="{{ route('admin.organizational-structure.toggle-active', $organizationalStructure) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-{{ $organizationalStructure->is_active ? 'secondary' : 'success' }}" 
                                    onclick="return confirm('Yakin ingin {{ $organizationalStructure->is_active ? 'menonaktifkan' : 'mengaktifkan' }} posisi ini?')">
                                <i class="fas fa-{{ $organizationalStructure->is_active ? 'pause' : 'play' }} me-2"></i>
                                {{ $organizationalStructure->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Preview Card -->
        <div class="card">
            <div class="card-header">
                <h6><i class="fas fa-eye me-2"></i>Preview Card</h6>
            </div>
            <div class="card-body">                <div class="org-card-preview text-center p-3" style="background-color: {{ $organizationalStructure->background_color }}; border: 2px solid #90caf9; border-radius: 12px; position: relative;">
                    @if($organizationalStructure->photo)
                        <div class="preview-photo mb-2">
                            <img src="{{ $organizationalStructure->photo_url }}" alt="{{ $organizationalStructure->name }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid #1976d2;">
                        </div>
                    @else
                        <div class="preview-icon mb-2">
                            <i class="{{ $organizationalStructure->icon_class }} fa-2x" style="color: #1976d2;"></i>
                        </div>
                    @endif
                    <h6 class="fw-bold text-primary mb-1">{{ $organizationalStructure->position }}</h6>
                    <p class="mb-1 text-dark">{{ $organizationalStructure->name }}</p>
                    @if($organizationalStructure->description)
                        <small class="text-muted">{{ Str::limit($organizationalStructure->description, 60) }}</small>
                    @endif
                    
                    @if(!$organizationalStructure->is_active)
                        <div style="position: absolute; top: 5px; right: 5px;">
                            <span class="badge bg-warning">Tidak Aktif</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Level Info -->
        <div class="card mt-3">
            <div class="card-header">
                <h6><i class="fas fa-info-circle me-2"></i>Informasi Level</h6>
            </div>
            <div class="card-body">                @php
                    $levelInfo = [
                        1 => ['name' => 'Pimpinan Tertinggi', 'color' => 'danger', 'desc' => 'Direktur Utama, CEO, President'],
                        2 => ['name' => 'Direktur', 'color' => 'success', 'desc' => 'Direktur Operasional, Direktur Pengembangan'],
                        3 => ['name' => 'Manager', 'color' => 'warning', 'desc' => 'Manager Akreditasi, Manager Divisi'],
                        4 => ['name' => 'Supervisor', 'color' => 'info', 'desc' => 'Supervisor, Koordinator'],
                        5 => ['name' => 'Staff', 'color' => 'secondary', 'desc' => 'Staff Operasional, Analis'],
                        6 => ['name' => 'Junior Staff', 'color' => 'primary', 'desc' => 'Junior Staff, Asisten'],
                        7 => ['name' => 'Trainee/Intern', 'color' => 'light', 'desc' => 'Trainee, Intern, Magang']
                    ];
                    $currentLevel = $levelInfo[$organizationalStructure->level_order] ?? ['name' => 'Unknown', 'color' => 'dark', 'desc' => ''];
                @endphp
                
                <div class="text-center">
                    <div class="mb-3">
                        <span class="badge bg-{{ $currentLevel['color'] }} fs-5">
                            Level {{ $organizationalStructure->level_order }}
                        </span>
                    </div>
                    <h6 class="fw-bold">{{ $currentLevel['name'] }}</h6>
                    <p class="text-muted small">{{ $currentLevel['desc'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
