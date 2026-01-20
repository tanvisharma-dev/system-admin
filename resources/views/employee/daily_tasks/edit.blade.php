@extends('layouts.employee')


@section('title', 'Edit Daily Task')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Daily Task</h1>
        <a href="{{ route('employee.daily_tasks.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Tasks
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Task Information</h6>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('employee.daily_tasks.update', $dailyTask->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="date">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" 
                                   id="date" name="date" value="{{ old('date', $dailyTask->date) }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="task_number">Task Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('task_number') is-invalid @enderror" 
                                   id="task_number" name="task_number" value="{{ old('task_number', $dailyTask->task_no) }}" 
                                   placeholder="e.g., TASK-001" required>
                            @error('task_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="project_title">Project Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('project_title') is-invalid @enderror" 
                                   id="project_title" name="project_title" value="{{ old('project_title', $dailyTask->project_title) }}" 
                                   placeholder="Enter project title" required>
                            @error('project_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="task_description">Task Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('task_description') is-invalid @enderror" 
                                      id="task_description" name="task_description" rows="4" 
                                      placeholder="Describe the task in detail" required>{{ old('task_description', $dailyTask->my_task) }}</textarea>
                            @error('task_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="time_taken">Time Taken (hours) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('time_taken') is-invalid @enderror" 
                                   id="time_taken" name="time_taken" value="{{ old('time_taken', $dailyTask->time_taken) }}" 
                                   step="0.5" min="0" max="24" placeholder="e.g., 2.5" required>
                            @error('time_taken')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="completion_status">Completion Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('completion_status') is-invalid @enderror" 
                                    id="completion_status" name="completion_status" required>
                                <option value="">Select Status</option>
                                <option value="pending" {{ old('completion_status', $dailyTask->completion_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ old('completion_status', $dailyTask->completion_status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('completion_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Task
                            </button>
                            <a href="{{ route('employee.daily_tasks.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <a href="{{ route('employee.daily_tasks.show', $dailyTask->id) }}" class="btn btn-info">
                                <i class="fas fa-eye"></i> View Task
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Task Details</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-tasks fa-2x text-gray-300 mb-3"></i>
                    </div>
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Task ID:</strong></td>
                            <td>{{ $dailyTask->id }}</td>
                        </tr>
                        <tr>
                            <td><strong>Created:</strong></td>
                            <td>{{ $dailyTask->created_time ? \Carbon\Carbon::parse($dailyTask->created_time)->format('M d, Y H:i') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td><strong>Last Updated:</strong></td>
                            <td>{{ $dailyTask->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Current Status:</strong></td>
                            <td>
                                @if($dailyTask->completion_status == 'completed')
                                    <span class="badge badge-success">Completed</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Note</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle fa-2x text-gray-300 mb-3"></i>
                    </div>
                    <p class="small">
                        Make sure to update the completion status accurately. 
                        This information is used for reporting and performance tracking.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
