@extends('admin.layout-coreui')

@section('title', 'Pesan Kontak - LAMDAKU Admin')
@section('page-title', 'Pesan Kontak')

@section('styles')
<style>
.modern-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.modern-card-header {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 25px;
    border: none;
}

.modern-btn {
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: white;
    border-radius: 12px;
    padding: 10px 15px;
    font-weight: 500;
    transition: all 0.3s ease;
    text-decoration: none;
    margin: 0 2px;
}

.modern-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    color: white;
    transform: translateY(-2px);
}

.modern-btn.active {
    background: rgba(255, 255, 255, 0.9);
    color: #667eea;
}

.modern-table th {
    background: rgba(102, 126, 234, 0.05);
    color: #64748b;
    font-weight: 600;
    border: none;
    padding: 15px 20px;
}

.modern-table td {
    padding: 15px 20px;
    border: none;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    color: #334155;
}

.modern-table tr:hover {
    background: rgba(102, 126, 234, 0.02);
}

.modern-table tr.unread {
    background: rgba(245, 158, 11, 0.02);
    border-left: 4px solid #f59e0b;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.status-badge.unread {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.status-badge.read {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.action-btn {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
    border-radius: 8px;
    color: white;
    padding: 8px 12px;
    margin: 0 2px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.action-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    color: white;
}

.action-btn.warning {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.action-btn.danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

.action-btn.success {
    background: linear-gradient(135deg, #22c55e, #16a34a);
}
</style>
@endsection

@section('content')
<div style="padding: 30px;">
    <div class="modern-card">
        <div class="modern-card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Contact Messages</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.contacts.index') }}" 
                   class="modern-btn {{ !request()->routeIs('admin.contacts.unread') ? 'active' : '' }}">
                    <i class="fas fa-list me-1"></i>All Messages
                </a>
                <a href="{{ route('admin.contacts.unread') }}" 
                   class="modern-btn {{ request()->routeIs('admin.contacts.unread') ? 'active' : '' }}">
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
                    @if(method_exists($contacts, 'hasPages') && $contacts->hasPages())
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
                            </a>
                        @else
                            <p class="text-muted">No contact messages yet.</p>
                        @endif
                    </div>                @endif
            </div>
        </div>
    </div>
</div>

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
    }    // Individual checkbox changes
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
@endsection
