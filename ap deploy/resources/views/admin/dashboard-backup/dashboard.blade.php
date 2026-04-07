@extends('admin.layout')

@section('page-title', 'Dashboard')

@section('scripts')
<script>
    console.log('Dashboard view rendered successfully');
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Dashboard DOM loaded');
        console.log('Dashboard stats:', {
            'pages': '{{ $stats["pages"] }}',
            'services': '{{ $stats["services"] }}',
            'timelines': '{{ $stats["timelines"] }}',
            'contacts': '{{ $stats["contacts"] }}',
            'unread_contacts': '{{ $stats["unread_contacts"] }}'
        });
        
        // Add notification to show user the dashboard is loaded
        if (typeof showNotification === 'function') {
            showNotification('Dashboard berhasil dimuat', 'success');
        }
    });
</script>
@endsection

@section('content')
<div class="container-fluid p-0">
    <div class="row g-4">
        <!-- Statistics Cards -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card primary">
                <div class="stats-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h3>{{ $stats['pages'] }}</h3>
                <p>Total Halaman</p>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card primary">
                <div class="stats-icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <h3>{{ $stats['services'] }}</h3>
                <p>Total Layanan</p>
            </div>
        </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card success">
            <div class="stats-icon">
                <i class="fas fa-history"></i>
            </div>
            <h3>{{ $stats['timelines'] }}</h3>
            <p>Timeline Events</p>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card warning">
            <div class="stats-icon">
                <i class="fas fa-envelope"></i>
            </div>
            <h3>{{ $stats['contacts'] }}</h3>
            <p>Total Contacts</p>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stats-card danger">
            <div class="stats-icon">
                <i class="fas fa-bell"></i>
            </div>
            <h3>{{ $stats['unread_contacts'] }}</h3>
            <p>Unread Messages</p>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Contacts -->
    <div class="col-lg-8 mb-4">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-envelope me-2"></i>Recent Contact Messages</h5>
                <a href="{{ route('admin.contacts.index') }}" class="btn btn-sm btn-light">
                    <i class="fas fa-eye"></i> View All
                </a>
            </div>
            <div class="card-body p-0">
                @if($recent_contacts->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_contacts as $contact)
                                <tr class="{{ !$contact->is_read ? 'table-warning' : '' }}">
                                    <td>
                                        <strong>{{ $contact->name }}</strong>
                                        @if($contact->company)
                                            <br><small class="text-muted">{{ $contact->company }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ Str::limit($contact->subject, 30) }}</td>
                                    <td>{{ $contact->created_at->format('M d, Y') }}</td>
                                    <td>
                                        @if($contact->is_read)
                                            <span class="badge bg-success">Read</span>
                                        @else
                                            <span class="badge bg-warning">Unread</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No contact messages yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="col-lg-4 mb-4">
        <div class="content-card">
            <div class="card-header">
                <h5><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
            </div>            <div class="card-body">
                <div class="d-grid gap-3">
                    <a href="{{ route('admin.pages.create') }}" class="btn btn-info">
                        <i class="fas fa-plus me-2"></i>Add New Page
                    </a>
                    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add New Service
                    </a>
                    <a href="{{ route('admin.timelines.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Add Timeline Event
                    </a>
                    <a href="{{ route('admin.contacts.unread') }}" class="btn btn-warning">
                        <i class="fas fa-envelope-open me-2"></i>View Unread Messages
                    </a>
                    <a href="http://localhost:3000" target="_blank" class="btn btn-secondary">
                        <i class="fas fa-external-link-alt me-2"></i>Visit Website
                    </a>
                </div>
            </div>
        </div>
        
        <!-- System Info -->
        <div class="content-card mt-4">
            <div class="card-header">
                <h5><i class="fas fa-info-circle me-2"></i>System Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <td><strong>Laravel Version:</strong></td>
                        <td>{{ app()->version() }}</td>
                    </tr>
                    <tr>
                        <td><strong>PHP Version:</strong></td>
                        <td>{{ phpversion() }}</td>
                    </tr>
                    <tr>
                        <td><strong>Environment:</strong></td>
                        <td>
                            <span class="badge bg-{{ app()->environment() == 'production' ? 'success' : 'warning' }}">
                                {{ ucfirst(app()->environment()) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Last Updated:</strong></td>
                        <td>{{ now()->format('M d, Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection