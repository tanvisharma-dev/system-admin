@extends('layouts.admin')

@section('title', 'Create Notification')

@section('styles')
<!-- Include Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Create Notification</h1>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('notifications.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Notifications
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('notifications.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" id="message" class="form-control summernote @error('message') is-invalid @enderror" rows="5" required>{{ old('message') }}</textarea>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="recipient_type" class="form-label">Recipient Type</label>
                <select name="recipient_type" id="recipient_type" class="form-control @error('recipient_type') is-invalid @enderror" required>
                    <option value="">Select Recipient Type</option>
                    @foreach($recipientTypes as $value => $label)
                        <option value="{{ $value }}" {{ old('recipient_type') == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('recipient_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div id="department_section" class="mb-3" style="display: none;">
                <label for="department" class="form-label">Department</label>
                <select name="department" id="department" class="form-control @error('department') is-invalid @enderror">
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
                @error('department')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div id="employees_section" class="mb-3" style="display: none;">
                <label for="employees" class="form-label">Employees</label>
                <select name="employees[]" id="employees" class="form-control select2 @error('employees') is-invalid @enderror" multiple>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ (old('employees') && in_array($employee->id, old('employees'))) ? 'selected' : '' }}>
                            {{ $employee->name }} ({{ $employee->employee_id ?? 'N/A' }}) 
                            @if($employee->email)
                                - {{ $employee->email }}
                            @else
                                <span class="text-muted">(No Email)</span>
                            @endif
                        </option>
                    @endforeach
                </select>
                @error('employees')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="send_email" id="send_email" value="1" {{ old('send_email', 1) ? 'checked' : '' }}>
                    <label class="form-check-label" for="send_email">
                        <i class="fas fa-envelope"></i> Send Email Notifications
                    </label>
                    <small class="form-text text-muted d-block">When checked, email notifications will be sent to all recipients who have email addresses.</small>
                </div>
            </div>
            
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                <strong>Note:</strong> Emails will only be sent to employees who have valid email addresses in their profile.
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Send Notification
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<!-- Include Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
        
        $('.select2').select2({
            placeholder: 'Select employees',
            width: '100%'
        });
        
        // Show/hide sections based on recipient type
        $('#recipient_type').change(function() {
            const recipientType = $(this).val();
            
            if (recipientType === 'department') {
                $('#department_section').show();
                $('#employees_section').hide();
            } else if (recipientType === 'individual') {
                $('#department_section').hide();
                $('#employees_section').show();
            } else {
                $('#department_section').hide();
                $('#employees_section').hide();
            }
        });
        
        // Trigger change event on page load to handle initial state
        $('#recipient_type').trigger('change');
    });
</script>
@endsection