@extends('layouts.employee')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Salary Details</h2>

    @if($salaries->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Month</th>
                        <th>Pay Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salaries as $salary)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($salary->pay_date)->format('F Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($salary->pay_date)->format('d M Y') }}</td>
                            <td>₹{{ number_format($salary->amount, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $salary->status === 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($salary->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $salaries->links() }}
        </div>
    @else
        <p>No salary records found.</p>
    @endif
</div>
@endsection
