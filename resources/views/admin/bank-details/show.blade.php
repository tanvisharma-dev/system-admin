@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bank Details</h1>
        <a href="{{ route('bank-details.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <!-- Bank Details Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Bank Information</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('bank-details.edit', $bankDetail->id) }}">
                        <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                        Edit
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('bank-details.destroy', $bankDetail->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete these bank details?')">
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
                        <p>{{ $bankDetail->employee->name }}</p>
                    </div>
                    <div class="form-group">
                        <label><strong>Bank Name:</strong></label>
                        <p>{{ $bankDetail->bank_name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Account Number:</strong></label>
                        <p>{{ $bankDetail->account_number }}</p>
                    </div>
                    <div class="form-group">
                        <label><strong>IFSC Code:</strong></label>
                        <p>{{ $bankDetail->ifsc_code }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>UPI ID:</strong></label>
                        <p>{{ $bankDetail->uan_number ?? 'Not Provided' }}</p>
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
                        <p>{{ $bankDetail->employee->name }}</p>
                    </div>
                    <div class="form-group">
                        <label><strong>Email:</strong></label>
                        <p>{{ $bankDetail->employee->email }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><strong>Phone:</strong></label>
                        <p>{{ $bankDetail->employee->phone ?? 'N/A' }}</p>
                    </div>

                    <!-- status not found in mam's db
                    <div class="form-group">
                        <label><strong>Status:</strong></label>
                        <p>
                            @if($bankDetail->employee->status == 1)
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