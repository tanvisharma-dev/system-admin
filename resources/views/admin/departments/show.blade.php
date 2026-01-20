@extends('layouts.admin')

@section('title', 'Department Details')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Department Details</h1>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('departments.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Departments
        </a>
        <a href="{{ route('departments.edit', $department) }}" class="btn btn-primary">
            <i class="fas fa-edit"></i> Edit Department
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Department Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="dataTable-dept-info">
                    <tbody>
                        <tr>
                            <th style="width: 30%">ID:</th>
                            <td>{{ $department->id }}</td>
                        </tr>
                        <tr>
                            <th>Name:</th>
                            <td>{{ $department->name }}</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{{ $department->description ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                @if ($department->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created At:</th>
                            <td>{{ $department->created_at->format('M d, Y h:i A') }}</td>
                        </tr>
                        <tr>
                            <th>Updated At:</th>
                            <td>{{ $department->updated_at->format('M d, Y h:i A') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Employees in Department</h5>
                <span class="badge bg-primary">{{ $department->employees->count() }}</span>
            </div>
            <div class="card-body">
                @if ($department->employees->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable-dept-employees">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($department->employees as $employee)
                                    <tr>
                                        <td>{{ $employee->employee_id }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->designation ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <p class="lead">No employees in this department yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection