@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Salary Details</h1>
        <a href="{{ route('salaries.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>


    <!-- Salary Details Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Salary Information</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('salaries.edit', $salary->id) }}">
                        <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                        Edit
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('salaries.destroy', $salary->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this salary record?')">
                            <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Employee:</strong></label>
                        <p>{{ $salary->employee->name }}</p>
                    </div>
                    <div class="form-group">
                        <label><strong>Salary Month:</strong></label>
                        <p>{{ $salary->month }}</p>
                    </div>
                    <div class="form-group">
                        <label><strong>Basic Salary:</strong></label>
                        <p>{{ number_format($salary->basic, 2) }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Deductions:</strong></label>
                        <p>{{ number_format($salary->deductions, 2) }}</p>
                    </div>
                    <div class="form-group">
                        <label><strong>Net Salary:</strong></label>
                        <p>{{ number_format($salary->net_salary, 2) }}</p>
                    </div>
                    <div class="form-group">
                        <label><strong>Pay Date:</strong></label>
                        <p>{{ $salary->pay_date ? date('d M Y', strtotime($salary->pay_date)) : 'Not Set' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Employee Details Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Employee Information</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Name:</strong></label>
                        <p>{{ $salary->employee->name }}</p>
                    </div>
                    <div class="form-group">
                        <label><strong>Email:</strong></label>
                        <p>{{ $salary->employee->email }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Phone:</strong></label>
                        <p>{{ $salary->employee->phone ?? 'N/A' }}</p>
                    </div>

                    <!-- status field does not in mam's database 
                    <div class="form-group">
                        <label><strong>Status:</strong></label>
                        <p>
                            @if($salary->employee->status == 1)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </p>
                    </div> -->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection