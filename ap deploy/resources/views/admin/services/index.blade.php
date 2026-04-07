@extends('admin.layout-simple')

@section('title', 'Kelola Layanan - LAMDAKU Admin')
@section('page-title', 'Kelola Layanan')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-cogs me-2"></i>All Services</h5>
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add New Service
                </a>
            </div>
            <div class="card-body p-0">
                @if($services->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Sort Order</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $service)
                                <tr>
                                    <td>{{ $service->id }}</td>
                                    <td>
                                        <strong>{{ $service->title }}</strong>
                                        <br><small class="text-muted">{{ $service->slug }}</small>
                                    </td>
                                    <td>{{ Str::limit($service->description, 80) }}</td>
                                    <td>
                                        @if($service->price)
                                            <span class="badge bg-info">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($service->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $service->sort_order }}</span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.services.show', $service) }}" class="btn btn-outline-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-outline-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete" 
                                                        onclick="return confirm('Are you sure you want to delete this service?')">
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
                        <i class="fas fa-cogs fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No Services Found</h5>
                        <p class="text-muted">Get started by adding your first service.</p>
                        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add New Service
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection