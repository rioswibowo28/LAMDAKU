@extends('admin.layout-simple')

@section('title', 'Tambah Visi/Misi/Tujuan - LAMDAKU Admin')
@section('page-title', 'Tambah Visi, Misi & Tujuan')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5><i class="fas fa-plus me-2"></i>Tambah Item Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.vision-mission-goal.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipe <span class="text-danger">*</span></label>
                        <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                            <option value="">Pilih Tipe</option>
                            @foreach($types as $key => $label)
                                <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <small>
                                <strong>Visi:</strong> Gambaran masa depan yang ingin dicapai<br>
                                <strong>Misi:</strong> Langkah-langkah untuk mencapai visi<br>
                                <strong>Tujuan:</strong> Target spesifik yang ingin dicapai
                            </small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Konten <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="4" required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Tambahan</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="2">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Deskripsi opsional atau subtitle</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="icon_class" class="form-label">Icon Class</label>
                                <input type="text" class="form-control @error('icon_class') is-invalid @enderror" 
                                       id="icon_class" name="icon_class" value="{{ old('icon_class') }}" 
                                       placeholder="fas fa-eye">
                                @error('icon_class')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">FontAwesome icon class (opsional)</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="background_color" class="form-label">Warna Background</label>
                                <input type="color" class="form-control form-control-color @error('background_color') is-invalid @enderror" 
                                       id="background_color" name="background_color" value="{{ old('background_color', '#4285f4') }}">
                                @error('background_color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Urutan</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', 1) }}" min="1">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                           {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.vision-mission-goal.index') }}" class="btn btn-secondary">
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
                <h6><i class="fas fa-eye me-2"></i>Preview</h6>
            </div>
            <div class="card-body">
                <div id="preview-card" class="card border-primary">
                    <div class="card-body" style="background: linear-gradient(135deg, #4285f415, #4285f405);">
                        <div class="d-flex align-items-start">
                            <div class="me-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" 
                                     style="width: 50px; height: 50px; background-color: #4285f4; color: white;">
                                    <i class="fas fa-eye" id="preview-icon"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-2" id="preview-title">Judul Item</h6>
                                <p class="mb-1" id="preview-content">Konten akan ditampilkan di sini...</p>
                                <small class="text-muted" id="preview-description"></small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-3">
                    <h6>Panduan Icon:</h6>
                    <ul class="small">
                        <li><code>fas fa-eye</code> - Mata (untuk Visi)</li>
                        <li><code>fas fa-check-circle</code> - Centang (untuk Misi)</li>
                        <li><code>fas fa-bullseye</code> - Target (untuk Tujuan)</li>
                        <li><code>fas fa-star</code> - Bintang</li>
                        <li><code>fas fa-heart</code> - Hati</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const titleInput = document.getElementById('title');
    const contentInput = document.getElementById('content');
    const descriptionInput = document.getElementById('description');
    const iconInput = document.getElementById('icon_class');
    const colorInput = document.getElementById('background_color');
    
    const previewCard = document.getElementById('preview-card');
    const previewIcon = document.getElementById('preview-icon');
    const previewTitle = document.getElementById('preview-title');
    const previewContent = document.getElementById('preview-content');
    const previewDescription = document.getElementById('preview-description');

    function updatePreview() {
        const type = typeSelect.value;
        const title = titleInput.value || 'Judul Item';
        const content = contentInput.value || 'Konten akan ditampilkan di sini...';
        const description = descriptionInput.value;
        const icon = iconInput.value || getDefaultIcon(type);
        const color = colorInput.value || getDefaultColor(type);

        // Update preview content
        previewTitle.textContent = title;
        previewContent.textContent = content;
        previewDescription.textContent = description;
        previewDescription.style.display = description ? 'block' : 'none';
        
        // Update icon
        previewIcon.className = icon;
        
        // Update colors
        const iconContainer = previewIcon.parentElement;
        iconContainer.style.backgroundColor = color;
        previewCard.style.background = `linear-gradient(135deg, ${color}15, ${color}05)`;
        
        // Update border color based on type
        const borderClass = type === 'vision' ? 'border-primary' : 
                           type === 'mission' ? 'border-success' : 'border-warning';
        previewCard.className = `card ${borderClass}`;
    }

    function getDefaultIcon(type) {
        switch(type) {
            case 'vision': return 'fas fa-eye';
            case 'mission': return 'fas fa-check-circle';
            case 'goal': return 'fas fa-bullseye';
            default: return 'fas fa-info-circle';
        }
    }

    function getDefaultColor(type) {
        switch(type) {
            case 'vision': return '#4285f4';
            case 'mission': return '#34a853';
            case 'goal': return '#fbbc04';
            default: return '#4285f4';
        }
    }

    // Set default values when type changes
    typeSelect.addEventListener('change', function() {
        if (!iconInput.value) {
            iconInput.value = getDefaultIcon(this.value);
        }
        colorInput.value = getDefaultColor(this.value);
        updatePreview();
    });

    // Update preview on input changes
    [titleInput, contentInput, descriptionInput, iconInput, colorInput].forEach(input => {
        input.addEventListener('input', updatePreview);
    });

    // Initial preview update
    updatePreview();
});
</script>
@endsection
