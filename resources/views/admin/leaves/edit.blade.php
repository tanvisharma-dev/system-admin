@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Leave Application</h1>
        <a href="{{ route('leaves.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Leave List
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Leave Application Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('leaves.update', $leave->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group row">
                    <label for="employee_id" class="col-sm-2 col-form-label">Employee ID <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id" value="{{ old('employee_id') ?? $leave->employee->employee_id }}" placeholder="Enter Employee ID" required>
                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Enter the employee ID (not the database ID).</small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="leave_type" class="col-sm-2 col-form-label">Leave Type <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select class="form-control @error('leave_type') is-invalid @enderror" id="leave_type" name="leave_type" required>
                            <option value="">Select Leave Type</option>
                            <option value="Sick Leave" {{ (old('leave_type') ?? $leave->leave_type) == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                            <option value="Casual Leave" {{ (old('leave_type') ?? $leave->leave_type) == 'Casual Leave' ? 'selected' : '' }}>Casual Leave</option>
                            <option value="Earned Leave" {{ (old('leave_type') ?? $leave->leave_type) == 'Earned Leave' ? 'selected' : '' }}>Earned Leave</option>
                            <option value="Maternity Leave" {{ (old('leave_type') ?? $leave->leave_type) == 'Maternity Leave' ? 'selected' : '' }}>Maternity Leave</option>
                            <option value="Paternity Leave" {{ (old('leave_type') ?? $leave->leave_type) == 'Paternity Leave' ? 'selected' : '' }}>Paternity Leave</option>
                            <option value="Other" {{ (old('leave_type') ?? $leave->leave_type) == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('leave_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="from_date" class="col-sm-2 col-form-label">From Date <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('from_date') is-invalid @enderror" id="from_date" name="from_date" value="{{ old('from_date') ?? $leave->from_date->format('Y-m-d') }}" required>
                        @error('from_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="to_date" class="col-sm-2 col-form-label">To Date <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @error('to_date') is-invalid @enderror" id="to_date" name="to_date" value="{{ old('to_date') ?? $leave->to_date->format('Y-m-d') }}" required>
                        @error('to_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="Pending" {{ (old('status') ?? $leave->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Approved" {{ (old('status') ?? $leave->status) == 'Approved' ? 'selected' : '' }}>Approved</option>
                            <option value="Rejected" {{ (old('status') ?? $leave->status) == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row rejection-reason" style="display: {{ (old('status') ?? $leave->status) == 'Rejected' ? 'flex' : 'none' }}">
                    <label for="rejection_reason" class="col-sm-2 col-form-label">Rejection Reason</label>
                    <div class="col-sm-10">
                        <textarea class="form-control @error('rejection_reason') is-invalid @enderror" id="rejection_reason" name="rejection_reason" rows="3">{{ old('rejection_reason') ?? $leave->rejection_reason }}</textarea>
                        @error('rejection_reason')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Please provide a reason for rejecting this leave application.</small>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-primary">Update Application</button>
                        <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show/hide rejection reason based on status
        document.getElementById('status').addEventListener('change', function() {
            const rejectionReasonDiv = document.querySelector('.rejection-reason');
            if (this.value === 'Rejected') {
                rejectionReasonDiv.style.display = 'flex';
                document.getElementById('rejection_reason').setAttribute('required', 'required');
            } else {
                rejectionReasonDiv.style.display = 'none';
                document.getElementById('rejection_reason').removeAttribute('required');
            }
        });
        
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