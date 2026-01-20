@extends('layouts.admin')

@section('title', 'Student Evaluation Details')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Student Evaluation Details') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Evaluation #{{ $evaluation->id }}</h6>
                    <div>
                        <a href="{{ route('evaluations.edit', $evaluation->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('evaluations.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">Student Information</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <th>Name</th>
                                                    <td>{{ $evaluation->student->full_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>College</th>
                                                    <td>{{ $evaluation->student->college_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Course</th>
                                                    <td>{{ $evaluation->student->course }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Semester</th>
                                                    <td>{{ $evaluation->student->semester }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Skills</th>
                                                    <td>{{ $evaluation->student->skills }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Hiring Status</th>
                                                    <td>{!! $evaluation->student->hiring_status_badge !!}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">Evaluation Details</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" width="100%" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <th>Evaluator</th>
                                                    <td>{{ $evaluation->evaluator->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Score</th>
                                                    <td>
                                                        <div class="progress">
                                                            @php
                                                                $scorePercentage = ($evaluation->score / 10) * 100;
                                                                $colorClass = 'bg-danger';
                                                                
                                                                if ($scorePercentage >= 70) {
                                                                    $colorClass = 'bg-success';
                                                                } elseif ($scorePercentage >= 40) {
                                                                    $colorClass = 'bg-warning';
                                                                }
                                                            @endphp
                                                            <div class="progress-bar {{ $colorClass }}" role="progressbar" 
                                                                style="width: {{ $scorePercentage }}%" 
                                                                aria-valuenow="{{ $evaluation->score }}" aria-valuemin="0" aria-valuemax="10">
                                                                {{ $evaluation->score }}/10
                                                            </div>
                                                        </div>
                                                        <small>
                                                            @if ($evaluation->score >= 9)
                                                                Excellent
                                                            @elseif ($evaluation->score >= 7)
                                                                Good
                                                            @elseif ($evaluation->score >= 4)
                                                                Average
                                                            @else
                                                                Poor
                                                            @endif
                                                        </small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Hiring Decision</th>
                                                    <td>
                                                        @if ($evaluation->hiring_decision == 'Hired')
                                                            <span class="badge badge-success">Hired</span>
                                                        @elseif ($evaluation->hiring_decision == 'Rejected')
                                                            <span class="badge badge-danger">Rejected</span>
                                                        @else
                                                            <span class="badge badge-warning">Pending</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Evaluation Comments</h6>
                        </div>
                        <div class="card-body">
                            <div class="p-3 bg-light rounded">
                                <p class="mb-0">{{ $evaluation->comments }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <form action="{{ route('evaluations.destroy', $evaluation->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this evaluation? This action cannot be undone.')">
                                <i class="fas fa-trash"></i> Delete Evaluation
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection