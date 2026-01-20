@extends('layouts.admin')

@section('title', 'Upload Document')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Upload New Document</h5>
                <a href="{{ route('documents.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Documents
                </a>
            </div>
            <div class="card-body">
                <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="employee_id" class="form-label">Employee <span class="text-danger">*</span></label>
                        <select class="form-select @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id" required>
                            <option value="">Select Employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="document_type" class="form-label">Document Type <span class="text-danger">*</span></label>
                        <select class="form-select @error('document_type') is-invalid @enderror" id="document_type" name="document_type" required>
                            <option value="">Select Document Type</option>
                            @foreach ($documentTypes as $type)
                                <option value="{{ $type }}" {{ old('document_type') == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        @error('document_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="file" class="form-label">File Upload <span class="text-danger">*</span></label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" required>
                        <small class="form-text text-muted">Allowed file types: PDF, DOCX (Max: 2MB)</small>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload"></i> Upload Document
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection