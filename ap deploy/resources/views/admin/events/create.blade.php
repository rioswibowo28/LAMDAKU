@extends('admin.layout-simple')

@section('title', 'Tambah Event')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Tambah Event</h1>
                    <p class="text-muted">Buat event baru untuk website</p>
                </div>
                <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Main Content -->
                    <div class="col-md-8">
                        <!-- Basic Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Informasi Dasar</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Event <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Deskripsi Singkat</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="3" 
                                              placeholder="Deskripsi singkat event...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="content" class="form-label">Konten Event <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="content" name="content" rows="10" required 
                                              placeholder="Tulis konten detail event...">{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Event Details -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Detail Event</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="start_date" class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                                            <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" 
                                                   id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                            @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="end_date" class="form-label">Tanggal Selesai</label>
                                            <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" 
                                                   id="end_date" name="end_date" value="{{ old('end_date') }}">
                                            @error('end_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_all_day" name="is_all_day" value="1" {{ old('is_all_day') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_all_day">
                                            Event sepanjang hari
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="timezone" class="form-label">Zona Waktu</label>
                                    <select class="form-select @error('timezone') is-invalid @enderror" id="timezone" name="timezone">
                                        <option value="Asia/Jakarta" {{ old('timezone', 'Asia/Jakarta') === 'Asia/Jakarta' ? 'selected' : '' }}>WIB (Asia/Jakarta)</option>
                                        <option value="Asia/Makassar" {{ old('timezone') === 'Asia/Makassar' ? 'selected' : '' }}>WITA (Asia/Makassar)</option>
                                        <option value="Asia/Jayapura" {{ old('timezone') === 'Asia/Jayapura' ? 'selected' : '' }}>WIT (Asia/Jayapura)</option>
                                    </select>
                                    @error('timezone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="location" class="form-label">Lokasi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                           id="location" name="location" value="{{ old('location') }}" required 
                                           placeholder="Nama lokasi event">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" 
                                              id="address" name="address" rows="3" 
                                              placeholder="Alamat lengkap lokasi event...">{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Registration Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Informasi Pendaftaran</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="requires_registration" 
                                               name="requires_registration" value="1" {{ old('requires_registration') ? 'checked' : '' }}
                                               onchange="toggleRegistrationFields()">
                                        <label class="form-check-label" for="requires_registration">
                                            Event memerlukan pendaftaran
                                        </label>
                                    </div>
                                </div>

                                <div id="registration-fields" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="max_participants" class="form-label">Maksimal Peserta</label>
                                                <input type="number" class="form-control @error('max_participants') is-invalid @enderror" 
                                                       id="max_participants" name="max_participants" value="{{ old('max_participants') }}" 
                                                       min="1" placeholder="Kosongkan jika tidak terbatas">
                                                @error('max_participants')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="registration_fee" class="form-label">Biaya Pendaftaran (Rp)</label>
                                                <input type="number" class="form-control @error('registration_fee') is-invalid @enderror" 
                                                       id="registration_fee" name="registration_fee" value="{{ old('registration_fee', 0) }}" 
                                                       min="0" step="1000">
                                                @error('registration_fee')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="registration_deadline" class="form-label">Batas Waktu Pendaftaran</label>
                                        <input type="datetime-local" class="form-control @error('registration_deadline') is-invalid @enderror" 
                                               id="registration_deadline" name="registration_deadline" value="{{ old('registration_deadline') }}">
                                        @error('registration_deadline')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Informasi Kontak</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_person" class="form-label">Nama Contact Person</label>
                                            <input type="text" class="form-control @error('contact_person') is-invalid @enderror" 
                                                   id="contact_person" name="contact_person" value="{{ old('contact_person') }}">
                                            @error('contact_person')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_email" class="form-label">Email</label>
                                            <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                                                   id="contact_email" name="contact_email" value="{{ old('contact_email') }}">
                                            @error('contact_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_phone" class="form-label">Nomor Telepon</label>
                                            <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" 
                                                   id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}">
                                            @error('contact_phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="website" class="form-label">Website Event</label>
                                            <input type="url" class="form-control @error('website') is-invalid @enderror" 
                                                   id="website" name="website" value="{{ old('website') }}" 
                                                   placeholder="https://example.com">
                                            @error('website')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-md-4">
                        <!-- Publish Settings -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Pengaturan Publikasi</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_featured" 
                                               name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Event unggulan
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Event Category -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Kategori & Tag</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Kategori</label>
                                    <input type="text" class="form-control @error('category') is-invalid @enderror" 
                                           id="category" name="category" value="{{ old('category') }}" 
                                           list="categories" placeholder="Pilih atau ketik kategori">
                                    <datalist id="categories">
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}">
                                        @endforeach
                                    </datalist>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="event_type" class="form-label">Tipe Event</label>
                                    <select class="form-select @error('event_type') is-invalid @enderror" id="event_type" name="event_type">
                                        <option value="">Pilih Tipe Event</option>
                                        @foreach($eventTypes as $type)
                                            <option value="{{ $type }}" {{ old('event_type') === $type ? 'selected' : '' }}>
                                                {{ ucfirst($type) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('event_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tags" class="form-label">Tag</label>
                                    <input type="text" class="form-control @error('tags') is-invalid @enderror" 
                                           id="tags" name="tags" value="{{ old('tags') }}" 
                                           placeholder="Tag1, Tag2, Tag3">
                                    <small class="form-text text-muted">Pisahkan dengan koma</small>
                                    @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Gambar Utama</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                                           id="featured_image" name="featured_image" accept="image/*">
                                    <small class="form-text text-muted">Maksimal 2MB (JPG, PNG, GIF)</small>
                                    @error('featured_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div id="featured-preview" style="display: none;">
                                    <img id="featured-img" src="" alt="Preview" class="img-fluid rounded">
                                </div>
                            </div>
                        </div>

                        <!-- Gallery -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Galeri Gambar</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="file" class="form-control @error('gallery') is-invalid @enderror" 
                                           id="gallery" name="gallery[]" accept="image/*" multiple>
                                    <small class="form-text text-muted">Pilih beberapa gambar (maksimal 2MB per file)</small>
                                    @error('gallery')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div id="gallery-preview" class="row"></div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Simpan Event
                                    </button>
                                    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Toggle registration fields
function toggleRegistrationFields() {
    const checkbox = document.getElementById('requires_registration');
    const fields = document.getElementById('registration-fields');
    fields.style.display = checkbox.checked ? 'block' : 'none';
}

// Featured image preview
document.getElementById('featured_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('featured-img').src = e.target.result;
            document.getElementById('featured-preview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        document.getElementById('featured-preview').style.display = 'none';
    }
});

// Gallery preview
document.getElementById('gallery').addEventListener('change', function(e) {
    const files = e.target.files;
    const preview = document.getElementById('gallery-preview');
    preview.innerHTML = '';
    
    Array.from(files).forEach((file, index) => {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-6 mb-2';
                col.innerHTML = `
                    <img src="${e.target.result}" alt="Gallery ${index + 1}" 
                         class="img-fluid rounded" style="height: 80px; object-fit: cover;">
                `;
                preview.appendChild(col);
            };
            reader.readAsDataURL(file);
        }
    });
});

// Initialize registration fields visibility
document.addEventListener('DOMContentLoaded', function() {
    toggleRegistrationFields();
});
</script>
@endsection
