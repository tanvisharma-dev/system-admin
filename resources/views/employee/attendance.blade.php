@extends('layouts.employee')

@section('title', 'My Attendance')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-md-4">
            <form action="{{ route('employee.attendance') }}" method="GET" class="d-flex gap-2">
                <select name="month" class="form-select">
                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                        </option>
                    @endfor
                </select>

                <select name="year" class="form-select">
                    @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Filter
                </button>

                <a href="{{ route('employee.attendance') }}" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </a>
            </form>
        </div>
    </div>

    @if($attendanceRecords->count() > 0)
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Attendance for {{ request('month') ? \Carbon\Carbon::create()->month(request('month'))->format('F') : \Carbon\Carbon::now()->format('F') }} {{ request('year') ?? date('Y') }}</h5>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Hours</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendanceRecords as $attendance)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d-m-Y') }}</td>
                                <td>
                                    @switch($attendance->status)
                                        @case('Present')
                                            <span class="badge bg-success">Present</span>
                                            @break
                                        @case('Absent')
                                            <span class="badge bg-danger">Absent</span>
                                            @break
                                        @case('WFH')
                                            <span class="badge bg-primary">WFH</span>
                                            @break
                                        @case('Opr')
                                            <span class="badge bg-warning">Opr</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary">N/A</span>
                                    @endswitch
                                </td>
                                <td>{{ $attendance->hours ?? 'N/A' }}</td>
                                <td>{{ $attendance->comment ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="d-flex justify-content-end p-3">
                    {{ $attendanceRecords->withQueryString()->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info text-center">
            No attendance records found for the selected month/year.
        </div>
    @endif
</div>
@endsection
