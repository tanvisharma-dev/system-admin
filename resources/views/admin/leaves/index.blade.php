@extends('layouts.admin')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Leave Management</h1>
        <a href="{{ route('leaves.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Apply for Leave
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Leave Applications</h6>
        </div>
        <div class="card-body">
            @if ($leaves->count() > 0)

                {{-- 🔎 Search bar --}}
                <div class="d-flex justify-content-start" style="margin-bottom: -65px;">
                    <form action="{{ route('leaves.index') }}" method="GET" class="d-flex align-items-center">
                        <input type="text" name="search" class="form-control me-2"
                               style="width: 280px; max-width: 40vw;"
                               placeholder="Search leaves..."
                               value="{{ request('search') }}">
                        <button type="submit" class="btn btn-outline-secondary me-2 text-secondary">Search</button>
                        <a href="{{ route('leaves.index') }}" class="btn btn-outline-secondary">Clear</a>
                    </form>
                </div>

                <div class="table-responsive">
                    <table id="leavesTable"
                        class="table table-striped align-middle"
                        data-toggle="table"
                        data-toolbar="#toolbar"
                        data-show-refresh="true"
                        data-show-toggle="true"
                        data-show-columns="true"
                        data-show-columns-toggle-all="true"
                        data-show-export="true"
                        data-pagination="false" {{-- Laravel handles pagination --}}
                        data-click-to-select="true">
                        <thead class="table-light">
                            <tr>
                                <th>Employee (ID)</th>
                                <th>Leave Type</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Days</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaves as $leave)
                            <tr>
                                <td>{{ $leave->employee->name ?? 'N/A' }} ({{ $leave->employee->employee_id ?? 'N/A' }})</td>
                                <td>{{ $leave->leave_type }}</td>
                                <td>{{ $leave->from_date->format('d M, Y') }}</td>
                                <td>{{ $leave->to_date->format('d M, Y') }}</td>
                                <td>{{ $leave->days }}</td>
                                <td>
                                    @if($leave->status == 'Approved')
                                        <span class="badge bg-success">{{ $leave->status }}</span>
                                    @elseif($leave->status == 'Rejected')
                                        <span class="badge bg-danger">{{ $leave->status }}</span>
                                    @else
                                        <span class="badge bg-warning text-dark">{{ $leave->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $leave->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{ $leave->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this leave application?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('leaves.destroy', $leave->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- ✅ Laravel pagination --}}
                <div class="mt-3">
                    {{ $leaves->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>

            @else
                <div class="text-center py-4">
                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                    <p class="lead">No leave applications found.</p>
                    <a href="{{ route('leaves.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Apply for Leave
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/export/bootstrap-table-export.min.js"></script>
<script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>

<script>
$(function () {
    $('#leavesTable').bootstrapTable();

    // Refresh button reloads page (preserves query string)
    $(document).on('click', '.fixed-table-toolbar button[name="refresh"]', function (e) {
        e.preventDefault();
        window.location.href = window.location.pathname + window.location.search;
    });
});
</script>
@endpush
