@extends('layouts.admin')

@section('title', 'Student Feedback')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Student Feedback</h1>
        <a href="{{ route('feedback.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Submit New Feedback
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Feedback</h6>
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
                            <th>Seminar</th>
                            <th>Rating</th>
                            <th>Submitted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->id }}</td>
                                <td>{{ $feedback->student->full_name }}</td>
                                <td>{{ $feedback->seminar->college_name }} - {{ $feedback->seminar->seminar_date->format('d M, Y') }}</td>
                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $feedback->rating)
                                            <i class="fas fa-star text-warning"></i>
                                        @else
                                            <i class="far fa-star text-warning"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>{{ $feedback->submitted_at->format('d M, Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('feedback.show', $feedback->id) }}" class="btn btn-info btn-sm d-flex align-items-center h-50">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('feedback.edit', $feedback->id) }}" class="btn btn-warning btn-sm d-flex align-items-center h-50">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
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
                                <td colspan="6" class="text-center">No feedback found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end">
                {{ $feedbacks->links() }}
            </div>
        </div>
    </div>
</div>
@endsection