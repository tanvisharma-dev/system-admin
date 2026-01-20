@extends('layouts.admin')

@section('title', 'Employee Tasks - ' . $employee->name)

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $employee->name }}'s Tasks</h1>
        <div class="d-sm-flex">
            <nav aria-label="breadcrumb" class="mr-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('employee-tasks.index') }}">Employee Tasks</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $employee->name }}</li>
                </ol>
            </nav>
            <a href="{{ route('employee-tasks.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back to Employees
            </a>
        </div>
    </div>

    <!-- Employee Info Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-user mr-2"></i>Employee Information
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <strong>Employee ID:</strong><br>
                            <span class="text-primary">{{ $employee->employee_id }}</span>
                        </div>
                        <div class="col-md-3">
                            <strong>Name:</strong><br>
                            {{ $employee->name }}
                        </div>
                        <div class="col-md-3">
                            <strong>Designation:</strong><br>
                            {{ $employee->designation }}
                        </div>
                        <div class="col-md-3">
                            <strong>Department:</strong><br>
                            {{ $employee->department->name ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Task Statistics -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Tasks
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tasks->total() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Completed Tasks
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $employee->dailyTasks()->where('completion_status', 'completed')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Tasks
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $employee->dailyTasks()->where('completion_status', 'pending')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                This Month
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $employee->dailyTasks()->whereMonth('date', now()->month)->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tasks Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-list mr-2"></i>Daily Tasks
            </h6>
        </div>
        <div class="card-body">
            @if($tasks->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="tasksTable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Task No.</th>
                                <th>Project Title</th>
                                <th>Task Description</th>
                                <th>Time Taken</th>
                                <th>Status</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->date->format('M d, Y') }}</td>
                                    <td>
                                        <span class="badge badge-secondary">{{ $task->task_no }}</span>
                                    </td>
                                    <td>{{ $task->project_title }}</td>
                                    <td>
                                        <div class="task-description">
                                            {{ Str::limit($task->my_task, 100) }}
                                            @if(strlen($task->my_task) > 100)
                                                <br><small>
                                                    <a href="#" class="text-primary show-more" data-toggle="modal" data-target="#taskModal{{ $task->id }}">
                                                        Show more...
                                                    </a>
                                                </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $task->time_taken }}</td>
                                    <td>
                                        @if($task->completion_status == 'completed')
                                            <span class="badge badge-success">Completed</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $task->created_time->format('M d, Y g:i A') }}</td>
                                </tr>

                                <!-- Task Detail Modal -->
                                @if(strlen($task->my_task) > 100)
                                    <div class="modal fade" id="taskModal{{ $task->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Task Details - {{ $task->task_no }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong>Date:</strong> {{ $task->date->format('M d, Y') }}<br>
                                                            <strong>Task No:</strong> {{ $task->task_no }}<br>
                                                            <strong>Project:</strong> {{ $task->project_title }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>Time Taken:</strong> {{ $task->time_taken }}<br>
                                                            <strong>Status:</strong> 
                                                            @if($task->completion_status == 'completed')
                                                                <span class="badge badge-success">Completed</span>
                                                            @else
                                                                <span class="badge badge-warning">Pending</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <strong>Task Description:</strong>
                                                    <p class="mt-2">{{ $task->my_task }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $tasks->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-tasks fa-3x text-gray-300 mb-3"></i>
                    <h5 class="text-gray-600">No Tasks Found</h5>
                    <p class="text-gray-500">{{ $employee->name }} hasn't submitted any tasks yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .border-left-primary {
        border-left: 0.25rem solid #4e73df !important;
    }
    .border-left-success {
        border-left: 0.25rem solid #1cc88a !important;
    }
    .border-left-info {
        border-left: 0.25rem solid #36b9cc !important;
    }
    .border-left-warning {
        border-left: 0.25rem solid #f6c23e !important;
    }
    .task-description {
        max-width: 300px;
        word-wrap: break-word;
    }
    .show-more {
        cursor: pointer;
    }
    .show-more:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTables if needed
    if ($('#tasksTable tbody tr').length > 10) {
        $('#tasksTable').DataTable({
            "pageLength": 10,
            "order": [[ 0, "desc" ]],
            "columnDefs": [
                { "orderable": false, "targets": [3] }
            ]
        });
    }
});
</script>
@endsection
