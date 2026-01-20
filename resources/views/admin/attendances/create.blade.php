@extends('layouts.admin')

@section('title', 'Mark Attendance')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Mark Attendance</h1>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('attendances.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Attendance
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Employee ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id" value="{{ old('employee_id') }}" required>
                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="date" class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="">Select Status</option>
                            <option value="P" {{ old('status') == 'P' ? 'selected' : '' }}>Present</option>
                            <option value="A" {{ old('status') == 'A' ? 'selected' : '' }}>Absent</option>
                            <option value="HL" {{ old('status') == 'HL' ? 'selected' : '' }}>Half Day Leave</option>
                            <option value="L" {{ old('status') == 'L' ? 'selected' : '' }}>Leave</option>
                            <option value="WFH" {{ old('status') == 'WFH' ? 'selected' : '' }}>Work From Home</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3" id="hours-worked-container">
                        <label for="hours" class="form-label">Hours Worked</label>
                        <input type="number" step="0.01" min="0" max="24" class="form-control @error('hours') is-invalid @enderror" id="hours" name="hours" value="{{ old('hours') }}">
                        <div class="form-text">Enter decimal hours (e.g., 8.00, 7.50)</div>
                        @error('hours')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <button type="reset" class="btn btn-light me-md-2">Reset</button>
                        <button type="submit" class="btn btn-primary">Mark Attendance</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('status');
        const hoursWorkedContainer = document.getElementById('hours-worked-container');
        const hoursWorkedInput = document.getElementById('hours');
        
        // Function to toggle hours worked field visibility
        function toggleHoursWorked() {
            if (statusSelect.value === 'P' || statusSelect.value === 'WFH') {
                hoursWorkedContainer.style.display = 'block';
                hoursWorkedInput.setAttribute('required', 'required');
            } else {
                hoursWorkedContainer.style.display = 'none';
                hoursWorkedInput.removeAttribute('required');
                hoursWorkedInput.value = '';
            }
        }
        
        // Initial state
        toggleHoursWorked();
        
        // Listen for changes
        statusSelect.addEventListener('change', toggleHoursWorked);
    });
</script>
@endsection