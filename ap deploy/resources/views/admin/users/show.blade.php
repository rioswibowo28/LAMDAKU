@extends('admin.layout-simple')

@section('title', 'Detail User')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Detail User</h1>
            <p class="mb-0 text-muted">Informasi lengkap user: {{ $user->name }}</p>
        </div>
        <div class="d-flex gap-2">
            @if(session('admin_role') === 'admin')
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-2"></i>Edit User
                </a>
            @endif
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Umum</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center mb-4">
                                <div class="avatar avatar-xl mx-auto mb-3">
                                    <div class="avatar-content bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 100px; height: 100px; font-size: 36px; font-weight: 600;">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                </div>
                                <h5 class="mb-1">{{ $user->name }}</h5>
                                <p class="text-muted mb-0">{{ $user->role_name }}</p>
                                @if($user->is_active)
                                    <span class="badge bg-success mt-2">Aktif</span>
                                @else
                                    <span class="badge bg-secondary mt-2">Tidak Aktif</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Username</label>
                                        <div class="form-control-plaintext">
                                            <code>{{ $user->username }}</code>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Email</label>
                                        <div class="form-control-plaintext">{{ $user->email }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Role</label>
                                        <div class="form-control-plaintext">
                                            @if($user->role === 'admin')
                                                <span class="badge bg-danger">Administrator</span>
                                            @else
                                                <span class="badge bg-info">Penulis</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">ID User</label>
                                        <div class="form-control-plaintext">#{{ $user->id }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Aktivitas Login</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Terdaftar Sejak</label>
                                <div class="form-control-plaintext">
                                    {{ $user->created_at->format('d/m/Y H:i:s') }}
                                    <br><small class="text-muted">({{ $user->created_at->diffForHumans() }})</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Terakhir Diperbarui</label>
                                <div class="form-control-plaintext">
                                    {{ $user->updated_at->format('d/m/Y H:i:s') }}
                                    <br><small class="text-muted">({{ $user->updated_at->diffForHumans() }})</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Login Terakhir</label>
                                <div class="form-control-plaintext">
                                    @if($user->last_login_at)
                                        {{ $user->last_login_at->format('d/m/Y H:i:s') }}
                                        <br><small class="text-muted">({{ $user->last_login_at->diffForHumans() }})</small>
                                    @else
                                        <span class="text-muted">Belum pernah login</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Status Login</label>
                                <div class="form-control-plaintext">
                                    @if($user->id === session('admin_user_id') && session('admin_authenticated'))
                                        <span class="badge bg-success">Sedang Login</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Login</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Hak Akses</h6>
                </div>
                <div class="card-body">
                    @if($user->role === 'admin')
                        <h6 class="text-danger">Administrator</h6>
                        <ul class="small">
                            <li>✅ Mengelola semua konten</li>
                            <li>✅ Mengelola user lain</li>
                            <li>✅ Mengubah pengaturan sistem</li>
                            <li>✅ Mengelola Company Info</li>
                            <li>✅ Mengelola Struktur Organisasi</li>
                            <li>✅ Mengelola Visi Misi Tujuan</li>
                            <li>✅ Melihat semua kontak masuk</li>
                            <li>✅ Upload dan kelola file</li>
                        </ul>
                    @else
                        <h6 class="text-info">Penulis</h6>
                        <ul class="small">
                            <li>✅ Mengelola Pages</li>
                            <li>✅ Mengelola Services</li>
                            <li>✅ Mengelola Timeline</li>
                            <li>✅ Melihat kontak masuk</li>
                            <li>✅ Upload file untuk konten</li>
                            <li>❌ Mengelola user lain</li>
                            <li>❌ Mengubah pengaturan sistem</li>
                            <li>❌ Mengelola Company Info</li>
                        </ul>
                    @endif
                </div>
            </div>

            @if(session('admin_role') === 'admin' && $user->id !== session('admin_user_id'))
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi Administrator</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="mb-2">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-{{ $user->is_active ? 'warning' : 'success' }} btn-sm w-100"
                                onclick="return confirm('Yakin ingin {{ $user->is_active ? 'menonaktifkan' : 'mengaktifkan' }} user ini?')">
                            <i class="fas fa-{{ $user->is_active ? 'ban' : 'check' }} me-2"></i>
                            {{ $user->is_active ? 'Nonaktifkan User' : 'Aktifkan User' }}
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm w-100"
                                onclick="return confirm('Yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan.')">
                            <i class="fas fa-trash me-2"></i>Hapus User
                        </button>
                    </form>
                </div>
            </div>
            @endif

            @if($user->id === session('admin_user_id'))
            <div class="card mt-3">
                <div class="card-body">
                    <div class="alert alert-info mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Akun Aktif</strong><br>
                        Ini adalah akun yang sedang Anda gunakan saat ini.
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
.avatar-content {
    font-weight: 600;
}
.form-control-plaintext {
    padding-left: 0;
    padding-right: 0;
}
</style>
@endpush
@endsection
