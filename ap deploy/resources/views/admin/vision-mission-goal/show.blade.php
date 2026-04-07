@extends('admin.layout-simple')

@section('title', 'Detail Visi/Misi/Tujuan - LAMDAKU Admin')
@section('page-title', 'Detail Visi, Misi & Tujuan')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-eye me-2"></i>Detail Item</h5>
            </div>
            <div class="card-body">
                
                <!-- Item Preview -->
                <div class="mb-4">
                    <h6 class="mb-3">Preview Item</h6>
                    <div class="card border-{{ $visionMissionGoal->type === 'vision' ? 'primary' : ($visionMissionGoal->type === 'mission' ? 'success' : 'warning') }}">
                        <div class="card-body" style="background: linear-gradient(135deg, {{ $visionMissionGoal->background_color }}15, {{ $visionMissionGoal->background_color }}05);">
                            <div class="d-flex align-items-start">
                                <div class="me-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 60px; height: 60px; background-color: {{ $visionMissionGoal->background_color }}; color: white;">
                                        <i class="{{ $visionMissionGoal->icon_class }}"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="mb-2">
                                        <span class="badge bg-{{ $visionMissionGoal->type === 'vision' ? 'primary' : ($visionMissionGoal->type === 'mission' ? 'success' : 'warning') }}">
                                            {{ $visionMissionGoal->getTypeDisplayName() }}
                                        </span>
                                    </div>
                                    <h5 class="fw-bold mb-3">{{ $visionMissionGoal->title }}</h5>
                                    <p class="mb-2">{{ $visionMissionGoal->content }}</p>
                                    @if($visionMissionGoal->description)
                                    <small class="text-muted">{{ $visionMissionGoal->description }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Item Details -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Tipe</label>
                            <p class="fw-bold">
                                <span class="badge bg-{{ $visionMissionGoal->type === 'vision' ? 'primary' : ($visionMissionGoal->type === 'mission' ? 'success' : 'warning') }}">
                                    {{ $visionMissionGoal->getTypeDisplayName() }}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Status</label>
                            <p class="fw-bold">
                                <span class="badge bg-{{ $visionMissionGoal->is_active ? 'success' : 'secondary' }}">
                                    {{ $visionMissionGoal->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Judul</label>
                    <p class="fw-bold">{{ $visionMissionGoal->title }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Konten</label>
                    <div class="card bg-light">
                        <div class="card-body">
                            <p class="mb-0">{{ $visionMissionGoal->content }}</p>
                        </div>
                    </div>
                </div>

                @if($visionMissionGoal->description)
                <div class="mb-3">
                    <label class="form-label text-muted">Deskripsi Tambahan</label>
                    <div class="card bg-light">
                        <div class="card-body">
                            <p class="mb-0">{{ $visionMissionGoal->description }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label text-muted">Icon Class</label>
                            <p class="fw-bold">
                                <i class="{{ $visionMissionGoal->icon_class }} me-2"></i>{{ $visionMissionGoal->icon_class }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label text-muted">Background Color</label>
                            <p class="fw-bold">
                                <span class="rounded-circle d-inline-block me-2" 
                                      style="width: 20px; height: 20px; background-color: {{ $visionMissionGoal->background_color }};"></span>
                                {{ $visionMissionGoal->background_color }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label text-muted">Urutan</label>
                            <p class="fw-bold">{{ $visionMissionGoal->sort_order }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Dibuat</label>
                            <p class="text-muted">{{ $visionMissionGoal->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label text-muted">Terakhir Diperbarui</label>
                            <p class="text-muted">{{ $visionMissionGoal->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.vision-mission-goal.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                    <div>
                        <a href="{{ route('admin.vision-mission-goal.edit', $visionMissionGoal) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <form action="{{ route('admin.vision-mission-goal.toggle-active', $visionMissionGoal) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-{{ $visionMissionGoal->is_active ? 'secondary' : 'success' }}" 
                                    onclick="return confirm('Yakin ingin {{ $visionMissionGoal->is_active ? 'menonaktifkan' : 'mengaktifkan' }} item ini?')">
                                <i class="fas fa-{{ $visionMissionGoal->is_active ? 'pause' : 'play' }} me-2"></i>
                                {{ $visionMissionGoal->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6><i class="fas fa-info-circle me-2"></i>Informasi</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6>Tipe: {{ $visionMissionGoal->getTypeDisplayName() }}</h6>
                    <p class="small text-muted">
                        @if($visionMissionGoal->type === 'vision')
                            Visi menggambarkan gambaran masa depan yang ingin dicapai oleh organisasi.
                        @elseif($visionMissionGoal->type === 'mission')
                            Misi adalah langkah-langkah konkret yang dilakukan untuk mencapai visi.
                        @else
                            Tujuan adalah target spesifik yang ingin dicapai dalam jangka waktu tertentu.
                        @endif
                    </p>
                </div>

                <div class="mb-3">
                    <h6>Status Publikasi</h6>
                    <p class="small">
                        Item ini {{ $visionMissionGoal->is_active ? 'aktif dan akan ditampilkan' : 'nonaktif dan tidak akan ditampilkan' }} 
                        di frontend website.
                    </p>
                </div>

                <div class="mb-3">
                    <h6>Penggunaan API</h6>
                    <p class="small text-muted">
                        Item ini dapat diakses melalui API endpoint:
                    </p>
                    <ul class="small">
                        <li><code>/api/v1/vision-mission-goal</code></li>
                        <li><code>/api/v1/vision-mission-goal/{{ $visionMissionGoal->type }}</code></li>
                        <li><code>/api/v1/vision-mission-goal/{{ $visionMissionGoal->id }}</code></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
