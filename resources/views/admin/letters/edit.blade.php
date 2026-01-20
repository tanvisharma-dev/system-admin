@extends('layouts.admin')

@section('title', 'Edit Letter')

@section('styles')
<!-- Include Summernote CSS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Edit Letter</h1>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('letters.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Letters
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('letters.update', $letter) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="employee_id" class="form-label">Employee</label>
                <select name="employee_id" id="employee_id" class="form-control @error('employee_id') is-invalid @enderror" required>
                    <option value="">Select Employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('employee_id', $letter->employee_id) == $employee->id ? 'selected' : '' }}>
                            {{ $employee->name }} ({{ $employee->employee_id ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="letter_type" class="form-label">Letter Type</label>
                <select name="letter_type" id="letter_type" class="form-control @error('letter_type') is-invalid @enderror" required>
                    <option value="">Select Letter Type</option>
                    @foreach($letterTypes as $value => $label)
                        <option value="{{ $value }}" {{ old('letter_type', $letter->letter_type) == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('letter_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="content" class="form-control summernote @error('content') is-invalid @enderror" rows="10" required>{{ old('content', $letter->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="send_via" class="form-label">Send Via</label>
                <select name="send_via" id="send_via" class="form-control @error('send_via') is-invalid @enderror" required>
                    <option value="">Select Send Method</option>
                    @foreach($sendViaOptions as $value => $label)
                        <option value="{{ $value }}" {{ old('send_via', $letter->send_via) == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('send_via')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Letter
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

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300,
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
    });
</script>
@endsection