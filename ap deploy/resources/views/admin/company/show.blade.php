@extends('admin.layout-simple')

@section('title', 'Detail Informasi Perusahaan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Detail Informasi Perusahaan</h4>
                <div class="page-title-right">
                    <a href="{{ route('admin.company.index') }}" class="btn btn-secondary">
                        <i class="mdi mdi-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('admin.company.edit', $companyInfo->id) }}" class="btn btn-warning ms-2">
                        <i class="mdi mdi-pencil"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center">
                                @if($companyInfo->logo)
                                    <img src="{{ $companyInfo->logo_url ?? asset('storage/logos/' . $companyInfo->logo) }}" 
                                         alt="Logo Perusahaan" 
                                         class="img-fluid rounded"
                                         style="max-width: 200px;">
                                @else
                                    <div class="bg-light p-4 rounded">
                                        <i class="mdi mdi-image mdi-48px text-muted"></i>
                                        <p class="text-muted mt-2">Tidak ada logo</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h4>{{ $companyInfo->company_name }}</h4>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong>Alamat:</strong>
                                        <p class="text-muted">{{ $companyInfo->address }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Telepon:</strong>
                                        <p class="text-muted">{{ $companyInfo->phone ?: '-' }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong>HP:</strong>
                                        <p class="text-muted">{{ $companyInfo->mobile ?: '-' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong>Email:</strong>
                                        <p class="text-muted">{{ $companyInfo->email ?: '-' }}</p>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Website:</strong>
                                        <p class="text-muted">
                                            @if($companyInfo->website)
                                                <a href="{{ $companyInfo->website }}" target="_blank">{{ $companyInfo->website }}</a>
                                            @else
                                                -
                                            @endif
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Status:</strong>
                                        <p>
                                            <span class="badge bg-{{ $companyInfo->is_active ? 'success' : 'secondary' }}">
                                                {{ $companyInfo->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @if($companyInfo->description)
                                <div class="mb-3">
                                    <strong>Deskripsi:</strong>
                                    <p class="text-muted">{{ $companyInfo->description }}</p>
                                </div>
                            @endif
                            
                            <div class="mb-3">
                                <strong>Dibuat:</strong>
                                <p class="text-muted">{{ $companyInfo->created_at ? \Carbon\Carbon::parse($companyInfo->created_at)->format('d M Y H:i') : '-' }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Terakhir diupdate:</strong>
                                <p class="text-muted">{{ $companyInfo->updated_at ? \Carbon\Carbon::parse($companyInfo->updated_at)->format('d M Y H:i') : '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
