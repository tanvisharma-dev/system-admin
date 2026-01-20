@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Apply for Leave</h1>
        <a onclick="history.back()" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back 
        </a>
    </div>

    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Leave Application Form</h6>
        </div> --}}
        <div class="card-body">
            <form action="{{ route('leaves.store') }}" method="POST">
                @csrf
                
                <div class="form-group row mb-3">
                    <label for="employee_id" class="col-sm-2 col-form-label">Employee ID <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select class="form-control @error('employee_id') is-invalid @enderror" 
                                id="employee_id" 
                                name="employee_id" 
                                required>
                            <option value="">Select Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->employee_id }}" 
                                    {{ old('employee_id') == $employee->employee_id ? 'selected' : '' }}>
                                    {{ $employee->name }} ({{ $employee->employee_id }})
                                </option>
                            @endforeach
                        </select>

                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Select the employee by name (employee ID in brackets).
                        </small>
                    </div>

                </div>

                <div class="form-group row mb-3">
                    <label for="leave_type" class="col-sm-2 col-form-label">Leave Type <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select class="form-control @error('leave_type') is-invalid @enderror" id="leave_type" name="leave_type" required>
                            <option value="">Select Leave Type</option>
                            <option value="Sick Leave" {{ old('leave_type') == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                            <option value="Casual Leave" {{ old('leave_type') == 'Casual Leave' ? 'selected' : '' }}>Casual Leave</option>
                            <option value="Earned Leave" {{ old('leave_type') == 'Earned Leave' ? 'selected' : '' }}>Earned Leave</option>
                            <option value="Maternity Leave" {{ old('leave_type') == 'Maternity Leave' ? 'selected' : '' }}>Maternity Leave</option>
                            <option value="Paternity Leave" {{ old('leave_type') == 'Paternity Leave' ? 'selected' : '' }}>Paternity Leave</option>
                            <option value="Other" {{ old('leave_type') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('leave_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="from_date" class="col-sm-2 col-form-label">From Date <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('from_date') is-invalid @enderror" id="from_date" name="from_date" value="{{ old('from_date') }}" required>
                        @error('from_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="to_date" class="col-sm-2 col-form-label">To Date <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('to_date') is-invalid @enderror" id="to_date" name="to_date" value="{{ old('to_date') }}" required>
                        @error('to_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <label for="reason" class="col-sm-2 col-form-label">Remarks <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" rows="3" required>{{ old('reason') }}</textarea>
                        <small class="form-text text-muted">Enter the reason for your leave request</small>
                        @error('reason')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div> -->

                <div class="form-group row mb-3">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <!-- <input type="text" class="form-control" value="Pending" readonly> -->
                        <!-- <input type="hidden" name="status" value="Pending"> -->
                         <select name="status" class="form-control">
                            <option value="" selected disabled>Choose Leave Status</option>
                            <option value="0">Pending</option>
                            <option value="1">Rejected</option>
                            <option value="2">Approved</option>
                         </select>
                        <small class="form-text text-muted">Leave applications are pending by default until reviewed by management.</small>
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Submit Application</button>
                        <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set minimum date for from_date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('from_date').setAttribute('min', today);
        
        // Update to_date min value when from_date changes
        document.getElementById('from_date').addEventListener('change', function() {
            document.getElementById('to_date').setAttribute('min', this.value);
            
            // If to_date is earlier than from_date, update it
            if (document.getElementById('to_date').value < this.value) {
                document.getElementById('to_date').value = this.value;
            }
        });
    });
</script>
@endsection