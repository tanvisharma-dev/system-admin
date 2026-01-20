@extends('layouts.admin')



@section('title', 'Decide Payments')



@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">

            <i class="fas fa-money-bill-wave"></i> Decide Payments

        </h1>

        <a href="{{ route('payment-schedules.create') }}" class="btn btn-primary">

            <i class="fas fa-plus"></i> Add Payment Schedule

        </a>

    </div>



    @if(session('success'))

        <!-- <div class="alert alert-success alert-dismissible fade show" role="alert">

            {{ session('success') }}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div> -->

    @endif



    @if(session('error'))

        <!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">

            {{ session('error') }}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div> -->

    @endif



    <!-- Summary Cards -->

    <div class="row mb-4">

        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-warning shadow h-100 py-2">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">

                                Pending Payments

                            </div>

                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                {{ $paymentSchedules->where('status', 'Pending')->count() }}

                            </div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-clock fa-2x text-gray-300"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-success shadow h-100 py-2">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">

                                Paid Payments

                            </div>

                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                {{ $paymentSchedules->where('status', 'Paid')->count() }}

                            </div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-danger shadow h-100 py-2">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">

                                Overdue Payments

                            </div>

                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                {{ $paymentSchedules->where('status', 'Overdue')->count() }}

                            </div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="col-xl-3 col-md-6 mb-4">

            <div class="card border-left-info shadow h-100 py-2">

                <div class="card-body">

                    <div class="row no-gutters align-items-center">

                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">

                                Total Amount

                            </div>

                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                ₹{{ number_format($paymentSchedules->sum('amount'), 2) }}

                            </div>

                        </div>

                        <div class="col-auto">

                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <div class="card shadow mb-4">

        <div class="card-header py-3">

            <h6 class="m-0 font-weight-bold text-primary">All Payment Schedules</h6>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped table-bordered" 

                       data-toggle="table" data-toolbar="#toolbar" data-search="true"

                       data-show-refresh="true" data-show-toggle="true"

                       data-show-fullscreen="false" data-show-columns="true"

                       data-show-columns-toggle-all="true" data-detail-view="false"

                       data-show-export="true" data-click-to-select="true"

                       data-detail-formatter="detailFormatter"

                       data-minimum-count-columns="2" data-show-pagination-switch="true"

                       data-pagination="true" data-id-field="id"

                       data-page-list="[10, 25, 50, 100, 500, 1000 ,'all']"

                       data-show-footer="true" data-response-handler="responseHandler" 

                       id="dataTable" width="100%" cellspacing="0">

                    <thead>

                        <tr>

                            <th>Project</th>

                            <th>Module Name</th>

                            <th>Amount</th>

                            <th>Due Date</th>

                            <th>Status</th>

                            <th>Paid Date</th>

                            <th>Notes</th>

                            <th>Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($paymentSchedules as $schedule)

                            <tr class="{{ $schedule->status === 'Overdue' ? 'table-danger' : ($schedule->status === 'Paid' ? 'table-success' : '') }}">

                               <td>
    <strong>{{ $schedule->project?->name ?? 'N/A' }}</strong>
    <small class="text-muted">{{ $schedule->project?->client_name ?? '' }}</small>
</td>


                                <td>{{ $schedule->module_name }}</td>

                                <td>

                                    <strong class="text-success">₹{{ number_format($schedule->amount, 2) }}</strong>

                                </td>

                                <td>

                                    {{ $schedule->due_date->format('d M, Y') }}

                                    @if($schedule->due_date->isPast() && $schedule->status !== 'Paid')

                                        <br><small class="text-danger">

                                            <i class="fas fa-exclamation-triangle"></i> 

                                            {{ $schedule->due_date->diffForHumans() }}

                                        </small>

                                    @endif

                                </td>

                                <td>{!! $schedule->status_badge !!}</td>

                                <td>

                                    @if($schedule->paid_date)

                                        {{ $schedule->paid_date->format('d M, Y') }}

                                    @else

                                        <span class="text-muted">Not paid</span>

                                    @endif

                                </td>

                                <td>

                                    @if($schedule->notes)

                                        {{ Str::limit($schedule->notes, 30) }}

                                    @else

                                        <span class="text-muted">No notes</span>

                                    @endif

                                </td>

                                <td>

                                    <div class="btn-group" role="group">

                                        @if($schedule->status !== 'Paid')

                                            <form action="{{ route('payment-schedules.mark-paid', $schedule->id) }}" method="POST" class="d-inline">

                                                @csrf

                                                @method('PATCH')

                                                <button type="submit" class="btn btn-success btn-sm" 

                                                        onclick="return confirm('Mark this payment as paid?')" 

                                                        title="Mark as Paid">

                                                    <i class="fas fa-check"></i>

                                                </button>

                                            </form>

                                        @endif

                                        

                                        <a href="{{ route('payment-schedules.edit', $schedule->id) }}" 

                                           class="btn btn-warning btn-sm" title="Edit">

                                            <i class="fas fa-edit"></i>

                                        </a>

                                        

                                        <a href="{{ route('payment-schedules.show', $schedule->id) }}" 

                                           class="btn btn-info btn-sm" title="View Details">

                                            <i class="fas fa-eye"></i>

                                        </a>

                                        

                                        <form action="{{ route('payment-schedules.destroy', $schedule->id) }}" method="POST" class="d-inline">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm" 

                                                    onclick="return confirm('Are you sure you want to delete this payment schedule?')"

                                                    title="Delete">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="text-center">

                                    <div class="py-4">

                                        <i class="fas fa-money-bill-wave fa-3x text-gray-300 mb-3"></i>

                                        <p class="text-muted">No payment schedules found</p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            

            <div class="d-flex justify-content-end mt-3">

                {{ $paymentSchedules->links() }}

            </div>

        </div>

    </div>

</div>

@endsection



@section('scripts')

<!-- <script>

    $(document).ready(function() {

        // Auto-hide alerts after 5 seconds

        setTimeout(function() {

            $('.alert').fadeOut('slow');

        }, 5000);

    });

</script> -->

@endsection

