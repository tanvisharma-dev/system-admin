@extends('layouts.admin')

@section('title', 'Student Registrations')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Student Registrations</h1>
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Register New Student
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Student Registrations</h6>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>College</th>
                            <th>Course</th>
                            <th>Seminar</th>
                            <th>Hiring Status</th>
                            <th>Package</th>
                            <th>Joining Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->full_name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ $student->college_name }}</td>
                                <td>{{ $student->course }}</td>
                                <td>{{ $student->seminar->college_name ?? 'N/A' }}</td>
                                <td class="bg-have">{!! $student->hiring_status_badge !!}</td>
                                <td>
                                    @if($student->hiring_status === 'Selected' && $student->package)
                                        ₹{{ number_format($student->package, 2) }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($student->hiring_status === 'Selected' && $student->joining_date)
                                        {{ $student->joining_date->format('d M, Y') }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm d-flex align-items-center h-50">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning btn-sm d-flex align-items-center h-50">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No student registrations found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-end mt-3">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": false,
            "ordering": true,
            "info": false,
        });
    });
</script>
@endsection