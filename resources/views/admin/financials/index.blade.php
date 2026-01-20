@extends('layouts.admin')

@section('title', 'Company Financials')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Company Financials</h1>
        <a href="{{ route('financials.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Entry
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">All Financial Entries</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped"
                            data-toggle="table" data-toolbar="#toolbar" data-search="true"
                            data-show-refresh="true" data-show-toggle="true"
                            data-show-fullscreen="false" data-show-columns="true"
                            data-show-columns-toggle-all="true" data-detail-view="false"
                            data-show-export="true" data-click-to-select="true"
                            data-detail-formatter="detailFormatter"
                            data-minimum-count-columns="2" data-show-pagination-switch="true"
                            data-pagination="true" data-id-field="id"
                            data-page-list="[10, 25, 50, 100, 500, 1000 ,'all']"
                            data-show-footer="true" data-response-handler="responseHandler" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Project</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($financials as $financial)
                        <tr>
                            <td>{{ $financial->id }}</td>
                            <td>{{ $financial->date->format('d M, Y') }}</td>
                            <td>
                                @if($financial->type == 'Income')
                                <span class="badge bg-success text-white">Income</span>
                                @else
                                <span class="badge bg-danger text-white">Expense</span>
                                @endif
                            </td>
                            <td>{{ $financial->category }}</td>
                            <td>{{ $financial->project ? $financial->project->name : 'N/A' }}</td>
                            <td>{{ number_format($financial->amount, 2) }}</td>
                            <td>
                                @if($financial->status == 'Paid')
                                <span class="badge bg-success  text-white">Paid</span>
                                @else
                                <span class="badge bg-warning text-white">Pending</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('financials.show', $financial) }}" class="btn btn-sm btn-info d-flex align-items-center h-50">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('financials.edit', $financial) }}" class="btn btn-sm btn-warning  d-flex align-items-center h-50">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('financials.destroy', $financial) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this entry?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No financial entries found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $financials->links() }}
            </div>
        </div>
    </div>
</div>
@endsection