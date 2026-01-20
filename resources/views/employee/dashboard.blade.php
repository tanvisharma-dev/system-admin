@extends('layouts.employee')



@section('title', 'Dashboard')



@section('content')

<div class="row mb-4">

    <div class="col-12">

        <div class="card welcome-card">

            <div class="card-body p-4">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <h1 class="mb-2">

                            <i class="fas fa-sun me-2"></i>

                            Good {{ date('H') < 12 ? 'Morning' : (date('H') < 17 ? 'Afternoon' : 'Evening') }}, {{ $employee->name }}!

                        </h1>

                        <p class="mb-0 opacity-75">

                            Welcome back to your employee dashboard. Here's your overview for today.

                        </p>

                    </div>

                    <div class="col-md-4 text-end">

                        @if($employee->profile_photo)

                            <img src="{{ asset('storage/employees/photos' . $employee->profile_photo) }}" alt="Profile" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; border: 4px solid rgba(255,255,255,0.3);">

                        @else

                            <div class="rounded-circle bg-white text-primary d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px; font-size: 2.5rem; opacity: 0.9;">

                                {{ substr($employee->name, 0, 1) }}

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<!-- Statistics Cards -->

<!-- Stats Cards Row -->
<div class="row mb-4">

    <!-- Attendance Rate -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <div class="stats-icon mb-3">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3 class="mb-2">{{ $attendanceStats['attendance_percentage'] }}%</h3>
                <p class="mb-0">Attendance Rate</p>
                <small>This Month</small>
            </div>
        </div>
    </div>

    <!-- Present Days -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <div class="stats-icon mb-3">
                    <i class="fas fa-user-check"></i>
                </div>
                <h3 class="mb-2">{{ $attendanceStats['present_days'] }}</h3>
                <p class="mb-0">Present Days</p>
                <small>This Month</small>
            </div>
        </div>
    </div>

    <!-- Pending Leaves -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <div class="stats-icon mb-3">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <h3 class="mb-2">{{ $pendingLeaves->count() }}</h3>
                <p class="mb-0">Pending Leaves</p>
                <small>Awaiting Approval</small>
            </div>
        </div>
    </div>

    <!-- Latest Salary -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stats-card">
            <div class="card-body text-center">
                <div class="stats-icon mb-3">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <h3 class="mb-2">₹{{ $latestSalary ? number_format($latestSalary->net_salary, 0) : '0' }}</h3>
                <p class="mb-0">Latest Salary</p>
                <small>{{ $latestSalary ? $latestSalary->month : 'N/A' }}</small>
            </div>
        </div>
    </div>

</div>

<!-- Styles -->
<style>
/* Stats Cards */
.stats-card {
    border: none;
    border-radius: 10px;
    background: #ffffff;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    padding: 0.8rem;
    height: 100%;
}

.stats-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.12);
}

.stats-card .card-body {
    padding: 1rem;
}

.stats-icon {
    font-size: 1.6rem;
    color: #2563eb;
    background: rgba(37, 99, 235, 0.08);
    border-radius: 6px;
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.8rem;
}

.stats-card h3 {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 0.3rem;
    color: #1e293b;
}

.stats-card p {
    font-size: 0.9rem;
    font-weight: 500;
    margin: 0;
    color: #475569;
}

.stats-card small {
    font-size: 0.8rem;
    color: #64748b;
}
</style>




