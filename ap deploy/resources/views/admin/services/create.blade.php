@extends('admin.layout-simple')

@section('title', 'Tambah Layanan - LAMDAKU Admin')
@section('page-title', 'Tambah Layanan Baru')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="content-card">
            <div class="card-header">
                <h5><i class="fas fa-plus me-2"></i>Add New Service</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title" class="form-label">Service Title *</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="icon" class="form-label">Icon</label>
                                <select class="form-select @error('icon') is-invalid @enderror" id="icon" name="icon">
                                    <option value="">Select Icon</option>
                                    <option value="hospital" {{ old('icon') == 'hospital' ? 'selected' : '' }}>Hospital</option>
                                    <option value="flask" {{ old('icon') == 'flask' ? 'selected' : '' }}>Flask</option>
                                    <option value="heartbeat" {{ old('icon') == 'heartbeat' ? 'selected' : '' }}>Heartbeat</option>
                                    <option value="certificate" {{ old('icon') == 'certificate' ? 'selected' : '' }}>Certificate</option>
                                    <option value="users" {{ old('icon') == 'users' ? 'selected' : '' }}>Users</option>
                                    <option value="shield" {{ old('icon') == 'shield' ? 'selected' : '' }}>Shield</option>
                                </select>
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Short Description *</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Brief description for service cards (recommended: 100-150 characters)</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Full Content *</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="8" required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Detailed service description</div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price (IDR)</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" value="{{ old('price') }}" min="0" step="1000">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Leave empty if price varies</div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Sort Order</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Lower numbers appear first</div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                           {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active (visible on website)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Service
                        </button>
                        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection