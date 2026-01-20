@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Preview Uploaded Attendance</h1>
    </div>

    <!-- Alert Messages -->
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

    <!-- Uploaded Results Summary -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Import Summary</h6>
                </div>
                <div class="card-body">
                    <p><strong>Success:</strong> {{ $results['success_count'] }} records imported successfully.</p>
                    <p><strong>Skipped:</strong> {{ $results['skipped_count'] }} records.</p>
                    @if(!empty($results['errors']))
                        <strong>Errors:</strong>
                        <ul>
                            @foreach($results['errors'] as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Attendance Records -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Attendance Records</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Hours</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentAttendances as $attendance)
                                    <tr>
                                        <td>{{ $attendance->employee->name ?? 'N/A' }}</td>
                                        <td>{{ date('d M Y', strtotime($attendance->date)) }}</td>
                                        <td>{{ $attendance->status }}</td>
                                        <td>{{ $attendance->hours ?? '-' }}</td>
                                        <td>{{ $attendance->comment ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('table').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "responsive": true
        });
    });
</script>
@endsection

