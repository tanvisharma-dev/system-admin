@extends('layouts.admin')

@section('title', 'Edit Task')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Task</h1>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Tasks
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold">Task Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="project_id">Project <span class="text-danger">*</span></label>
                            <select class="form-control @error('project_id') is-invalid @enderror" id="project_id" name="project_id" required>
                                <option value="">Select Project</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }} ({{ $project->client_name }})
                                    </option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Task Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $task->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="assigned_to">Assigned To <span class="text-danger">*</span></label>
                            <select class="form-control @error('assigned_to') is-invalid @enderror" id="assigned_to" name="assigned_to" required>
                                <option value="">Select Employee</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('assigned_to', $task->assigned_to) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->full_name }} ({{ $employee->designation }})
                                    </option>
                                @endforeach
                            </select>
                            @error('assigned_to')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Select Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ old('status', $task->status) == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">Start Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', $task->start_date->format('Y-m-d')) }}" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="due_date">Due Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date', $task->due_date->format('Y-m-d')) }}" required>
                            @error('due_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="completion_date">Completion Date</label>
                            <input type="date" class="form-control @error('completion_date') is-invalid @enderror" id="completion_date" name="completion_date" value="{{ old('completion_date', $task->completion_date ? $task->completion_date->format('Y-m-d') : '') }}">
                            <small class="form-text text-muted">Leave blank if task is not completed yet</small>
                            @error('completion_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" rows="3">{{ old('remarks', $task->remarks) }}</textarea>
                            @error('remarks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Validate dates
    document.getElementById('start_date').addEventListener('change', function() {
        document.getElementById('due_date').min = this.value;
        if (document.getElementById('completion_date').value) {
            document.getElementById('completion_date').min = this.value;
        }
    });

    // Set initial min values
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('due_date').min = document.getElementById('start_date').value;
        if (document.getElementById('completion_date').value) {
            document.getElementById('completion_date').min = document.getElementById('start_date').value;
        }
    });

    // Auto-set completion date when status is changed to Done
    document.getElementById('status').addEventListener('change', function() {
        if (this.value === 'Done' && !document.getElementById('completion_date').value) {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('completion_date').value = today;
        }
    });
</script>
@endsection