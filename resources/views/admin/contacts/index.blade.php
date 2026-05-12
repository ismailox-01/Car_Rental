@extends('layouts.admin')

@section('page_title', 'Customer Inquiries')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
    <!-- Filter Bar -->
    <div class="p-4 bg-white border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-dark">Recent Messages</h5>
        <div class="badge bg-primary rounded-pill px-3">{{ $contacts->total() }} total</div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr class="text-muted small text-uppercase fw-bold">
                    <th class="ps-4 border-0 py-3">Date</th>
                    <th class="border-0 py-3">Sender</th>
                    <th class="border-0 py-3">Inquiry Type</th>
                    <th class="border-0 py-3">Message Snippet</th>
                    <th class="border-0 py-3 text-center">Status</th>
                    <th class="pe-4 border-0 py-3 text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr class="{{ !$contact->is_read ? 'bg-light bg-opacity-50' : '' }}">
                        <td class="ps-4 small text-muted">{{ $contact->created_at->format('M d, Y H:i') }}</td>
                        <td>
                            <div class="fw-bold">{{ $contact->name }}</div>
                            <div class="text-muted small">{{ $contact->email }}</div>
                        </td>
                        <td>
                            <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary px-2 py-1 rounded small">{{ $contact->inquiry_type ?? 'General' }}</span>
                        </td>
                        <td>
                            <div class="text-truncate" style="max-width: 300px;" title="{{ $contact->message }}">
                                {{ $contact->message }}
                            </div>
                        </td>
                        <td class="text-center">
                            @if($contact->is_read)
                                <span class="badge bg-success rounded-pill px-3 small">READ</span>
                            @else
                                <span class="badge bg-primary animate-pulse rounded-pill px-3 small">NEW</span>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                            <div class="btn-group shadow-sm rounded-pill overflow-hidden bg-white border">
                                <button type="button" class="btn btn-white border-0 py-1" onclick="viewMessage('{{ addslashes($contact->name) }}', '{{ addslashes($contact->message) }}', {{ $contact->id }}, {{ $contact->is_read ? 'true' : 'false' }})" title="Read Message">
                                    <i class="bi bi-eye"></i>
                                </button>
                                
                                <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-white border-0 py-1 text-danger" title="Delete" onclick="return confirm('Delete this message permanently?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <i class="bi bi-envelope-x fs-1 text-muted mb-3 d-block"></i>
                            <p class="text-muted">No customer messages found.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center">
    {{ $contacts->links() }}
</div>

<!-- Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="senderName">Message Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <p class="text-muted" id="messageFullText" style="white-space: pre-wrap; line-height: 1.6;"></p>
            </div>
            <div class="modal-footer border-0 pt-0">
                <form id="markReadForm" method="POST" class="w-100">
                    @csrf
                    <input type="hidden" name="id" id="contactId">
                    <button type="submit" id="markReadBtn" class="btn btn-primary w-100 py-2 rounded-3 fw-bold">MARK AS READ</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: .7; }
    }
</style>

@endsection

@section('scripts')
<script>
    function viewMessage(name, text, id, isRead) {
        document.getElementById('senderName').innerText = 'From: ' + name;
        document.getElementById('messageFullText').innerText = text;
        
        const markReadBtn = document.getElementById('markReadBtn');
        const markReadForm = document.getElementById('markReadForm');
        
        if (isRead) {
            markReadBtn.style.display = 'none';
        } else {
            markReadBtn.style.display = 'block';
            markReadForm.action = `/admin/contacts/${id}/read`;
        }
        
        const modal = new bootstrap.Modal(document.getElementById('messageModal'));
        modal.show();
    }
</script>
@endsection