<div class="row">

    <!-- Today's Status -->

    <div class="col-lg-8 mb-4">

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h5 class="mb-0"><i class="fas fa-calendar-day me-2"></i>Today's Status</h5>

                <span class="badge bg-primary">{{ date('l, F j, Y') }}</span>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6">

                        <div class="d-flex align-items-center mb-3">

                            <div class="me-3">

                                @if($todayAttendance)

                                    @if($todayAttendance->status == 'P')

                                        <div class="rounded-circle bg-success d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">

                                            <i class="fas fa-check text-white"></i>

                                        </div>

                                    @elseif($todayAttendance->status == 'A')

                                        <div class="rounded-circle bg-danger d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">

                                            <i class="fas fa-times text-white"></i>

                                        </div>

                                    @elseif($todayAttendance->status == 'L')

                                        <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">

                                            <i class="fas fa-calendar-times text-white"></i>

                                        </div>

                                    @elseif($todayAttendance->status == 'HL')

                                        <div class="rounded-circle bg-info d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">

                                            <i class="fas fa-clock text-white"></i>

                                        </div>

                                    @elseif($todayAttendance->status == 'WFH')

                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">

                                            <i class="fas fa-home text-white"></i>

                                        </div>

                                    @endif

                                @else

                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">

                                        <i class="fas fa-question text-white"></i>

                                    </div>

                                @endif

                            </div>

                            <div>

                                <h6 class="mb-1">Attendance Status</h6>

                                <p class="mb-0 text-muted">

                                    @if($todayAttendance)

                                        @switch($todayAttendance->status)

                                            @case('P')

                                                <span class="badge bg-success">Present</span>

                                                @break

                                            @case('A')

                                                <span class="badge bg-danger">Absent</span>

                                                @break

                                            @case('L')

                                                <span class="badge bg-warning">Leave</span>

                                                @break

                                            @case('HL')

                                                <span class="badge bg-info">Half Day</span>

                                                @break

                                            @case('WFH')

                                                <span class="badge bg-primary">Work From Home</span>

                                                @break

                                        @endswitch

                                    @else

                                        <span class="badge bg-secondary">Not Marked</span>

                                    @endif

                                </p>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        @if($todayAttendance && $todayAttendance->hours)

                            <div class="d-flex align-items-center mb-3">

                                <div class="me-3">

                                    <div class="rounded-circle bg-info d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">

                                        <i class="fas fa-clock text-white"></i>

                                    </div>

                                </div>

                                <div>

                                    <h6 class="mb-1">Hours Worked</h6>

                                    <p class="mb-0 text-muted">{{ $todayAttendance->hours }} hours</p>

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

                

                @if($todayAttendance && $todayAttendance->comment)

                    <div class="alert alert-info mb-0">

                        <strong>Comment:</strong> {{ $todayAttendance->comment }}

                    </div>

                @endif

            </div>

        </div>



        <!-- Recent Attendance -->

         

    </div>



    <!-- Quick Info Sidebar -->

    <div class="col-lg-4">

        <!-- Employee Info -->

        <div class="card mb-4">

            <div class="card-header">

                <h5 class="mb-0"><i class="fas fa-user me-2"></i>My Information</h5>

            </div>

            <div class="card-body">

                <div class="text-center mb-3">

                    @if($employee->profile_photo)

                        <img src="{{ asset('storage/' . $employee->profile_photo) }}" alt="Profile" class="rounded-circle mb-2" style="width: 80px; height: 80px; object-fit: cover;">

                    @else

                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-2" style="width: 80px; height: 80px; font-size: 2rem;">

                            {{ substr($employee->name, 0, 1) }}

                        </div>

                    @endif

                    <h6 class="mb-1">{{ $employee->name }}</h6>

                    <p class="text-muted mb-0">{{ $employee->designation ?? 'N/A' }}</p>

                </div>



                <hr>



                <div class="row text-center">

                    <div class="col-6">

                        <small class="text-muted">Employee ID</small>

                        <div class="fw-bold">{{ $employee->employee_id }}</div>

                    </div>

                    <div class="col-6">

                        <small class="text-muted">Department</small>

                        <div class="fw-bold">{{ $employee->department->name ?? 'N/A' }}</div>

                    </div>

                </div>



                <hr>



                <div class="text-center">

                    <a href="{{ route('employee.profile') }}" class="btn btn-outline-primary btn-sm">

                        <i class="fas fa-user me-1"></i> View Full Profile

                    </a>

                </div>

            </div>

        </div>



        <!-- Pending Leaves -->

        @if($pendingLeaves->count() > 0)

        <div class="card mb-4">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h5 class="mb-0"><i class="fas fa-calendar-times me-2"></i>Pending Leaves</h5>

                <span class="badge bg-warning">{{ $pendingLeaves->count() }}</span>

            </div>

            <div class="card-body">

                @foreach($pendingLeaves as $leave)

                    <div class="d-flex justify-content-between align-items-center {{ !$loop->last ? 'mb-3 pb-3 border-bottom' : '' }}">

                        <div>

                            <h6 class="mb-1">{{ $leave->leave_type }}</h6>

                            <small class="text-muted">

                                {{ \Carbon\Carbon::parse($leave->from_date)->format('M d') }} - 

                                {{ \Carbon\Carbon::parse($leave->to_date)->format('M d, Y') }}

                            </small>

                        </div>

                        <span class="badge bg-warning">Pending</span>

                    </div>

                @endforeach

                <div class="text-center mt-3">

                    <a href="{{ route('employee.leaves') }}" class="btn btn-outline-primary btn-sm">

                        <i class="fas fa-calendar-alt me-1"></i> View All Leaves

                    </a>

                </div>

            </div>

        </div>

        @endif



        <!-- Quick Links -->

        <div class="card">

            <div class="card-header">

                <h5 class="mb-0"><i class="fas fa-external-link-alt me-2"></i>Quick Links</h5>

            </div>

            <div class="card-body">

                <div class="d-grid gap-2">

                    <a href="{{ route('employee.attendance') }}" class="btn btn-outline-primary btn-sm">

                        <i class="fas fa-calendar-check me-2"></i> My Attendance

                    </a>

                    <a href="{{ route('employee.leaves') }}" class="btn btn-outline-primary btn-sm">

                        <i class="fas fa-calendar-alt me-2"></i> My Leaves

                    </a>

                    <a href="{{ route('employee.salary') }}" class="btn btn-outline-primary btn-sm">

                        <i class="fas fa-money-bill-alt me-2"></i> My Salary

                    </a>

                    <a href="{{ route('employee.profile') }}" class="btn btn-outline-primary btn-sm">

                        <i class="fas fa-user me-2"></i> My Profile

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection



@section('scripts')

<script>

$(document).ready(function() {

    // Add some animations

    $('.stats-card').hover(function() {

        $(this).addClass('shadow-lg');

    }, function() {

        $(this).removeClass('shadow-lg');

    });

});

</script>

@endsection

