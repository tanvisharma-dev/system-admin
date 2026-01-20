@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Salary Record</h1>
        <a href="{{ route('salaries.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>


    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Salary Information</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('salaries.store') }}">
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
                        <label for="month">Salary Month <span class="text-danger">*</span></label>
                        <input type="month" class="form-control @error('month') is-invalid @enderror" id="month" name="month" value="{{ old('month') }}" required>
                        @error('month')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="basic">Basic Salary <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('basic') is-invalid @enderror" id="basic" name="basic" value="{{ old('basic') }}" step="0.01" min="0" required>
                        @error('basic')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="hra">HRA</label>
                        <input type="number" class="form-control @error('hra') is-invalid @enderror" id="hra" name="hra" value="{{ old('hra', 0) }}" step="0.01" min="0">
                        @error('hra')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="other_allowances">Other Allowances</label>
                        <input type="number" class="form-control @error('other_allowances') is-invalid @enderror" id="other_allowances" name="other_allowances" value="{{ old('other_allowances', 0) }}" step="0.01" min="0">
                        @error('other_allowances')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label for="deductions">Deductions</label>
                        <input type="number" class="form-control @error('deductions') is-invalid @enderror" id="deductions" name="deductions" value="{{ old('deductions', 0) }}" step="0.01" min="0">
                        @error('deductions')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="gross_salary_display">Gross Salary</label>
                        <input type="text" class="form-control" placeholder="Automatic Calculated" id="gross_salary_display" readonly>
                    </div>
                    <div class="col-sm-6">
                        <label for="net_salary_display">Net Salary</label>
                        <input type="text" class="form-control" placeholder="Automatic Calculated" id="net_salary_display" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="pay_date">Pay Date</label>
                        <input type="date" class="form-control @error('pay_date') is-invalid @enderror" id="pay_date" name="pay_date" value="{{ old('pay_date') }}">
                        @error('pay_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-user btn-block">
                    Save Salary Record
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Calculate salaries
        function calculateSalaries() {
            const basic = parseFloat($('#basic').val()) || 0;
            const hra = parseFloat($('#hra').val()) || 0;
            const otherAllowances = parseFloat($('#other_allowances').val()) || 0;
            const deductions = parseFloat($('#deductions').val()) || 0;
            
            const grossSalary = basic + hra + otherAllowances;
            const netSalary = grossSalary - deductions;
            
            $('#gross_salary_display').val(grossSalary.toFixed(2));
            $('#net_salary_display').val(netSalary.toFixed(2));
        }

        // Calculate on input change
        $('#basic, #hra, #other_allowances, #deductions').on('input', calculateSalaries);

        // Calculate on page load
        calculateSalaries();
        
        // Add hidden fields for gross and net salary on form submit
        $('form').on('submit', function() {
            const grossSalary = $('#gross_salary_display').val();
            const netSalary = $('#net_salary_display').val();
            
            // Add hidden fields
            $('<input>').attr({
                type: 'hidden',
                name: 'gross',
                value: grossSalary
            }).appendTo(this);
            
            $('<input>').attr({
                type: 'hidden',
                name: 'net_salary',
                value: netSalary
            }).appendTo(this);
        });
    });
</script>
@endsection
