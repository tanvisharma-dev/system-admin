@extends('layouts.admin')

@section('title', 'Register New Student')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Register New Student</h1>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Students
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold">Student Registration Form</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="full_name">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="college_name">College Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('college_name') is-invalid @enderror" id="college_name" name="college_name" value="{{ old('college_name') }}" required>
                            @error('college_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="course">Course <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('course') is-invalid @enderror" id="course" name="course" value="{{ old('course') }}" required>
                            @error('course')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="semester">Semester <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester" value="{{ old('semester') }}" required>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="seminar_id">Seminar <span class="text-danger">*</span></label>
                            <select class="form-control @error('seminar_id') is-invalid @enderror" id="seminar_id" name="seminar_id" required>
                                <option value="">Select Seminar</option>
                                @foreach($seminars as $seminar)
                                    <option value="{{ $seminar->id }}" {{ old('seminar_id', request('seminar_id')) == $seminar->id ? 'selected' : '' }}>
                                        {{ $seminar->college_name }} - {{ $seminar->seminar_date->format('d M, Y') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('seminar_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hiring_status">Hiring Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('hiring_status') is-invalid @enderror" id="hiring_status" name="hiring_status" required>
                                <option value="">Select Status</option>
                                @foreach($hiringStatuses as $status)
                                    <option value="{{ $status }}" {{ old('hiring_status') == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('hiring_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Conditional fields for Selected status -->
                <div class="row mb-3" id="selectedFields" style="display: none;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="package">Package (Amount) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" class="form-control @error('package') is-invalid @enderror" id="package" name="package" value="{{ old('package') }}" placeholder="Enter package amount">
                            @error('package')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="joining_date">Joining Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('joining_date') is-invalid @enderror" id="joining_date" name="joining_date" value="{{ old('joining_date') }}">
                            @error('joining_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="skills">Skills (Comma Separated) <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('skills') is-invalid @enderror" id="skills" name="skills" rows="3" required>{{ old('skills') }}</textarea>
                            @error('skills')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" rows="3">{{ old('remarks') }}</textarea>
                            @error('remarks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Register Student
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Function to toggle conditional fields
    function toggleSelectedFields() {
        const hiringStatus = $('#hiring_status').val();
        const selectedFields = $('#selectedFields');
        const packageField = $('#package');
        const joiningDateField = $('#joining_date');
        
        if (hiringStatus === 'Selected') {
            selectedFields.show();
            packageField.prop('required', true);
            joiningDateField.prop('required', true);
        } else {
            selectedFields.hide();
            packageField.prop('required', false).val('');
            joiningDateField.prop('required', false).val('');
        }
    }
    
    // Check initial state
    toggleSelectedFields();
    
    // Listen for changes in hiring status
    $('#hiring_status').change(function() {
        toggleSelectedFields();
    });
});
</script>
@endsection
