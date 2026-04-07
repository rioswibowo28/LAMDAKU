@extends('admin.layout-simple')

@section('title', 'Detail Event')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">Detail Event</h1>
                    <p class="text-muted">Melihat event: {{ $event->title }}</p>
                </div>
                <div>
                    @if(session('admin_role') === 'admin' || $event->author_id === session('admin_id'))
                        <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-primary me-2">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                    @endif
                    <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- Main Content -->
                <div class="col-md-8">
                    <!-- Event Header -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h2 class="h4 mb-2">{{ $event->title }}</h2>
                                    <div class="d-flex gap-2 mb-2">
                                        <span class="badge {{ $event->status_badge_class }}">
                                            {{ $event->status_label }}
                                        </span>
                                        @if($event->is_featured)
                                            <span class="badge bg-warning text-dark">
                                                <i class="fas fa-star"></i> Featured
                                            </span>
                                        @endif
                                        @if($event->category)
                                            <span class="badge bg-secondary">{{ $event->category }}</span>
                                        @endif
                                        @if($event->event_type)
                                            <span class="badge bg-info">{{ ucfirst($event->event_type) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="text-muted small">
                                        <i class="fas fa-eye"></i> {{ number_format($event->view_count) }} views
                                    </div>
                                </div>
                            </div>

                            @if($event->featured_image)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $event->featured_image) }}" 
                                         alt="{{ $event->title }}" class="img-fluid rounded">
                                </div>
                            @endif

                            @if($event->description)
                                <div class="mb-3">
                                    <h5>Deskripsi</h5>
                                    <p class="text-muted">{{ $event->description }}</p>
                                </div>
                            @endif
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
                                    <h6><i class="fas fa-calendar-alt text-primary"></i> Waktu Event</h6>
                                    <p>
                                        <strong>Mulai:</strong> {{ $event->formatted_start_date }}<br>
                                        @if($event->end_date)
                                            <strong>Selesai:</strong> {{ $event->formatted_end_date }}<br>
                                        @endif
                                        @if($event->is_all_day)
                                            <span class="badge bg-secondary">Sepanjang Hari</span>
                                        @endif
                                        @if($event->duration)
                                            <br><small class="text-muted">Durasi: {{ $event->duration }}</small>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <h6><i class="fas fa-map-marker-alt text-danger"></i> Lokasi</h6>
                                    <p>
                                        <strong>{{ $event->location }}</strong><br>
                                        @if($event->address)
                                            <small class="text-muted">{{ $event->address }}</small>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            @if($event->requires_registration)
                                <hr>
                                <h6><i class="fas fa-user-check text-success"></i> Informasi Pendaftaran</h6>
                                <div class="row">
                                    @if($event->max_participants)
                                        <div class="col-md-4">
                                            <p><strong>Maks Peserta:</strong> {{ number_format($event->max_participants) }}</p>
                                        </div>
                                    @endif
                                    @if($event->registration_fee > 0)
                                        <div class="col-md-4">
                                            <p><strong>Biaya:</strong> Rp {{ number_format($event->registration_fee) }}</p>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <p><strong>Biaya:</strong> Gratis</p>
                                        </div>
                                    @endif
                                    @if($event->registration_deadline)
                                        <div class="col-md-4">
                                            <p><strong>Batas Daftar:</strong> {{ $event->formatted_registration_deadline }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @if($event->contact_person || $event->contact_email || $event->contact_phone || $event->website)
                                <hr>
                                <h6><i class="fas fa-address-book text-info"></i> Informasi Kontak</h6>
                                <div class="row">
                                    @if($event->contact_person)
                                        <div class="col-md-6">
                                            <p><strong>Contact Person:</strong> {{ $event->contact_person }}</p>
                                        </div>
                                    @endif
                                    @if($event->contact_email)
                                        <div class="col-md-6">
                                            <p><strong>Email:</strong> 
                                                <a href="mailto:{{ $event->contact_email }}">{{ $event->contact_email }}</a>
                                            </p>
                                        </div>
                                    @endif
                                    @if($event->contact_phone)
                                        <div class="col-md-6">
                                            <p><strong>Telepon:</strong> 
                                                <a href="tel:{{ $event->contact_phone }}">{{ $event->contact_phone }}</a>
                                            </p>
                                        </div>
                                    @endif
                                    @if($event->website)
                                        <div class="col-md-6">
                                            <p><strong>Website:</strong> 
                                                <a href="{{ $event->website }}" target="_blank">{{ $event->website }}</a>
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Event Content -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Konten Event</h5>
                        </div>
                        <div class="card-body">
                            <div class="content">
                                {!! nl2br(e($event->content)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Gallery -->
                    @if($event->gallery && count($event->gallery) > 0)
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Galeri</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($event->gallery as $image)
                                        <div class="col-md-4 mb-3">
                                            <a href="{{ asset('storage/' . $image) }}" data-bs-toggle="modal" data-bs-target="#imageModal" 
                                               onclick="showImage('{{ asset('storage/' . $image) }}')">
                                                <img src="{{ asset('storage/' . $image) }}" alt="Gallery" 
                                                     class="img-fluid rounded" style="height: 150px; object-fit: cover; cursor: pointer;">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <!-- Event Info -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Informasi Event</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        <span class="badge {{ $event->status_badge_class }}">
                                            {{ $event->status_label }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Penulis:</strong></td>
                                    <td>{{ $event->author->name }} ({{ $event->author->role }})</td>
                                </tr>
                                @if($event->category)
                                    <tr>
                                        <td><strong>Kategori:</strong></td>
                                        <td>{{ $event->category }}</td>
                                    </tr>
                                @endif
                                @if($event->event_type)
                                    <tr>
                                        <td><strong>Tipe:</strong></td>
                                        <td>{{ ucfirst($event->event_type) }}</td>
                                    </tr>
                                @endif
                                @if($event->tags && count($event->tags) > 0)
                                    <tr>
                                        <td><strong>Tag:</strong></td>
                                        <td>
                                            @foreach($event->tags as $tag)
                                                <span class="badge bg-light text-dark me-1">{{ $tag }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td><strong>Dibuat:</strong></td>
                                    <td>{{ $event->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                @if($event->published_at)
                                    <tr>
                                        <td><strong>Dipublish:</strong></td>
                                        <td>{{ $event->published_at->format('d M Y H:i') }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td><strong>Views:</strong></td>
                                    <td>{{ number_format($event->view_count) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    @if(session('admin_role') === 'admin' || $event->author_id === session('admin_id'))
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Aksi Cepat</h5>
                            </div>
                            <div class="card-body">
                                <!-- Toggle Featured -->
                                <form method="POST" action="{{ route('admin.events.toggle-featured', $event) }}" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $event->is_featured ? 'btn-warning' : 'btn-outline-warning' }} mb-2 w-100">
                                        <i class="fas fa-star me-1"></i>
                                        {{ $event->is_featured ? 'Remove Featured' : 'Set Featured' }}
                                    </button>
                                </form>

                                <!-- Change Status -->
                                <div class="dropdown mb-2">
                                    <button class="btn btn-sm btn-outline-primary dropdown-toggle w-100" type="button" 
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-sync me-1"></i>Ubah Status
                                    </button>
                                    <ul class="dropdown-menu w-100">
                                        @if($event->status !== 'published')
                                            <li>
                                                <form method="POST" action="{{ route('admin.events.change-status', $event) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="published">
                                                    <button type="submit" class="dropdown-item">Publish</button>
                                                </form>
                                            </li>
                                        @endif
                                        @if($event->status !== 'draft')
                                            <li>
                                                <form method="POST" action="{{ route('admin.events.change-status', $event) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="draft">
                                                    <button type="submit" class="dropdown-item">Set Draft</button>
                                                </form>
                                            </li>
                                        @endif
                                        @if($event->status !== 'cancelled')
                                            <li>
                                                <form method="POST" action="{{ route('admin.events.change-status', $event) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button type="submit" class="dropdown-item">Cancel</button>
                                                </form>
                                            </li>
                                        @endif
                                        @if($event->status !== 'completed')
                                            <li>
                                                <form method="POST" action="{{ route('admin.events.change-status', $event) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="completed">
                                                    <button type="submit" class="dropdown-item">Mark Complete</button>
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                                <!-- Delete Event -->
                                <button type="button" class="btn btn-sm btn-outline-danger w-100" 
                                        onclick="deleteEvent({{ $event->id }}, '{{ $event->title }}')">
                                    <i class="fas fa-trash me-1"></i>Hapus Event
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- SEO Preview -->
                    @if($event->meta_title || $event->meta_description)
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">SEO Preview</h5>
                            </div>
                            <div class="card-body">
                                <div class="seo-preview">
                                    <h6 class="text-primary">{{ $event->meta_title ?: $event->title }}</h6>
                                    <small class="text-success">{{ url('/events/' . $event->slug) }}</small>
                                    <p class="mb-0 small text-muted">
                                        {{ $event->meta_description ?: Str::limit($event->description, 160) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Gallery Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modal-image" src="" alt="Gallery" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus event <strong id="event-title"></strong>?</p>
                <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="delete-form" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Event</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Show image in modal
function showImage(src) {
    document.getElementById('modal-image').src = src;
}

// Delete event
function deleteEvent(eventId, eventTitle) {
    document.getElementById('event-title').textContent = eventTitle;
    document.getElementById('delete-form').action = '/admin/events/' + eventId;
    
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection
