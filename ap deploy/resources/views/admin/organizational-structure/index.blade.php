@extends('admin.layout-simple')

@section('title', 'Struktur Organisasi - LAMDAKU Admin')
@section('page-title', 'Struktur Organisasi')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-sitemap me-2"></i>Struktur Organisasi</h5>
                <a href="{{ route('admin.organizational-structure.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Tambah Posisi
                </a>
            </div>
            <div class="card-body">
                
                @if($groupedStructures->count() > 0)
                    <!-- Organization Chart Preview -->
                    <div class="mb-4">
                        <h6 class="mb-3"><i class="fas fa-eye me-2"></i>Preview Bagan Organisasi</h6>
                        <div class="org-chart-preview">
                            @foreach($groupedStructures as $level => $positions)
                                <div class="org-level mb-3">
                                    <div class="level-indicator mb-2">
                                        <span class="badge bg-secondary">Level {{ $level }}</span>
                                    </div>
                                    <div class="row justify-content-center">
                                        @foreach($positions as $position)                                            <div class="col-md-{{ $level == 1 ? '6' : ($level == 2 ? '6' : '4') }} mb-3">
                                                <div class="org-card" style="background-color: {{ $position->background_color }};">
                                                    @if($position->photo)
                                                        <div class="org-card-photo">
                                                            <img src="{{ $position->photo_url }}" alt="{{ $position->name }}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover; border: 3px solid #fff; margin-bottom: 10px;">
                                                        </div>
                                                    @else
                                                        <div class="org-card-icon">
                                                            <i class="{{ $position->icon_class }} fa-2x"></i>
                                                        </div>
                                                    @endif
                                                    <div class="org-card-content">
                                                        <h6 class="org-position">{{ $position->position }}</h6>
                                                        <p class="org-name">{{ $position->name }}</p>
                                                        @if($position->description)
                                                            <small class="org-description">{{ Str::limit($position->description, 80) }}</small>
                                                        @endif
                                                    </div>
                                                    @if(!$position->is_active)
                                                        <div class="org-inactive-overlay">
                                                            <span class="badge bg-warning">Tidak Aktif</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if(!$loop->last)
                                        <div class="org-connector text-center">
                                            <i class="fas fa-arrow-down fa-2x text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Level</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Urutan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($structures as $structure)
                                <tr class="{{ !$structure->is_active ? 'table-warning' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $structure->level_order }}</span>
                                    </td>                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($structure->photo)
                                                <img src="{{ $structure->photo_url }}" alt="{{ $structure->name }}" class="me-2" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                            @else
                                                <i class="{{ $structure->icon_class }} me-2"></i>
                                            @endif
                                            <strong>{{ $structure->name }}</strong>
                                        </div>
                                    </td>
                                    <td>{{ $structure->position }}</td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $structure->position_order }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $structure->is_active ? 'success' : 'warning' }}">
                                            {{ $structure->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.organizational-structure.show', $structure) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.organizational-structure.edit', $structure) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.organizational-structure.toggle-active', $structure) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-{{ $structure->is_active ? 'secondary' : 'success' }} btn-sm" 
                                                        onclick="return confirm('Yakin ingin {{ $structure->is_active ? 'menonaktifkan' : 'mengaktifkan' }} posisi ini?')">
                                                    <i class="fas fa-{{ $structure->is_active ? 'pause' : 'play' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.organizational-structure.destroy', $structure) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" 
                                                        onclick="return confirm('Yakin ingin menghapus posisi ini?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-sitemap fa-3x text-muted mb-3"></i>
                        <h5>Belum ada struktur organisasi</h5>
                        <p class="text-muted">Tambahkan posisi dan jabatan untuk membuat bagan organisasi.</p>
                        <a href="{{ route('admin.organizational-structure.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Tambah Posisi Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.org-chart-preview {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    border: 2px dashed #dee2e6;
}

.org-level {
    position: relative;
}

.level-indicator {
    text-align: center;
}

.org-card {
    background: #e3f2fd;
    border: 2px solid #90caf9;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    position: relative;
    min-height: 120px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    transition: transform 0.2s ease;
}

.org-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.org-card-icon {
    margin-bottom: 10px;
    color: #1976d2;
}

.org-position {
    font-weight: bold;
    color: #1976d2;
    margin-bottom: 5px;
    font-size: 0.9rem;
}

.org-name {
    color: #0d47a1;
    margin-bottom: 5px;
    font-size: 0.85rem;
}

.org-description {
    color: #424242;
    font-size: 0.75rem;
    line-height: 1.2;
}

.org-inactive-overlay {
    position: absolute;
    top: 5px;
    right: 5px;
}

.org-connector {
    margin: 10px 0;
}

/* Level-specific colors */
.org-level:nth-child(1) .org-card {
    background-color: #ffebee;
    border-color: #ef5350;
}

.org-level:nth-child(1) .org-card-icon {
    color: #c62828;
}

.org-level:nth-child(1) .org-position {
    color: #c62828;
}

.org-level:nth-child(2) .org-card {
    background-color: #e8f5e8;
    border-color: #66bb6a;
}

.org-level:nth-child(2) .org-card-icon {
    color: #2e7d32;
}

.org-level:nth-child(2) .org-position {
    color: #2e7d32;
}

.org-level:nth-child(3) .org-card {
    background-color: #fff3e0;
    border-color: #ffa726;
}

.org-level:nth-child(3) .org-card-icon {
    color: #ef6c00;
}

.org-level:nth-child(3) .org-position {
    color: #ef6c00;
}
</style>
@endsection
