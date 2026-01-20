@extends('layouts.admin')

@section('title', 'Reminder Details')

@section('styles')
<style>
    .reminder-header {
        background-color: #f8f9fc;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .reminder-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 10px;
    }
    .badge-container {
        display: flex;
        gap: 5px;
        margin-bottom: 15px;
    }
    .detail-row {
        margin-bottom: 10px;
    }
    .detail-label {
        font-weight: 600;
        color: #4e73df;
    }
    .action-buttons {
        margin-top: 20px;
    }
    .description-box {
        background-color: #f8f9fc;
        border-radius: 5px;
        padding: 15px;
        margin-top: 20px;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reminder Details</h1>
        <div>
            <a href="{{ route('reminders.edit', $reminder) }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit
            </a>
            <a href="{{ route('reminders.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Reminders
            </a>
        </div>
    </div>

    <!-- Reminder Details -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Reminder Information</h6>
                    <div>
                        @if(!$reminder->is_completed)
                            <form action="{{ route('reminders.mark-completed', $reminder) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fas fa-check"></i> Mark Complete
                                </button>
                            </form>
                        @endif
                        <form action="{{ route('reminders.destroy', $reminder) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this reminder?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="reminder-header">
                        <div class="reminder-title">{{ $reminder->title }}</div>
                        <div class="badge-container">
                            {!! $reminder->typeBadge !!}
                            {!! $reminder->priorityBadge !!}
                            {!! $reminder->statusBadge !!}
                            @if($reminder->is_recurring)
                                <span class="badge bg-info">Recurring ({{ ucfirst($reminder->recurrence_pattern) }})</span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-row">
                                <span class="detail-label">Type:</span> 
                                {{ ucfirst($reminder->type) }}
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Due Date:</span> 
                                {{ $reminder->due_date->format('F d, Y') }}
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Priority:</span> 
                                @if($reminder->priority == 1) Low @elseif($reminder->priority == 2) Medium @else High @endif
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Status:</span> 
                                @if($reminder->is_completed) 
                                    Completed on {{ $reminder->completed_at->format('F d, Y') }}
                                @else 
                                    @if($reminder->due_date->isPast())
                                        Overdue by {{ $reminder->due_date->diffForHumans() }}
                                    @elseif($reminder->due_date->isToday())
                                        Due Today
                                    @else
                                        Due in {{ $reminder->due_date->diffForHumans() }}
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-row">
                                <span class="detail-label">Created:</span> 
                                {{ $reminder->created_at->format('F d, Y g:i A') }}
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Last Updated:</span> 
                                {{ $reminder->updated_at->format('F d, Y g:i A') }}
                            </div>
                            
                            @if($reminder->type === 'project' && isset($reminder->project))
                                <div class="detail-row">
                                    <span class="detail-label">Related Project:</span> 
                                    <a href="{{ route('projects.show', $reminder->project->id) }}">{{ $reminder->project->name }}</a>
                                </div>
                            @elseif($reminder->type === 'seminar' && isset($reminder->seminar))
                                <div class="detail-row">
                                    <span class="detail-label">Related Seminar:</span> 
                                    <a href="{{ route('seminars.show', $reminder->seminar->id) }}">{{ $reminder->seminar->title }}</a>
                                </div>
                            @elseif($reminder->type === 'employee' && isset($reminder->employee))
                                <div class="detail-row">
                                    <span class="detail-label">Related Employee:</span> 
                                    <a href="{{ route('employees.show', $reminder->employee->id) }}">{{ $reminder->employee->name }}</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($reminder->description)
                        <div class="description-box">
                            <h6 class="font-weight-bold">Description</h6>
                            <p>{{ $reminder->description }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection