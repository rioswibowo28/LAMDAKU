@extends('admin.layout-simple')

@section('title', 'Pesan Kontak - LAMDAKU Admin')
@section('page-title', 'Pesan Kontak')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-envelope me-2"></i>Contact Messages</h5>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.contacts.index') }}" 
                       class="btn btn-sm {{ !request()->routeIs('admin.contacts.unread') ? 'btn-primary' : 'btn-outline-primary' }}">
                        <i class="fas fa-list me-1"></i>All Messages
                    </a>
                    <a href="{{ route('admin.contacts.unread') }}" 
                       class="btn btn-sm {{ request()->routeIs('admin.contacts.unread') ? 'btn-warning' : 'btn-outline-warning' }}">
                        <i class="fas fa-envelope me-1"></i>Unread 
                        @if(App\Models\Contact::unread()->count() > 0)
                            <span class="badge bg-danger ms-1">{{ App\Models\Contact::unread()->count() }}</span>
                        @endif
                    </a>
                </div>
            </div>            <div class="card-body p-0">
                @if($contacts->count() > 0)
                    <form id="bulk-actions-form">
                        @csrf
                        <div class="p-3 border-bottom">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="select-all">
                                        <label class="form-check-label" for="select-all">
                                            Select All
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button type="button" id="bulk-delete" class="btn btn-danger btn-sm" disabled>
                                        <i class="fas fa-trash me-1"></i>Delete Selected
                                    </button>
                                    <button type="button" id="bulk-mark-read" class="btn btn-success btn-sm" disabled>
                                        <i class="fas fa-check me-1"></i>Mark as Read
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="30">#</th>
                                    <th>Name</th>
                                    <th>Contact Info</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $contact)
                                <tr class="{{ !$contact->is_read ? 'table-warning' : '' }}">
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input contact-checkbox" type="checkbox" 
                                                   value="{{ $contact->id }}" id="contact-{{ $contact->id }}">
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{ $contact->name }}</strong>
                                        @if($contact->company)
                                            <br><small class="text-muted">{{ $contact->company }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="small">
                                            <i class="fas fa-envelope text-muted me-1"></i>{{ $contact->email }}
                                            @if($contact->phone)
                                                <br><i class="fas fa-phone text-muted me-1"></i>{{ $contact->phone }}
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ Str::limit($contact->subject, 30) }}</td>
                                    <td>{{ Str::limit($contact->message, 50) }}</td>
                                    <td>
                                        {{ $contact->created_at->format('M d, Y') }}
                                        <br><small class="text-muted">{{ $contact->created_at->format('H:i') }}</small>
                                    </td>
                                    <td>
                                        @if($contact->is_read)
                                            <span class="badge bg-success">Read</span>
                                            @if($contact->read_at)
                                                <br><small class="text-muted">{{ $contact->read_at->format('M d, H:i') }}</small>
                                            @endif
                                        @else
                                            <span class="badge bg-warning">Unread</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('admin.contacts.show', $contact) }}" 
                                               class="btn btn-outline-info" title="View Message">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if(!$contact->is_read)
                                                <form action="{{ route('admin.contacts.mark-as-read', $contact) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-outline-success" title="Mark as Read">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete" 
                                                        onclick="return confirm('Are you sure you want to delete this message?')">
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
                    
                    <!-- Pagination -->
                    @if($contacts->hasPages())
                        <div class="card-footer">
                            {{ $contacts->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No Messages Found</h5>
                        @if(request()->routeIs('admin.contacts.unread'))
                            <p class="text-muted">All messages have been read!</p>
                            <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary">
                                <i class="fas fa-list me-2"></i>View All Messages
                            </a>                        @else
                            <p class="text-muted">No contact messages yet.</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($contacts->count() > 0)
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select-all');
    const contactCheckboxes = document.querySelectorAll('.contact-checkbox');
    const bulkDeleteBtn = document.getElementById('bulk-delete');
    const bulkMarkReadBtn = document.getElementById('bulk-mark-read');

    // Check if required elements exist
    if (!selectAllCheckbox || !bulkDeleteBtn || !bulkMarkReadBtn) {
        console.warn('Some required elements not found for bulk operations');
        return;
    }

    function updateBulkButtons() {
        const selectedCheckboxes = document.querySelectorAll('.contact-checkbox:checked');
        const hasSelection = selectedCheckboxes.length > 0;
        
        if (bulkDeleteBtn) bulkDeleteBtn.disabled = !hasSelection;
        if (bulkMarkReadBtn) bulkMarkReadBtn.disabled = !hasSelection;
    }

    // Select all functionality
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            contactCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkButtons();
        });
    }

    // Individual checkbox changes
    contactCheckboxes.forEach(checkbox => {
        if (checkbox) {
            checkbox.addEventListener('change', function() {
                const allChecked = Array.from(contactCheckboxes).every(cb => cb.checked);
                const noneChecked = Array.from(contactCheckboxes).every(cb => !cb.checked);
                
                if (selectAllCheckbox) {
                    selectAllCheckbox.checked = allChecked;
                    selectAllCheckbox.indeterminate = !allChecked && !noneChecked;
                }
                
                updateBulkButtons();
            });
        }
    });

    // Bulk delete
    if (bulkDeleteBtn) {
        bulkDeleteBtn.addEventListener('click', function() {
            const selectedIds = Array.from(document.querySelectorAll('.contact-checkbox:checked'))
                .map(cb => cb.value);
            
            if (selectedIds.length === 0) return;
            
            if (confirm(`Are you sure you want to delete ${selectedIds.length} selected message(s)?`)) {
                // Create forms for each selected contact and submit them
                selectedIds.forEach(id => {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/contacts/${id}`;
                    form.style.display = 'none';
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    const metaToken = document.querySelector('meta[name="csrf-token"]');
                    csrfToken.value = metaToken ? metaToken.content : '';
                    
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    
                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                });
            }
        });
    }

    // Bulk mark as read
    if (bulkMarkReadBtn) {
        bulkMarkReadBtn.addEventListener('click', function() {
            const selectedIds = Array.from(document.querySelectorAll('.contact-checkbox:checked'))
                .map(cb => cb.value);
            
            if (selectedIds.length === 0) return;
            
            if (confirm(`Mark ${selectedIds.length} selected message(s) as read?`)) {
                // Submit each mark as read form
                selectedIds.forEach(id => {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/contacts/${id}/mark-as-read`;
                    form.style.display = 'none';
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    const metaToken = document.querySelector('meta[name="csrf-token"]');
                    csrfToken.value = metaToken ? metaToken.content : '';
                    
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'PATCH';
                    
                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                });
            }
        });
    }
});
</script>
@endif
@endsection
