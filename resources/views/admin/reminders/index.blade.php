@extends('layouts.admin')

@section('title', 'Reminders')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@section('styles')
<style>
    .filter-row {
        background-color: #f8f9fa;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    .reminder-card {
        transition: transform 0.3s;
        margin-bottom: 20px;
    }
    .reminder-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .badge-container {
        display: flex;
        gap: 5px;
    }
    .action-buttons {
        display: flex;
        gap: 5px;
    }
    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Reminders</h1>
        <div>
            <a href="{{ route('reminders.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Create New Reminder
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="row filter-row">
        <div class="col-12">
            <form action="{{ route('reminders.index') }}" method="GET" class="form-inline">
                <div class="form-group mb-2 mr-2">
                    <label for="type" class="mr-2">Type:</label>
                    <select name="type" id="type" class="form-control form-control-sm">
                        <option value="">All Types</option>
                        @foreach($types as $key => $value)
                            <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-2 mr-2">
                    <label for="status" class="mr-2">Status:</label>
                    <select name="status" id="status" class="form-control form-control-sm">
                        <option value="">All Statuses</option>
                        @foreach($statuses as $key => $value)
                            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-2 mr-2">
                    <label for="priority" class="mr-2">Priority:</label>
                    <select name="priority" id="priority" class="form-control form-control-sm">
                        <option value="">All Priorities</option>
                        @foreach($priorities as $key => $value)
                            <option value="{{ $key }}" {{ request('priority') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-sm btn-primary mb-2">Filter</button>
                <a href="{{ route('reminders.index') }}" class="btn btn-sm btn-secondary mb-2 ml-2 p-2">Reset</a>
            </form>
        </div>
    </div>

    <!-- Reminders List -->
    <div class="row">
        @if($reminders->count() > 0)
            @foreach($reminders as $reminder)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow reminder-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="badge-container bg-have" >
                                {!! $reminder->typeBadge !!}
                                {!! $reminder->priorityBadge !!}
                                {!! $reminder->statusBadge !!}
                            </div>
                            <div class="action-buttons d-flex align-items-center">
                                <a href="{{ route('reminders.edit', $reminder) }}" class="btn btn-sm btn-info d-flex align-items-center h-50 text-white">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('reminders.destroy', $reminder) }}" method="POST" class="d-inline mt-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this reminder?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $reminder->title }}</h5>
                            <p class="card-text">{{ Str::limit($reminder->description, 100) }}</p>
                            
                            @if($reminder->type === 'project' && $reminder->project)
                                <p class="mb-1"><strong>Project:</strong> {{ $reminder->project->name }}</p>
                            @elseif($reminder->type === 'seminar' && $reminder->seminar)
                                <p class="mb-1"><strong>Seminar:</strong> {{ $reminder->seminar->title }}</p>
                            @elseif($reminder->type === 'employee' && $reminder->employee)
                                <p class="mb-1"><strong>Employee:</strong> {{ $reminder->employee->name }}</p>
                            @endif
                            
                            <p class="mb-1"><strong>Due Date:</strong> {{ $reminder->due_date->format('M d, Y') }}</p>
                            
                            @if($reminder->is_recurring)
                                <p class="mb-1"><strong>Recurrence:</strong> {{ ucfirst($reminder->recurrence_pattern) }}</p>
                            @endif
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Created {{ $reminder->created_at->diffForHumans() }}</small>
                            <div>
                                @if(!$reminder->is_completed)
                                    <form action="{{ route('reminders.mark-completed', $reminder) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i> Mark Complete
                                        </button>
                                    </form>
                                @else
                                    <span class="text-success"><i class="fas fa-check-circle"></i> Completed {{ $reminder->completed_at->diffForHumans() }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info">
                    No reminders found. <a href="{{ route('reminders.create') }}">Create a new reminder</a>.
                </div>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $reminders->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection