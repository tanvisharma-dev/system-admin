@extends('layouts.admin')

@section('title', 'Daily Tasks')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-calendar-day text-primary me-2"></i> Daily Tasks
        </h1>
        <a href="{{ route('daily_tasks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Task
        </a>
    </div>

    <!-- Card -->
    <div class="card shadow">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">Task List</h6>
        </div>
        <div class="card-body">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('daily_tasks.index') }}" class="row g-3 mb-4">
                <div class="col-md-4">
                    <select name="employee_id" class="form-select">
                        <option value="">-- All Employees --</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">-- All Status --</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div class="col-md-3 d-flex justify-content-end gap-2">
    <button type="submit" class="btn btn-secondary">
        <i class="fas fa-filter"></i> Filter
    </button>
    <a href="{{ route('daily_tasks.index') }}" class="btn btn-secondary justify-content-end">
        <i class="fas fa-redo"></i> Reset
    </a>
</div>

            </form>

            <!-- Tasks Table -->
            @if($tasks->count())
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Employee</th>
                                <th>Date</th>
                                <th>Task</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $index => $task)
                                <tr>
                                    <td>{{ $task->employee->name ?? 'N/A' }}</td>
                                    <td>{{ $task->date->format('d M, Y') }}</td>
                                    <td class="fw-semibold">{{ $task->my_task }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($task->completion_status === 'completed') bg-success
                                            @elseif($task->completion_status === 'pending') bg-warning text-dark
                                            @else bg-secondary @endif">
                                            {{ ucfirst($task->completion_status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-3">
                    {{ $tasks->withQueryString()->links() }}
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>No tasks found.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
