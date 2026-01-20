@extends('layouts.admin')

@section('title', 'Edit Asset')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Asset</h5>
                <a href="{{ route('assets.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Assets
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('assets.update', $asset->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Assigned To <span class="text-danger">*</span></label>
                        <select class="form-select @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id" required>
                            <option value="">Select Employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" {{ (old('employee_id', $asset->employee_id) == $employee->id) ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="device_type" class="form-label">Asset Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('device_type') is-invalid @enderror" id="device_type" name="device_type" value="{{ old('device_type', $asset->device_type) }}" placeholder="e.g., Laptop, Monitor" required>
                        @error('device_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="serial_number" class="form-label">Serial Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('serial_number') is-invalid @enderror" id="serial_number" name="serial_number" value="{{ old('serial_number', $asset->serial_number) }}" required>
                        @error('serial_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="issued_date" class="form-label">Issued Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('issued_date') is-invalid @enderror" id="issued_date" name="issued_date" value="{{ old('issued_date', $asset->issued_date ? $asset->issued_date->format('Y-m-d') : '') }}" required>
                        @error('issued_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="return_date" class="form-label">Return Date</label>
                        <input type="date" class="form-control @error('return_date') is-invalid @enderror" id="return_date" name="return_date" value="{{ old('return_date', $asset->return_date ? $asset->return_date->format('Y-m-d') : '') }}">
                        @error('return_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="asset_condition" class="form-label">Condition <span class="text-danger">*</span></label>
                        <select class="form-select @error('asset_condition') is-invalid @enderror" id="asset_condition" name="asset_condition" required>
                            <option value="">Select Condition</option>
                            <option value="Working" {{ old('asset_condition', $asset->asset_condition) == 'Working' ? 'selected' : '' }}>Working</option>
                            <option value="Damaged" {{ old('asset_condition', $asset->asset_condition) == 'Damaged' ? 'selected' : '' }}>Damaged</option>
                            <option value="Under Repair" {{ old('asset_condition', $asset->asset_condition) == 'Under Repair' ? 'selected' : '' }}>Under Repair</option>
                        </select>
                        @error('asset_condition')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $asset->notes) }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Asset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection