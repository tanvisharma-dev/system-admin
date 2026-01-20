@extends('layouts.admin')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Salary Management</h1>
        <a href="{{ route('salaries.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus"></i> Add New Salary Record
        </a>
    </div>

    <!-- Filter Section -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold text-primary">
                Filter Salary Records
                @if(request('month') || request('year') || request('employee'))
                    <span class="badge bg-info text-dark ms-2">Filters Active</span>
                @endif
            </h6>
            @if(request('month') || request('year') || request('employee'))
                <a href="{{ route('salaries.index') }}" class="btn btn-sm btn-light border">
                    <i class="fas fa-times"></i> Clear
                </a>
            @endif
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('salaries.index') }}" id="filterForm">
                <div class="row g-3 align-items-end">
                    <!-- Month -->
                    <div class="col-md-3">
                        <label for="month" class="form-label">Month</label>
                        <select name="month" id="month" class="form-select">
                            <option value="">All Months</option>
                            @foreach($availableMonths as $monthNum => $monthName)
                                <option value="{{ $monthNum }}" {{ request('month') == $monthNum ? 'selected' : '' }}>
                                    {{ $monthName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Year -->
                    <div class="col-md-3">
                        <label for="year" class="form-label">Year</label>
                        <select name="year" id="year" class="form-select">
                            <option value="">All Years</option>
                            @foreach($availableYears as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Employee -->
                    <div class="col-md-3">
                        <label for="employee" class="form-label">Employee</label>
                        <!-- <input type="text" name="employee" id="employee" class="form-control"
                               value="{{ request('employee') }}" placeholder="Search by name or ID"> -->
                                <select name="employee" id="employee" class="form-control">
                                    <option value="" selected disabled>-- Select Employee --</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" 
                                            {{ request('employee') == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->name }} ({{ $employee->id }})
                                        </option>
                                    @endforeach
                                </select>

                    </div>

                    <!-- Actions -->
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="fas fa-filter"></i> Apply
                        </button>
                        <a href="{{ route('salaries.index') }}" class="btn btn-outline-secondary flex-fill">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Results Summary -->
    @if(request('month') || request('year') || request('employee'))
        <div class="alert alert-info border-0 shadow-sm">
            <strong>Filtered Results:</strong> 
            Showing {{ $salaries->total() }} record(s)
            @if(request('month'))
                for {{ $availableMonths[request('month')] }}
            @endif
            @if(request('year'))
                {{ request('month') ? request('year') : 'for year ' . request('year') }}
            @endif
            @if(request('employee'))
                for employee <strong>{{ request('employee') }}</strong>
            @endif
        </div>
    @endif

    <!-- DataTable -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0">
            <h6 class="m-0 fw-bold text-primary">{{ $pageTitle ?? 'All Salary Records' }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Employee</th>
                            <th>Month</th>
                            <th>Basic Salary</th>
                            <th>Deductions</th>
                            <th>Net Salary</th>
                            <th>Pay Date</th>
                            <th>Salary Slip</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salaries as $salary)
                        <tr>
                            <td>{{ $salary->id }}</td>
                            <td>{{ $salary->employee?->name ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $monthYear = $salary->month;
                                    if (preg_match('/^(\d{4})-(\d{2})$/', $monthYear, $matches)) {
                                        $year = $matches[1];
                                        $month = $matches[2];
                                        $monthName = DateTime::createFromFormat('!m', $month)->format('F');
                                        echo $monthName . ' ' . $year;
                                    } else {
                                        echo $monthYear;
                                    }
                                @endphp
                            </td>
                            <td>{{ number_format($salary->basic, 2) }}</td>
                            <td>{{ number_format($salary->deductions, 2) }}</td>
                            <td>{{ number_format($salary->net_salary, 2) }}</td>
                            <td>{{ $salary->pay_date ? date('d M Y', strtotime($salary->pay_date)) : 'Not Set' }}</td>
                            <td>
                                @if($salary->salary_slip_path && file_exists(storage_path('app/public/' . $salary->salary_slip_path)))
                                    <a href="{{ asset('storage/' . $salary->salary_slip_path) }}" class="btn btn-sm btn-success" target="_blank">
                                        <i class="fas fa-download"></i>
                                    </a>
                                @else
                                    <span class="text-muted">No slip</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('salaries.show', $salary->id) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('salaries.edit', $salary->id) }}" class="btn btn-sm btn-warning text-white">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form method="POST" action="{{ route('salaries.destroy', $salary->id) }}" onsubmit="return confirm('Delete this record?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger text-white" type="submit">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-3 d-flex justify-content-center">
                    {{ $salaries->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // disable datatable’s own pagination/info, keep Laravel’s
    $('#dataTable').DataTable({
        "paging": false,
        "info": false,
        "ordering": false
    });

    // Auto-submit filters when dropdowns change
    $('#month, #year').on('change', function() {
        $('#filterForm').submit();
    });
});
</script>
@endsection
