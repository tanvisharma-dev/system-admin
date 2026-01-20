@extends('layouts.admin')

@section('title', 'Schedule Seminar')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Schedule New Seminar</h1>
        <a href="{{ route('seminars.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Seminars
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold">Seminar Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('seminars.store') }}" method="POST">
                @csrf
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="college_name">College Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('college_name') is-invalid @enderror" id="college_name" name="college_name" value="{{ old('college_name') }}" required>
                            @error('college_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="seminar_date">Seminar Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('seminar_date') is-invalid @enderror" id="seminar_date" name="seminar_date" value="{{ old('seminar_date') }}" required>
                            @error('seminar_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="purpose">Purpose of Seminar</label>
                            <textarea class="form-control @error('purpose') is-invalid @enderror" id="purpose" name="purpose" rows="3">{{ old('purpose') }}</textarea>
                            @error('purpose')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label>Seminar Presenters</label>
                        <div class="mt-2">
                            <button type="button" class="btn btn-info btn-sm" id="addPresenterBtn">
                                <i class="fas fa-plus"></i> Add Employee Presenter
                            </button>
                        </div>
                        <div id="presentersContainer" class="mt-3">
                            <!-- Dynamic presenter fields will be added here -->
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="location">Location <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_person">Contact Person <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('contact_person') is-invalid @enderror" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" required>
                            @error('contact_person')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Select Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
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
                            <i class="fas fa-save"></i> Schedule Seminar
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
    let presenterIndex = 0;
    
    // Employee data from server
    const employees = @json($employees);
    
    // Function to create employee options
    function createEmployeeOptions() {
        let options = '<option value="">Select Employee</option>';
        employees.forEach(function(employee) {
            options += `<option value="${employee.id}">${employee.name} (${employee.employee_id})</option>`;
        });
        return options;
    }
    
    // Add new presenter fields
    $('#addPresenterBtn').click(function() {
        const presenterHtml = `
            <div class="presenter-group border p-3 mb-3 rounded" data-index="${presenterIndex}">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Employee <span class="text-danger">*</span></label>
                            <select class="form-control" name="seminar_presenters[${presenterIndex}][employee_id]" required>
                                ${createEmployeeOptions()}
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Topic <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="seminar_presenters[${presenterIndex}][topic]" placeholder="Enter topic to be presented" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="button" class="btn btn-danger btn-sm d-block remove-presenter">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#presentersContainer').append(presenterHtml);
        presenterIndex++;
    });
    
    // Remove presenter fields
    $(document).on('click', '.remove-presenter', function() {
        $(this).closest('.presenter-group').remove();
    });
});
</script>
@endsection
