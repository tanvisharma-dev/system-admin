@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Bank Details</h1>
        <a href="{{ route('bank-details.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>


    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Bank Information</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('bank-details.store') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="employee_id">Employee <span class="text-danger">*</span></label>
                        <select name="employee_id" id="employee_id" class="form-control @error('employee_id') is-invalid @enderror" required>
                            <option value="">Select Employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id', $selectedEmployeeId) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="bank_name">Bank Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name" value="{{ old('bank_name') }}" required>
                        @error('bank_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="account_number">Account Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('account_number') is-invalid @enderror" id="account_number" name="account_number" value="{{ old('account_number') }}" required>
                        @error('account_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="ifsc_code">IFSC Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('ifsc_code') is-invalid @enderror" id="ifsc_code" name="ifsc_code" value="{{ old('ifsc_code') }}" required>
                        @error('ifsc_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="uan_number">UPI ID (Optional)</label>
                        <input type="text" class="form-control @error('uan_number') is-invalid @enderror" id="uan_number" name="uan_number" value="{{ old('uan_number') }}">
                        @error('uan_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-user btn-block">
                    Save Bank Details
                </button>
            </form>
        </div>
    </div>
</div>
@endsection