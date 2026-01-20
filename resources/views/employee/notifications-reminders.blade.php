@extends('layouts.employee')

@section('title', 'Notifications and Reminders')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-1"><i class="fas fa-bell text-primary me-2"></i>Notifications & Reminders</h2>
                            <p class="text-muted mb-0">Stay updated with your notifications and reminders</p>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-outline-primary btn-sm" id="refresh-data">
                                <i class="fas fa-sync-alt me-1"></i>Refresh
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Notifications Section -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-bell me-2 text-info"></i>Notifications</h5>
                    <span class="badge bg-info">{{ $notifications->total() }} Total</span>
                </div>
                <div class="card-body p-0">
                    @forelse($notifications as $notification)
                        @php
                            $recipient = $notification->recipients->where('employee_id', session('employee_id'))->first();
                            $isRead = $recipient ? $recipient->is_read : false;
                        @endphp
                        <div class="border-bottom p-3 {{ $isRead ? 'bg-light' : 'bg-white' }}">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 {{ $isRead ? 'text-muted' : 'text-dark' }}">
                                        {{ $notification->title }}
                                        @if(!$isRead)
                                            <span class="badge bg-primary ms-2">New</span>
                                        @endif
                                    </h6>
                                    <p class="mb-1 {{ $isRead ? 'text-muted' : 'text-secondary' }}">{{ $notification->message }}</p>
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $notification->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <div class="text-end">
                                    @if($notification->recipient_type === 'all')
                                        <span class="badge bg-success">All</span>
                                    @elseif($notification->recipient_type === 'department')
                                        <span class="badge bg-warning">Department</span>
                                    @else
                                        <span class="badge bg-info">Personal</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-bell-slash text-muted mb-3" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">No notifications found</h5>
                            <p class="text-muted">You're all caught up!</p>
                        </div>
                    @endforelse
                </div>
                @if($notifications->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            {{ $notifications->appends(request()->query())->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Reminders Section -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-calendar-check me-2 text-warning"></i>Reminders</h5>
                    <span class="badge bg-warning">{{ $reminders->total() }} Total</span>
                </div>
                <div class="card-body p-0">
                    @forelse($reminders as $reminder)
                        @php
                            $recipient = $reminder->recipients->where('employee_id', session('employee_id'))->first();
                            $isRead = $recipient ? $recipient->is_read : false;
                            $isOverdue = $reminder->due_date->isPast() && !$reminder->is_completed;
                            $isDueToday = $reminder->due_date->isToday();
                        @endphp
                        <div class="border-bottom p-3 {{ $isRead ? 'bg-light' : 'bg-white' }} {{ $isOverdue ? 'border-start border-danger border-3' : '' }}">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 {{ $isRead ? 'text-muted' : 'text-dark' }}">
                                        {{ $reminder->title }}
                                        @if(!$isRead)
                                            <span class="badge bg-primary ms-2">New</span>
                                        @endif
                                        @if($reminder->priority === 3)
                                            <span class="badge bg-danger ms-1">High</span>
                                        @elseif($reminder->priority === 2)
                                            <span class="badge bg-warning ms-1">Medium</span>
                                        @endif
                                        
                                        {{-- Show reminder type badge --}}
                                        @if($reminder->type === 'employee')
                                            <span class="badge bg-secondary ms-1">Employee</span>
                                        @elseif($reminder->type === 'project')
                                            <span class="badge bg-info ms-1">Project</span>
                                        @elseif($reminder->type === 'seminar')
                                            <span class="badge bg-success ms-1">Seminar</span>
                                        @elseif($reminder->type === 'email')
                                            <span class="badge bg-warning ms-1">Email</span>
                                        @elseif($reminder->type === 'general')
                                            <span class="badge bg-light text-dark ms-1">General</span>
                                        @endif
                                    </h6>
                                    <p class="mb-1 {{ $isRead ? 'text-muted' : 'text-secondary' }}">{{ $reminder->description ?? 'No description' }}</p>
                                    
                                    {{-- Show related information if available --}}
                                    @if($reminder->related_id == session('employee_id'))
                                        <div class="mb-2">
                                            <small class="text-info">
                                                <i class="fas fa-user me-1"></i>
                                                This reminder is specifically assigned to you
                                            </small>
                                        </div>
                                    @endif
                                    
                                    <div class="d-flex align-items-center">
                                        <small class="text-muted me-3">
                                            <i class="fas fa-calendar me-1"></i>
                                            Due: {{ $reminder->due_date->format('M d, Y') }}
                                        </small>
                                        @if($isOverdue)
                                            <span class="badge bg-danger">Overdue</span>
                                        @elseif($isDueToday)
                                            <span class="badge bg-warning">Due Today</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-end">
                                    @if($reminder->recipient_type === 'all')
                                        <span class="badge bg-success">All</span>
                                    @elseif($reminder->recipient_type === 'department')
                                        <span class="badge bg-warning">Department</span>
                                    @else
                                        <span class="badge bg-info">Personal</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times text-muted mb-3" style="font-size: 3rem;"></i>
                            <h5 class="text-muted">No reminders found</h5>
                            <p class="text-muted">No active reminders at the moment</p>
                        </div>
                    @endforelse
                </div>
                @if($reminders->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            {{ $reminders->appends(request()->query())->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
$(document).ready(function() {
    $('#refresh-data').click(function() {
        location.reload();
    });
});
</script>
@endsection
@endsection
