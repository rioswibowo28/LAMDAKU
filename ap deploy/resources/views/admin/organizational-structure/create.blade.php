@extends('admin.layout-simple')

@section('title', 'Tambah Struktur Organisasi - LAMDAKU Admin')
@section('page-title', 'Tambah Struktur Organisasi')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-plus me-2"></i>Tambah Posisi Baru</h5>
            </div>
            <div class="card-body">                <form action="{{ route('admin.organizational-structure.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}" 
                                       placeholder="Contoh: Dr. Ahmad Santoso, M.Kes"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="position" class="form-label">Jabatan <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('position') is-invalid @enderror" 
                                       id="position" 
                                       name="position" 
                                       value="{{ old('position') }}" 
                                       placeholder="Contoh: Direktur Utama"
                                       required>
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="level_order" class="form-label">Level Organisasi <span class="text-danger">*</span></label>
                                <select class="form-select @error('level_order') is-invalid @enderror" 
                                        id="level_order" 
                                        name="level_order" 
                                        required>
                                    <option value="">Pilih Level</option>
                                    <option value="1" {{ old('level_order') == '1' ? 'selected' : '' }}>
                                        Level 1 - Direktur Utama
                                    </option>
                                    <option value="2" {{ old('level_order') == '2' ? 'selected' : '' }}>
                                        Level 2 - Direktur/Manager
                                    </option>
                                    <option value="3" {{ old('level_order') == '3' ? 'selected' : '' }}>
                                        Level 3 - Manager/Supervisor
                                    </option>
                                    <option value="4" {{ old('level_order') == '4' ? 'selected' : '' }}>
                                        Level 4 - Staff/Koordinator
                                    </option>                                    <option value="5" {{ old('level_order') == '5' ? 'selected' : '' }}>
                                        Level 5 - Staff
                                    </option>
                                    <option value="6" {{ old('level_order') == '6' ? 'selected' : '' }}>
                                        Level 6 - Junior Staff
                                    </option>
                                    <option value="7" {{ old('level_order') == '7' ? 'selected' : '' }}>
                                        Level 7 - Trainee/Intern
                                    </option>
                                </select>
                                @error('level_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Level menentukan urutan hierarki dalam bagan organisasi
                                </small>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="position_order" class="form-label">Urutan dalam Level</label>
                                <input type="number" 
                                       class="form-control @error('position_order') is-invalid @enderror" 
                                       id="position_order" 
                                       name="position_order" 
                                       value="{{ old('position_order', 1) }}" 
                                       min="1"
                                       max="10">
                                @error('position_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Urutan posisi dalam level yang sama (1, 2, 3, dst)
                                </small>
                            </div>
                        </div>
                    </div>                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Tanggung Jawab</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="3"
                                  placeholder="Contoh: Memimpin kebijakan strategis dan pengembangan organisasi">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto Profil</label>
                        <input type="file" 
                               class="form-control @error('photo') is-invalid @enderror" 
                               id="photo" 
                               name="photo" 
                               accept="image/*"
                               onchange="previewPhoto(this)">
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Format yang didukung: JPG, PNG, GIF. Maksimal 2MB.
                        </small>
                        <div id="photo-preview" class="mt-2" style="display: none;">
                            <img id="preview-image" src="" alt="Preview" style="max-width: 150px; max-height: 150px; border-radius: 8px; border: 2px solid #ddd;">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="background_color" class="form-label">Warna Background</label>
                                <div class="input-group">
                                    <input type="color" 
                                           class="form-control form-control-color @error('background_color') is-invalid @enderror" 
                                           id="background_color" 
                                           name="background_color" 
                                           value="{{ old('background_color', '#e3f2fd') }}"
                                           style="width: 60px;">
                                    <input type="text" 
                                           class="form-control" 
                                           id="background_color_text" 
                                           value="{{ old('background_color', '#e3f2fd') }}"
                                           readonly>
                                </div>
                                @error('background_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="icon_class" class="form-label">Icon CSS Class</label>
                                <input type="text" 
                                       class="form-control @error('icon_class') is-invalid @enderror" 
                                       id="icon_class" 
                                       name="icon_class" 
                                       value="{{ old('icon_class', 'fas fa-user') }}" 
                                       placeholder="fas fa-user">
                                @error('icon_class')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Gunakan FontAwesome icons. Contoh: fas fa-user, fas fa-crown, fas fa-cog
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Aktif
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.organizational-structure.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6><i class="fas fa-info-circle me-2"></i>Panduan Level Organisasi</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-danger me-2">1</span>
                        <strong>Level 1 - Pimpinan Tertinggi</strong>
                    </div>
                    <small class="text-muted">Direktur Utama, CEO, President</small>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-success me-2">2</span>
                        <strong>Level 2 - Direktur</strong>
                    </div>
                    <small class="text-muted">Direktur Operasional, Direktur Pengembangan</small>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-warning me-2">3</span>
                        <strong>Level 3 - Manager</strong>
                    </div>
                    <small class="text-muted">Manager Akreditasi, Manager Divisi</small>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-info me-2">4</span>
                        <strong>Level 4 - Supervisor</strong>
                    </div>
                    <small class="text-muted">Supervisor, Koordinator</small>
                </div>
                
                <div class="mb-3">
                    <div class="d-flex align-items-center mb-2">
                        <span class="badge bg-secondary me-2">5</span>
                        <strong>Level 5 - Staff</strong>
                    </div>
                    <small class="text-muted">Staff Operasional, Analis</small>
                </div>
            </div>
        </div>
        
        <!-- Preview Card -->
        <div class="card mt-3">
            <div class="card-header">
                <h6><i class="fas fa-eye me-2"></i>Preview</h6>
            </div>
            <div class="card-body">                <div id="preview-card" class="org-card-preview text-center p-3" style="background-color: #e3f2fd; border: 2px solid #90caf9; border-radius: 12px;">
                    <div class="preview-photo mb-2" id="preview-photo-container" style="display: none;">
                        <img id="preview-photo" src="" alt="Preview" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 3px solid #1976d2;">
                    </div>
                    <div class="preview-icon mb-2" id="preview-icon-container">
                        <i id="preview-icon" class="fas fa-user fa-2x" style="color: #1976d2;"></i>
                    </div>
                    <h6 id="preview-position" class="fw-bold text-primary mb-1">Jabatan</h6>
                    <p id="preview-name" class="mb-1 text-dark">Nama</p>
                    <small id="preview-description" class="text-muted">Deskripsi...</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Color picker sync
    const colorPicker = document.getElementById('background_color');
    const colorText = document.getElementById('background_color_text');
    const previewCard = document.getElementById('preview-card');
    
    colorPicker.addEventListener('input', function() {
        colorText.value = this.value;
        previewCard.style.backgroundColor = this.value;
    });
    
    // Icon preview
    const iconInput = document.getElementById('icon_class');
    const previewIcon = document.getElementById('preview-icon');
    
    iconInput.addEventListener('input', function() {
        previewIcon.className = this.value + ' fa-2x';
    });
    
    // Text previews
    document.getElementById('name').addEventListener('input', function() {
        document.getElementById('preview-name').textContent = this.value || 'Nama';
    });
    
    document.getElementById('position').addEventListener('input', function() {
        document.getElementById('preview-position').textContent = this.value || 'Jabatan';
    });
      document.getElementById('description').addEventListener('input', function() {
        document.getElementById('preview-description').textContent = this.value || 'Deskripsi...';
    });
});

// Photo preview function
function previewPhoto(input) {
    const photoPreview = document.getElementById('photo-preview');
    const previewImage = document.getElementById('preview-image');
    const cardPreviewPhoto = document.getElementById('preview-photo');
    const cardPhotoContainer = document.getElementById('preview-photo-container');
    const cardIconContainer = document.getElementById('preview-icon-container');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            // Show preview below file input
            previewImage.src = e.target.result;
            photoPreview.style.display = 'block';
            
            // Update card preview
            cardPreviewPhoto.src = e.target.result;
            cardPhotoContainer.style.display = 'block';
            cardIconContainer.style.display = 'none';
        };
        
        reader.readAsDataURL(input.files[0]);
    } else {
        // Hide previews if no file selected
        photoPreview.style.display = 'none';
        cardPhotoContainer.style.display = 'none';
        cardIconContainer.style.display = 'block';
    }
}
</script>
@endsection
