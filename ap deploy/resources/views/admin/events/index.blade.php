@extends('admin.layout-simple')

@section('title', 'Manajemen Event')

@section('content')
<div class="container-fluid">
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $events->count() }}</div>
                        <div>Total Events</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.events.create') }}">Add New</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-success">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $events->where('status', 'published')->count() }}</div>
                        <div>Published</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.events.index', ['status' => 'published']) }}">View Published</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $events->where('status', 'draft')->count() }}</div>
                        <div>Drafts</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.events.index', ['status' => 'draft']) }}">View Drafts</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6 col-lg-3">
            <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fs-4 fw-semibold">{{ $events->where('event_date', '>=', now())->count() }}</div>
                        <div>Upcoming</div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('admin.events.index', ['upcoming' => '1']) }}">View Upcoming</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-calendar-alt me-2"></i>Events Management
                        </h4>
                        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add New Event
                        </a>
                    </div>
                </div>
                
                <!-- Filters -->
                <div class="card-body border-bottom">
                    <form method="GET" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Search Events</label>
                            <input type="text" name="search" class="form-control" placeholder="Search by title or description..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select">
                                <option value="">All Categories</option>
                                @if(isset($categories))
                                    @foreach($categories as $category)
                                        <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>
                                            {{ ucfirst($category) }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Date Range</label>
                            <select name="date_range" class="form-select">
                                <option value="">All Dates</option>
                                <option value="upcoming" {{ request('date_range') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                                <option value="past" {{ request('date_range') === 'past' ? 'selected' : '' }}>Past</option>
                                <option value="today" {{ request('date_range') === 'today' ? 'selected' : '' }}>Today</option>
                                <option value="this_week" {{ request('date_range') === 'this_week' ? 'selected' : '' }}>This Week</option>
                                <option value="this_month" {{ request('date_range') === 'this_month' ? 'selected' : '' }}>This Month</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-outline-primary">Filter</button>
                                <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body p-0">
                    @if($events->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Event</th>
                                        <th>Category</th>
                                        <th>Date & Time</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Participants</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($events as $event)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($event->featured_image)
                                                    <img src="{{ asset('storage/' . $event->featured_image) }}" alt="Event Image" class="me-3" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                                                @else
                                                    <div class="me-3 bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 40px; border-radius: 4px;">
                                                        <i class="fas fa-calendar-alt text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="fw-semibold">{{ Str::limit($event->title, 40) }}</div>
                                                    <small class="text-muted">{{ Str::limit(strip_tags($event->description), 50) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($event->category)
                                                <span class="badge bg-secondary">{{ ucfirst($event->category) }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="small">
                                                <div class="fw-semibold">{{ $event->event_date ? $event->event_date->format('M d, Y') : 'TBD' }}</div>
                                                @if($event->event_time)
                                                    <div class="text-muted">{{ $event->event_time }}</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="small">
                                                @if($event->location)
                                                    <i class="fas fa-map-marker-alt text-muted me-1"></i>
                                                    {{ Str::limit($event->location, 30) }}
                                                @else
                                                    <span class="text-muted">No location</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'draft' => 'secondary',
                                                    'published' => 'success',
                                                    'cancelled' => 'danger',
                                                    'completed' => 'info'
                                                ];
                                                $statusColor = $statusColors[$event->status] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $statusColor }}">
                                                {{ ucfirst($event->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="small">
                                                @if(isset($event->participants_count))
                                                    <i class="fas fa-users text-muted me-1"></i>
                                                    {{ $event->participants_count ?? 0 }}
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.events.show', $event) }}" class="btn btn-outline-info" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-outline-warning" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger" title="Delete" 
                                                            onclick="return confirm('Are you sure you want to delete this event?')">
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
                        
                        @if(method_exists($events, 'hasPages') && $events->hasPages())
                            <div class="card-footer">
                                {{ $events->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-alt fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">No Events Found</h5>
                            <p class="text-muted">
                                @if(request()->hasAny(['search', 'status', 'category', 'date_range']))
                                    No events match your search criteria.
                                @else
                                    Start by creating your first event.
                                @endif
                            </p>
                            @if(!request()->hasAny(['search', 'status', 'category', 'date_range']))
                                <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Create First Event
                                </a>
                            @else
                                <a href="{{ route('admin.events.index') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-list me-2"></i>View All Events
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
