@extends('layouts.admin')

@section('title', 'College Seminars')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">College Seminars</h1>
        <a href="{{ route('seminars.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Schedule New Seminar
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold">Seminar List</h6>
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
                            <th>College Name</th>
                            <th>Purpose</th>
                            <th>Presenters</th>
                            <th>Seminar Date</th>
                            <th>Location</th>
                            <th>Contact Person</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($seminars as $seminar)
                            <tr>
                                <td>{{ $seminar->id }}</td>
                                <td>{{ $seminar->college_name }}</td>
                                <td>{{ Str::limit($seminar->purpose ?? 'N/A', 50) }}</td>
                                <td>
                                    @if($seminar->seminar_presenters)
                                        @foreach($seminar->seminar_presenters as $presenter)
                                            @php
                                                $employee = App\Models\Employee::find($presenter['employee_id']);
                                            @endphp
                                            @if($employee)
                                                <span class="badge badge-info mb-1">{{ $employee->name }} - {{ $presenter['topic'] }}</span><br>
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-muted">No presenters assigned</span>
                                    @endif
                                </td>
                                <td>{{ $seminar->seminar_date->format('d M, Y') }}</td>
                                <td>{{ $seminar->location }}</td>
                                <td>{{ $seminar->contact_person }}</td>
                                <td class="bg-have">{!! $seminar->status_badge !!}</td>
                                <td class="d-flex">
                                    <a href="{{ route('seminars.show', $seminar->id) }}" class="btn btn-info btn-sm d-flex align-items-center h-50">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('seminars.edit', $seminar->id) }}" class="btn btn-warning btn-sm  d-flex align-items-center h-50">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('seminars.destroy', $seminar->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this seminar?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No seminars found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $seminars->links() }}
            </div>
        </div>
    </div>
</div>
@endsection