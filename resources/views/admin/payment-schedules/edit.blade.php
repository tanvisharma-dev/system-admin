@extends('layouts.admin')

@section('title', 'Edit Payment Schedule')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Payment Schedule</h1>
        <a href="{{ route('payment-schedules.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Payment Schedules
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold">Payment Schedule Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('payment-schedules.update', $paymentSchedule->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="project_id">Project <span class="text-danger">*</span></label>
                            <select class="form-control @error('project_id') is-invalid @enderror" id="project_id" name="project_id" required>
                                <option value="">Select Project</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('project_id', $paymentSchedule->project_id) == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }} - {{ $project->client_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="module_name">Module Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('module_name') is-invalid @enderror" id="module_name" name="module_name" value="{{ old('module_name', $paymentSchedule->module_name) }}" required>
                            @error('module_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="amount">Amount <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $paymentSchedule->amount) }}" required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="due_date">Due Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date', $paymentSchedule->due_date->format('Y-m-d')) }}" required>
                            @error('due_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Select Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ old('status', $paymentSchedule->status) == $status ? 'selected' : '' }}>
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

                <!-- Conditional paid date field -->
                <div class="row mb-3" id="paidDateRow" style="display: {{ old('status', $paymentSchedule->status) == 'Paid' ? 'block' : 'none' }};">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="paid_date">Paid Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('paid_date') is-invalid @enderror" id="paid_date" name="paid_date" value="{{ old('paid_date', $paymentSchedule->paid_date ? $paymentSchedule->paid_date->format('Y-m-d') : '') }}">
                            @error('paid_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $paymentSchedule->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Payment Schedule
                        </button>
                        <a href="{{ route('payment-schedules.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
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
    // Toggle paid date field based on status
    $('#status').change(function() {
        const status = $(this).val();
        const paidDateRow = $('#paidDateRow');
        const paidDateField = $('#paid_date');
        
        if (status === 'Paid') {
            paidDateRow.show();
            paidDateField.prop('required', true);
            if (!paidDateField.val()) {
                paidDateField.val(new Date().toISOString().split('T')[0]);
            }
        } else {
            paidDateRow.hide();
            paidDateField.prop('required', false);
            if (status !== 'Paid') {
                paidDateField.val('');
            }
        }
    });
    
    // Trigger change event on page load
    $('#status').trigger('change');
});
</script>
@endsection
