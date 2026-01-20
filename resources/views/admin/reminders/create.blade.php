@extends('layouts.admin')

@section('title', 'Create Reminder')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .form-group label {
        font-weight: 600;
    }
    .select2-container--default .select2-selection--single {
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        border: 1px solid #d1d3e2;
        border-radius: 0.35rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 1.5;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(1.5em + 0.75rem + 2px);
    }
    .related-fields {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Create Reminder</h1>
        <a href="{{ route('reminders.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Reminders
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Reminder Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('reminders.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="due_date">Due Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                            @error('due_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">Type <span class="text-danger">*</span></label>
                            <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                <option value="">Select Type</option>
                                @foreach($types as $key => $value)
                                    <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="priority">Priority <span class="text-danger">*</span></label>
                            <select class="form-control @error('priority') is-invalid @enderror" id="priority" name="priority" required>
                                @foreach($priorities as $key => $value)
                                    <option value="{{ $key }}" {{ old('priority', 2) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div id="project-field" class="form-group related-fields">
                    <label for="project_id">Related Project</label>
                    <select class="form-control select2 @error('related_id') is-invalid @enderror" id="project_id" name="related_id">
                        <option value="">Select Project</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ old('related_id') == $project->id && old('type') == 'project' ? 'selected' : '' }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="seminar-field" class="form-group related-fields">
                    <label for="seminar_id">Related Seminar</label>
                    <select class="form-control select2 @error('related_id') is-invalid @enderror" id="seminar_id" name="related_id">
                        <option value="">Select Seminar</option>
                        @foreach($seminars as $seminar)
                            <option value="{{ $seminar->id }}" {{ old('related_id') == $seminar->id && old('type') == 'seminar' ? 'selected' : '' }}>{{ $seminar->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="employee-field" class="form-group related-fields">
                    <label for="employee_id">Related Employee</label>
                    <select class="form-control select2 @error('related_id') is-invalid @enderror" id="employee_id" name="related_id">
                        <option value="">Select Employee</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}" {{ old('related_id') == $employee->id && old('type') == 'employee' ? 'selected' : '' }}>{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>

                @error('related_id')
                    <div class="text-danger mb-3">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="is_recurring" name="is_recurring" value="1" {{ old('is_recurring') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_recurring">Recurring Reminder</label>
                    </div>
                </div>

                <div id="recurrence-pattern-field" class="form-group" style="display: {{ old('is_recurring') ? 'block' : 'none' }}">
                    <label for="recurrence_pattern">Recurrence Pattern</label>
                    <select class="form-control @error('recurrence_pattern') is-invalid @enderror" id="recurrence_pattern" name="recurrence_pattern">
                        <option value="">Select Pattern</option>
                        @foreach($recurrencePatterns as $key => $value)
                            <option value="{{ $key }}" {{ old('recurrence_pattern') == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('recurrence_pattern')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Reminder
                    </button>
                    <a href="{{ route('reminders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form> 
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            placeholder: "Select an option",
            allowClear: true
        });

        // Show/hide recurrence pattern field
        $('#is_recurring').change(function() {
            if($(this).is(':checked')) {
                $('#recurrence-pattern-field').show();
            } else {
                $('#recurrence-pattern-field').hide();
            }
        });

        // Show/hide related entity fields based on type
        $('#type').change(function() {
            $('.related-fields').hide();
            
            var selectedType = $(this).val();
            switch(selectedType) {
                case 'project':
                    $('#project-field').show();
                    break;
                case 'seminar':
                    $('#seminar-field').show();
                    break;
                case 'employee':
                    $('#employee-field').show();
                    break;
            }
        });


        $('#type').trigger('change');
    });
</script>
@endsection