@extends('layouts.admin')

@section('title', 'Payment Schedule Details')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Payment Schedule Details</h1>
        <div>
            <a href="{{ route('payment-schedules.edit', $paymentSchedule->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('payment-schedules.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Payment Schedules
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Payment Schedule Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 30%">ID</th>
                            <td>{{ $paymentSchedule->id }}</td>
                        </tr>
                        <tr>
                            <th>Module Name</th>
                            <td><strong>{{ $paymentSchedule->module_name }}</strong></td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>
                                <strong class="text-success">₹{{ number_format($paymentSchedule->amount, 2) }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <th>Due Date</th>
                            <td>
                                {{ $paymentSchedule->due_date->format('d M, Y') }}
                                @if($paymentSchedule->due_date->isPast() && $paymentSchedule->status !== 'Paid')
                                    <br><small class="text-danger">
                                        <i class="fas fa-exclamation-triangle"></i> 
                                        Overdue by {{ $paymentSchedule->due_date->diffForHumans() }}
                                    </small>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{!! $paymentSchedule->status_badge !!}</td>
                        </tr>
                        @if($paymentSchedule->paid_date)
                            <tr>
                                <th>Paid Date</th>
                                <td>
                                    <strong class="text-success">{{ $paymentSchedule->paid_date->format('d M, Y') }}</strong>
                                </td>
                            </tr>
                        @endif
                        @if($paymentSchedule->notes)
                            <tr>
                                <th>Notes</th>
                                <td>{{ $paymentSchedule->notes }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Created At</th>
                            <td>{{ $paymentSchedule->created_at ? $paymentSchedule->created_at->format('d M, Y H:i') : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Updated At</th>
                            <td>{{ $paymentSchedule->updated_at ? $paymentSchedule->updated_at->format('d M, Y H:i') : 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Project Information -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Project Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Project Name</th>
                            <td><strong>{{ $paymentSchedule->project->name }}</strong></td>
                        </tr>
                        <tr>
                            <th>Client Name</th>
                            <td>{{ $paymentSchedule->project->client_name }}</td>
                        </tr>
                        @if($paymentSchedule->project->client_email)
                            <tr>
                                <th>Client Email</th>
                                <td>
                                    <a href="mailto:{{ $paymentSchedule->project->client_email }}">
                                        {{ $paymentSchedule->project->client_email }}
                                    </a>
                                </td>
                            </tr>
                        @endif
                        @if($paymentSchedule->project->client_phone)
                            <tr>
                                <th>Client Phone</th>
                                <td>
                                    <a href="tel:{{ $paymentSchedule->project->client_phone }}">
                                        {{ $paymentSchedule->project->client_phone }}
                                    </a>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <th>Project Status</th>
                            <td>{!! $paymentSchedule->project->status_badge !!}</td>
                        </tr>
                        <tr>
                            <th>Start Date</th>
                            <td>{{ $paymentSchedule->project->start_date->format('d M, Y') }}</td>
                        </tr>
                        <tr>
                            <th>End Date</th>
                            <td>{{ $paymentSchedule->project->end_date->format('d M, Y') }}</td>
                        </tr>
                    </table>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('projects.show', $paymentSchedule->project->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> View Project Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Card -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if($paymentSchedule->status !== 'Paid')
                                <form action="{{ route('payment-schedules.mark-paid', $paymentSchedule->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-block mb-2" 
                                            onclick="return confirm('Mark this payment as paid?')">
                                        <i class="fas fa-check"></i> Mark as Paid
                                    </button>
                                </form>
                            @else
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle"></i> This payment has been marked as paid on {{ $paymentSchedule->paid_date->format('d M, Y') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('payment-schedules.destroy', $paymentSchedule->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this payment schedule? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block">
                                    <i class="fas fa-trash"></i> Delete Payment Schedule
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Payment Schedules -->
    @php
        $relatedPayments = \App\Models\PaymentSchedule::where('project_id', $paymentSchedule->project_id)
                                                     ->where('id', '!=', $paymentSchedule->id)
                                                     ->orderBy('due_date', 'asc')
                                                     ->get();
    @endphp

    @if($relatedPayments->count() > 0)
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Other Payment Schedules for this Project</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Module Name</th>
                                        <th>Amount</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($relatedPayments as $payment)
                                        <tr class="{{ $payment->status === 'Overdue' ? 'table-danger' : ($payment->status === 'Paid' ? 'table-success' : '') }}">
                                            <td>{{ $payment->module_name }}</td>
                                            <td><strong>₹{{ number_format($payment->amount, 2) }}</strong></td>
                                            <td>{{ $payment->due_date->format('d M, Y') }}</td>
                                            <td>{!! $payment->status_badge !!}</td>
                                            <td>
                                                <a href="{{ route('payment-schedules.show', $payment->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('payment-schedules.edit', $payment->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
