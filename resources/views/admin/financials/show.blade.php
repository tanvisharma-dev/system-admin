@extends('layouts.admin')

@section('title', 'Financial Entry Details')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Financial Entry Details</h1>
        <div>
            <a href="{{ route('financials.edit', $financial) }}" class="btn btn-primary me-2">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('financials.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                {{ $financial->type }} - {{ $financial->category }}
                <span class="float-end">
                    @if($financial->status == 'Paid')
                    <span class="badge bg-success">Paid</span>
                    @else
                    <span class="badge bg-warning text-dark">Pending</span>
                    @endif
                </span>
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 30%">ID:</th>
                            <td>{{ $financial->id }}</td>
                        </tr>
                        <tr>
                            <th>Date:</th>
                            <td>{{ $financial->date->format('d M, Y') }}</td>
                        </tr>
                        <tr>
                            <th>Type:</th>
                            <td>
                                @if($financial->type == 'Income')
                                <span class="badge bg-success">Income</span>
                                @else
                                <span class="badge bg-danger">Expense</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Category:</th>
                            <td>{{ $financial->category }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 30%">Project:</th>
                            <td>
                                @if($financial->project)
                                <a href="{{ route('projects.show', $financial->project) }}">
                                    {{ $financial->project->name }}
                                </a>
                                @else
                                <span class="text-muted">N/A</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Amount:</th>
                            <td>
                                <strong class="{{ $financial->type == 'Income' ? 'text-success' : 'text-danger' }}">
                                    ₹{{ number_format($financial->amount, 2) }}
                                </strong>
                            </td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                @if($financial->status == 'Paid')
                                <span class="badge bg-success">Paid</span>
                                @else
                                <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Payment Mode:</th>
                            <td>{{ $financial->payment_mode ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <h5>Description</h5>
                    <p class="border p-3 rounded bg-light">
                        {{ $financial->description ?? 'No description provided.' }}
                    </p>
                </div>
            </div>

            @if($financial->remarks)
            <div class="row mt-3">
                <div class="col-md-12">
                    <h5>Remarks</h5>
                    <p class="border p-3 rounded bg-light">
                        {{ $financial->remarks }}
                    </p>
                </div>
            </div>
            @endif

            <div class="row mt-4">
                <div class="col-md-12">
                    <form action="{{ route('financials.destroy', $financial) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this financial entry? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger float-end">
                            <i class="fas fa-trash"></i> Delete Entry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection