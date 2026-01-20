@extends('layouts.admin')

@section('title', 'Student Details')

<link rel="stylesheet" href="{{ asset('css/app.css') }}">


@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Student Details</h1>
        <div>
            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Students
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Student Information</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">ID:</div>
                        <div class="col-md-8">{{ $student->id }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Full Name:</div>
                        <div class="col-md-8">{{ $student->full_name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Email:</div>
                        <div class="col-md-8">{{ $student->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Phone:</div>
                        <div class="col-md-8">{{ $student->phone }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">College:</div>
                        <div class="col-md-8">{{ $student->college_name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Course:</div>
                        <div class="col-md-8">{{ $student->course }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Semester:</div>
                        <div class="col-md-8">{{ $student->semester }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Skills:</div>
                        <div class="col-md-8">
                            @php
                                $skillsArray = explode(',', $student->skills);
                            @endphp
                            @foreach($skillsArray as $skill)
                                <span class="badge badge-info mr-1">{{ trim($skill) }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Hiring Status:</div>
                        <div class="col-md-8">{!! $student->hiring_status_badge !!}</div>
                    </div>
                    @if($student->hiring_status === 'Selected')
                        <div class="row mb-3">
                            <div class="col-md-4 font-weight-bold">Package:</div>
                            <div class="col-md-8">
                                @if($student->package)
                                    <strong class="text-success">₹{{ number_format($student->package, 2) }}</strong>
                                @else
                                    <span class="text-muted">Not specified</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 font-weight-bold">Joining Date:</div>
                            <div class="col-md-8">
                                @if($student->joining_date)
                                    <strong class="text-info">{{ $student->joining_date->format('d M, Y') }}</strong>
                                @else
                                    <span class="text-muted">Not specified</span>
                                @endif
                            </div>
                        </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-md-4 font-weight-bold">Remarks:</div>
                        <div class="col-md-8">{{ $student->remarks ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Seminar Information</h6>
                </div>
                <div class="card-body">
                    @if($student->seminar)
                        <div class="row mb-3">
                            <div class="col-md-5 font-weight-bold">College:</div>
                            <div class="col-md-7">{{ $student->seminar->college_name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5 font-weight-bold">Date:</div>
                            <div class="col-md-7">{{ $student->seminar->seminar_date->format('d M, Y') }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5 font-weight-bold">Location:</div>
                            <div class="col-md-7">{{ $student->seminar->location }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-5 font-weight-bold">Status:</div>
                            <div class="col-md-7">{!! $student->seminar->status_badge !!}</div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('seminars.show', $student->seminar_id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-info-circle"></i> View Seminar Details
                            </a>
                        </div>
                    @else
                        <div class="text-center py-3">
                            <p class="text-muted">No seminar information available</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Actions</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="fas fa-trash"></i> Delete Student
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection