@extends('layouts.admin')

@section('title', 'Seminar Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Seminar Details</h1>
        <div>
            <a href="{{ route('seminars.edit', $seminar->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('seminars.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Seminars
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Seminar Information</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">ID:</div>
                        <div class="col-md-8">{{ $seminar->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">College Name:</div>
                        <div class="col-md-8">{{ $seminar->college_name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Purpose:</div>
                        <div class="col-md-8">{{ $seminar->purpose ?? 'N/A' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Seminar Date:</div>
                        <div class="col-md-8">{{ $seminar->seminar_date->format('d M, Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Location:</div>
                        <div class="col-md-8">{{ $seminar->location }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Contact Person:</div>
                        <div class="col-md-8">{{ $seminar->contact_person }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Status:</div>
                        <div class="col-md-8">{!! $seminar->status_badge !!}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Remarks:</div>
                        <div class="col-md-8">{{ $seminar->remarks ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Presenters Section -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Seminar Presenters</h6>
                </div>
                <div class="card-body">
                    @if($seminar->seminar_presenters && count($seminar->seminar_presenters) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Employee ID</th>
                                        <th>Topic</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($seminar->seminar_presenters as $presenter)
                                        @php
                                            $employee = App\Models\Employee::find($presenter['employee_id']);
                                        @endphp
                                        <tr>
                                            <td>{{ $employee ? $employee->name : 'Employee not found' }}</td>
                                            <td>{{ $employee ? $employee->employee_id : 'N/A' }}</td>
                                            <td>{{ $presenter['topic'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No presenters assigned for this seminar.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Actions</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('students.create', ['seminar_id' => $seminar->id]) }}" class="btn btn-success btn-block mb-2">
                        <i class="fas fa-user-plus"></i> Register New Student
                    </a>
                    <form action="{{ route('seminars.destroy', $seminar->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this seminar?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="fas fa-trash"></i> Delete Seminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">Registered Students</h6>
            <a href="{{ route('students.create', ['seminar_id' => $seminar->id]) }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i> Add Student
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>College</th>
                            <th>Course</th>
                            <th>Hiring Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($seminar->students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->full_name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ $student->college_name }}</td>
                                <td>{{ $student->course }}</td>
                                <td>{!! $student->hiring_status_badge !!}</td>
                                <td>
                                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No students registered for this seminar</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection