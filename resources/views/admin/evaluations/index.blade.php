@extends('layouts.admin')

@section('title', 'Student Evaluations')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Student Evaluations') }}</h1>

    @if (session('success'))
        <!-- <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> -->
    @endif

    @if (session('error'))
        <!-- <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div> -->
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Student Evaluations</h6>
                    <a href="{{ route('evaluations.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add Evaluation
                    </a>
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
                                    <th>Student</th>
                                    <th>Evaluator</th>
                                    <th>Score</th>
                                    <th>Hiring Decision</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($evaluations as $evaluation)
                                    <tr>
                                        <td>{{ $evaluation->id }}</td>
                                        <td>{{ $evaluation->student->full_name }}</td>
<td>{{ $evaluation->evaluator ? $evaluation->evaluator->name : 'N/A' }}</td>
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
                                        </td>
                                        <td>
                                            @if ($evaluation->hiring_decision == 'Hired')
                                                <span class="badge badge-success">Hired</span>
                                            @elseif ($evaluation->hiring_decision == 'Rejected')
                                                <span class="badge badge-danger">Rejected</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('evaluations.show', $evaluation->id) }}" class="btn btn-info btn-sm d-flex align-items-center h-50">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('evaluations.edit', $evaluation->id) }}" class="btn btn-warning btn-sm  d-flex align-items-center h-50">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('evaluations.destroy', $evaluation->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this evaluation?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No evaluations found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $evaluations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection