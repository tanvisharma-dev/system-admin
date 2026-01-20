@extends('layouts.admin')

@section('title', 'Edit Project')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Project</h1>
        <a href="{{ route('projects.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Projects
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold">Project Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('projects.update', $project->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Project Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $project->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="client_name">Client Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name" name="client_name" value="{{ old('client_name', $project->client_name) }}" required>
                            @error('client_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Client Details Section -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <h6 class="text-info mb-3"><i class="fas fa-user-tie"></i> Client Details</h6>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="client_address">Client Address</label>
                            <textarea class="form-control @error('client_address') is-invalid @enderror" id="client_address" name="client_address" rows="3">{{ old('client_address', $project->client_address) }}</textarea>
                            @error('client_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="client_phone">Client Phone</label>
                            <input type="text" class="form-control @error('client_phone') is-invalid @enderror" id="client_phone" name="client_phone" value="{{ old('client_phone', $project->client_phone) }}">
                            @error('client_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="client_email">Client Email</label>
                            <input type="email" class="form-control @error('client_email') is-invalid @enderror" id="client_email" name="client_email" value="{{ old('client_email', $project->client_email) }}">
                            @error('client_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">Start Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', $project->start_date->format('Y-m-d')) }}" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">End Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', $project->end_date->format('Y-m-d')) }}" required>
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="project_manager">Project Manager <span class="text-danger">*</span></label>
                            <select class="form-control @error('project_manager') is-invalid @enderror" id="project_manager" name="project_manager" required>
                                <option value="">Select Project Manager</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}" {{ old('project_manager', $project->project_manager) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }} ({{ $employee->designation }})
                                    </option>
                                @endforeach
                            </select>
                            @error('project_manager')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Select Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ old('status', $project->status) == $status ? 'selected' : '' }}>
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
                            <textarea class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" rows="3">{{ old('remarks', $project->remarks) }}</textarea>
                            @error('remarks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Project
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Validate end date is after start date
    document.getElementById('start_date').addEventListener('change', function() {
        document.getElementById('end_date').min = this.value;
    });

    // Set initial min value for end date
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('end_date').min = document.getElementById('start_date').value;
    });
</script>
@endsection