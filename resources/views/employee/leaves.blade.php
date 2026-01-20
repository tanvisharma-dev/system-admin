@extends('layouts.employee')

@section('title', 'Leave Applications')

@section('content')

<div class="container mt-4">

    <h2>Leave Applications</h2>

    {{-- Filters --}}
    <div class="mb-3">
        <form method="GET" action="{{ route('employee.leaves') }}" class="form-inline">

            <div class="form-group mr-2">
                <label for="status" class="mr-2">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div class="form-group mr-2">
                <label for="leave_type" class="mr-2">Leave Type</label>
                <select name="leave_type" id="leave_type" class="form-control">
                    <option value="all" {{ request('leave_type') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="Sick Leave" {{ request('leave_type') == 'Sick Leave' ? 'selected' : '' }}>Sick Leave</option>
                    <option value="Casual Leave" {{ request('leave_type') == 'Casual Leave' ? 'selected' : '' }}>Casual Leave</option>
                    <option value="Annual Leave" {{ request('leave_type') == 'Annual Leave' ? 'selected' : '' }}>Annual Leave</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>

    {{-- Leave Table --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Leave Type</th>
                <th>From</th>
                <th>To</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($leaves as $leave)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $leave->leave_type }}</td>
                    <td>{{ \Carbon\Carbon::parse($leave->from_date)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($leave->to_date)->format('Y-m-d') }}</td>
                    <td>
                        @if($leave->status == 'pending')
                            <span class="badge badge-warning">Pending</span>
                        @elseif($leave->status == 'approved')
                            <span class="badge badge-success">Approved</span>
                        @elseif($leave->status == 'rejected')
                            <span class="badge badge-danger">Rejected</span>
                        @else
                            <span class="badge badge-secondary">{{ ucfirst($leave->status) }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No leave records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $leaves->withQueryString()->links() }}

</div>

@endsection
