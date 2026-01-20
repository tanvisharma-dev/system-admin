@extends('layouts.employee')


@section('title', 'View Daily Task')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Task Details</h1>
        <div>
            <a href="{{ route('employee.daily_tasks.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Tasks
            </a>
            <a href="{{ route('employee.daily_tasks.edit', $dailyTask->id) }}" class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit Task
            </a>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Task Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Date:</label>
                                <p class="text-gray-900">{{ \Carbon\Carbon::parse($dailyTask->date)->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Task Number:</label>
                                <p class="text-gray-900">{{ $dailyTask->task_no }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Project Title:</label>
                        <p class="text-gray-900">{{ $dailyTask->project_title }}</p>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Task Description:</label>
                        <div class="card bg-light">
                            <div class="card-body">
                                <p class="text-gray-900 mb-0">{{ $dailyTask->my_task }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Time Taken:</label>
                                <p class="text-gray-900">
                                    {{ $dailyTask->time_taken }} hour{{ $dailyTask->time_taken != 1 ? 's' : '' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Completion Status:</label>
                                <p class="text-gray-900">
                                    @if($dailyTask->completion_status == 'completed')
                                        <span class="badge badge-success badge-pill">
                                            <i class="fas fa-check-circle"></i> Completed
                                        </span>
                                    @else
                                        <span class="badge badge-warning badge-pill">
                                            <i class="fas fa-clock"></i> Pending
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Task Metadata</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-info-circle fa-2x text-gray-300 mb-3"></i>
                    </div>
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Task ID:</strong></td>
                            <td>{{ $dailyTask->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Created Time:</strong></td>
                            <td>{{ $dailyTask->created_time ? \Carbon\Carbon::parse($dailyTask->created_time)->format('M d, Y H:i') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Created At:</strong></td>
                            <td>{{ $dailyTask->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Last Updated:</strong></td>
                            <td>{{ $dailyTask->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Employee:</strong></td>
                            <td>{{ $dailyTask->employee->name ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Task Summary</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-chart-pie fa-2x text-gray-300 mb-3"></i>
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Progress
                            </div>
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-{{ $dailyTask->completion_status == 'completed' ? 'success' : 'warning' }}" 
                                     role="progressbar" 
                                     style="width: {{ $dailyTask->completion_status == 'completed' ? '100' : '50' }}%" 
                                     aria-valuenow="{{ $dailyTask->completion_status == 'completed' ? '100' : '50' }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-{{ $dailyTask->completion_status == 'completed' ? 'check' : 'clock' }} fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Actions</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-tools fa-2x text-gray-300 mb-3"></i>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('employee.daily_tasks.edit', $dailyTask->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit Task
                        </a>
                        <form action="{{ route('employee.daily_tasks.destroy', $dailyTask->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm w-100" 
                                    onclick="return confirm('Are you sure you want to delete this task?')">
                                <i class="fas fa-trash"></i> Delete Task
                            </button>
                        </form>
                        <a href="{{ route('employee.daily_tasks.create') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> Add New Task
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
