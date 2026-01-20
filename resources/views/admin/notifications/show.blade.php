@extends('layouts.admin')

@section('title', 'View Notification')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>View Notification</h1>
    </div>
    <div class="col-md-6 text-md-end">
        <a onclick="history.back()" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back 
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Notification Details</h5>
            </div>
            <div class="card-body">
                <table class="table" id="dataTable-notification-details">
                    <tr>
                        <th>Title:</th>
                        <td>{{ $notification->title }}</td>
                    </tr>
                    <tr>
                        <th>Recipient Type:</th>
                        <td>{!! $notification->recipient_type_badge !!}</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>{!! $notification->status_badge !!}</td>
                    </tr>
                    <tr>
                        <th>Created At:</th>
                        <td>{{ $notification->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    @if($notification->is_sent)
                    <tr>
                        <th>Sent At:</th>
                        <td>{{ $notification->sent_at->format('M d, Y H:i') }}</td>
                    </tr>
                    @endif
                </table>
                
                <div class="mt-3">
                    <form action="{{ route('notifications.destroy', $notification) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this notification?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Notification Message</h5>
            </div>
            <div class="card-body">
                <div class="notification-content border p-4">
                    {!! $notification->message !!}
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Recipients</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable-notification-recipients">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Read At</th>
                            </tr>
                        </thead>
                        <tbody>
    @forelse($notification->recipients as $recipient)
    <tr>
        <td>{{ $loop->iteration }}</td>
        
        {{-- Employee --}}
        <td>
            @if($recipient->employee)
                <a href="{{ route('employees.show', $recipient->employee->id) }}">
                    {{ $recipient->employee->name }}
                </a>
            @else
                <span class="text-muted">Unknown Employee</span>
            @endif
        </td>

        {{-- Email --}}
        <td>
            @if($recipient->employee && $recipient->employee->email)
                <span class="text-success">
                    <i class="fas fa-envelope"></i> {{ $recipient->employee->email }}
                </span>
            @else
                <span class="text-muted">
                    <i class="fas fa-envelope-slash"></i> No email
                </span>
            @endif
        </td>

        {{-- Department --}}
        <td>
            {{ optional(optional($recipient->employee)->department)->name ?? 'N/A' }}
        </td>

        {{-- Status --}}
        <td>{!! $recipient->read_status_badge !!}</td>

        {{-- Read At --}}
        <td>{{ $recipient->read_at ? $recipient->read_at->format('M d, Y H:i') : 'Not read yet' }}</td>
    </tr>
    @empty
    <tr>
        <td colspan="6" class="text-center">No recipients found.</td>
    </tr>
    @endforelse
</tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection