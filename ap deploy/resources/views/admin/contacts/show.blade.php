@extends('admin.layout-simple')

@section('title', 'Detail Kontak - LAMDAKU Admin')
@section('page-title', 'Detail Pesan Kontak')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-envelope me-2"></i>Message from {{ $contact->name }}</h5>
                <div class="btn-group btn-group-sm">
                    @if(!$contact->is_read)
                        <form action="{{ route('admin.contacts.mark-as-read', $contact) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check me-1"></i>Mark as Read
                            </button>
                        </form>
                    @endif
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" 
                                onclick="return confirm('Are you sure you want to delete this message?')">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Contact Information</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>{{ $contact->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                            </tr>
                            @if($contact->phone)
                            <tr>
                                <td><strong>Phone:</strong></td>
                                <td><a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></td>
                            </tr>
                            @endif
                            @if($contact->company)
                            <tr>
                                <td><strong>Company:</strong></td>
                                <td>{{ $contact->company }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Message Details</h6>
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td><strong>Subject:</strong></td>
                                <td>{{ $contact->subject }}</td>
                            </tr>
                            <tr>
                                <td><strong>Received:</strong></td>
                                <td>{{ $contact->created_at->format('F d, Y \a\t H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    @if($contact->is_read)
                                        <span class="badge bg-success">Read</span>
                                        @if($contact->read_at)
                                            <br><small class="text-muted">Read on {{ $contact->read_at->format('M d, Y \a\t H:i') }}</small>
                                        @endif
                                    @else
                                        <span class="badge bg-warning">Unread</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <hr>
                
                <div class="mb-4">
                    <h6 class="text-muted mb-3">Message Content</h6>
                    <div class="p-3 bg-light rounded">
                        <p class="mb-0" style="white-space: pre-wrap;">{{ $contact->message }}</p>
                    </div>
                </div>
                
                <hr>
                
                <div class="d-flex gap-2">
                    <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="btn btn-primary">
                        <i class="fas fa-reply me-2"></i>Reply via Email
                    </a>
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Messages
                    </a>
                    @if(App\Models\Contact::unread()->count() > 0)
                        <a href="{{ route('admin.contacts.unread') }}" class="btn btn-warning">
                            <i class="fas fa-envelope me-2"></i>View Unread Messages
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
