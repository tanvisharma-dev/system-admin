@extends('layouts.employee')


@section('title', 'Add Daily Task')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Daily Task</h1>
        <a href="{{ route('employee.daily_tasks.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Tasks
        </a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Task Information</h6>
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

                    <form action="{{ route('employee.daily_tasks.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group mt-2">
                            <label for="date">Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" 
                                   id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="task_no">Task Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('task_no') is-invalid @enderror" 
                                   id="task_no" name="task_no" value="{{ old('task_no') }}" 
                                   placeholder="e.g., TASK-001" required>
                            @error('task_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="project_title">Project Title <span class="text-danger">*</span></label>
                            <select class="form-control @error('project_title') is-invalid @enderror" 
                                    id="project_title" name="project_title" >
                                <option value="">Select a Project</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" 
                                        {{ old('project_title') == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('project_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="module_id">Module Title <span class="text-danger">*</span></label>
                            <select id="module_id" name="module_id" class="form-control" required>
                                <option value="">Select Module</option>
                            </select>

                            @error('module_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group mt-2">
                            <label for="my_task">Task Description <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('my_task') is-invalid @enderror" 
                                      id="my_task" name="my_task" rows="4" 
                                      placeholder="Describe the task in detail" required>{{ old('my_task') }}</textarea>
                            @error('my_task')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="time_taken">Time Taken (hours) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('time_taken') is-invalid @enderror" 
                                   id="time_taken" name="time_taken" value="{{ old('time_taken') }}" 
                                   step="0.5" min="0" max="24" placeholder="e.g., 2.5" required>
                            @error('time_taken')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <label for="completion_status">Completion Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('completion_status') is-invalid @enderror" 
                                    id="completion_status" name="completion_status" required>
                                <option value="">Select Status</option>
                                <option value="pending" {{ old('completion_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ old('completion_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            @error('completion_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Task
                            </button>
                            <a href="{{ route('employee.daily_tasks.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Help</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-info-circle fa-2x text-gray-300 mb-3"></i>
                    </div>
                    <h6>Task Guidelines:</h6>
                    <ul class="small">
                        <li>Use clear and descriptive task numbers</li>
                        <li>Include project title for better organization</li>
                        <li>Write detailed task descriptions</li>
                        <li>Record accurate time spent on tasks</li>
                        <li>Update completion status appropriately</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#project_title').on('change', function() {
        var projectId = $(this).val();
        var moduleSelect = $('#module_id');

        moduleSelect.empty().append('<option value="">Loading...</option>');

        if (projectId) {
            $.ajax({
                url: '/employee/projects/' + projectId + '/modules',
                type: 'GET',
                success: function(data) {
                    moduleSelect.empty().append('<option value="">Select Module</option>');
                    $.each(data, function(index, module) {
                        moduleSelect.append('<option value="'+module.id+'">'+module.module_name+'</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.group('🛑 AJAX Module Load Error');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response Text:', xhr.responseText);
                    console.error('Full XHR Object:', xhr);
                    console.groupEnd();

                    moduleSelect.empty().append('<option value="">Error loading modules</option>');
                }
            });
        } else {
            moduleSelect.empty().append('<option value="">Select Module</option>');
        }
    });
});
</script>



@endsection