@extends('admin.layout-simple')

@section('title', 'Informasi Perusahaan')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="cil-building me-2"></i>Company Information
                        </h4>
                        @if(!$companyInfo)
                            <a href="{{ route('admin.company.create') }}" class="btn btn-primary">
                                <i class="cil-plus me-2"></i>Add Company Info
                            </a>
                        @endif
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="cil-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card-body">
                    @if($companyInfo)
                        <div class="row">
                            <div class="col-md-3">
                                <div class="text-center">
                                    @if($companyInfo->logo)
                                        <div class="mb-3">
                                            <img src="{{ $companyInfo->logo_url ?? asset('storage/logos/' . $companyInfo->logo) }}?v={{ time() }}" 
                                                 alt="Company Logo" 
                                                 class="img-fluid rounded"
                                                 style="max-width: 200px; max-height: 200px; object-fit: contain;"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <div style="display:none;" class="alert alert-warning">
                                                <i class="cil-warning me-2"></i>Logo cannot be loaded
                                                <br><small>{{ $companyInfo->logo }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="bg-light p-4 rounded mb-3">
                                            <i class="cil-image icon-3xl text-muted mb-3"></i>
                                            <p class="text-muted">No logo uploaded</p>
                                        </div>
                                    @endif
                                    
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin.company.edit', $companyInfo->id) }}" class="btn btn-warning">
                                            <i class="cil-pencil me-2"></i>Edit
                                        </a>
                                        <a href="{{ route('admin.company.show', $companyInfo->id) }}" class="btn btn-info">
                                            <i class="cil-magnifying-glass me-2"></i>View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <h3 class="mb-4">{{ $companyInfo->company_name }}</h3>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">ADDRESS</label>
                                            <p class="fw-semibold">{{ $companyInfo->address }}</p>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">PHONE</label>
                                            <p class="fw-semibold">
                                                @if($companyInfo->phone)
                                                    <a href="tel:{{ $companyInfo->phone }}" class="text-decoration-none">
                                                        <i class="cil-phone me-1"></i>{{ $companyInfo->phone }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </p>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">MOBILE</label>
                                            <p class="fw-semibold">
                                                @if($companyInfo->mobile)
                                                    <a href="tel:{{ $companyInfo->mobile }}" class="text-decoration-none">
                                                        <i class="cil-mobile me-1"></i>{{ $companyInfo->mobile }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">EMAIL</label>
                                            <p class="fw-semibold">
                                                @if($companyInfo->email)
                                                    <a href="mailto:{{ $companyInfo->email }}" class="text-decoration-none">
                                                        <i class="cil-envelope-closed me-1"></i>{{ $companyInfo->email }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </p>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">WEBSITE</label>
                                            <p class="fw-semibold">
                                                @if($companyInfo->website)
                                                    <a href="{{ $companyInfo->website }}" target="_blank" class="text-decoration-none">
                                                        <i class="cil-external-link me-1"></i>{{ $companyInfo->website }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </p>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">STATUS</label>
                                            <p>
                                                <span class="badge bg-{{ $companyInfo->is_active ? 'success' : 'secondary' }}">
                                                    {{ $companyInfo->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                @if($companyInfo->description)
                                    <div class="mt-4">
                                        <label class="form-label text-muted small">DESCRIPTION</label>
                                        <div class="bg-light p-3 rounded">
                                            <p class="mb-0">{{ $companyInfo->description }}</p>
                                        </div>
                                    </div>                                @endif
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="cil-building icon-3xl text-muted mb-3"></i>
                            <h5 class="text-muted">No Company Information</h5>
                            <p class="text-muted">Add company information to manage your company profile.</p>
                            <a href="{{ route('admin.company.create') }}" class="btn btn-primary">
                                <i class="cil-plus me-2"></i>Add Company Information
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
