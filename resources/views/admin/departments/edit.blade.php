@extends('layouts.admin')

@section('title', 'Edit Department')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Edit Department</h1>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Departments
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('departments.update', $department) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Department Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $department->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Enter a unique department name (e.g., Human Resources, Finance, IT)</div>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $department->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Provide a brief description of the department's responsibilities and functions</div>
            </div>
            
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                    <option value="1" {{ old('status', $department->status) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $department->status) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Department
                </button>
            </div>
        </form>
    </div>
</div>
@endsection