@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="fas fa-plus text-success me-2"></i> Add Daily Task
            </h5>
            <a href="{{ route('daily_tasks.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('daily_tasks.store') }}">
                @csrf

                {{-- Employee --}}
                <div class="mb-3">
                    <label for="employee_id" class="form-label">Employee</label>
                    <select class="form-select @error('employee_id') is-invalid @enderror" 
                            id="employee_id" name="employee_id" required>
                        <option value="">-- Select Employee --</option>
                        @foreach($employees as $emp)
                            <option value="{{ $emp->id }}" {{ old('employee_id') == $emp->id ? 'selected' : '' }}>
                                {{ $emp->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Date --}}
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" 
                           class="form-control @error('date') is-invalid @enderror" 
                           id="date" name="date" 
                           value="{{ old('date', date('Y-m-d')) }}" required>
                    @error('date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Task Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Task Description</label>
                    <textarea name="description" 
                              id="description" 
                              rows="3" 
                              class="form-control @error('description') is-invalid @enderror" 
                              required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" name="status" required>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
