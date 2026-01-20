@extends('layouts.admin')

@section('title', 'Project Team')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Project Team</h1>
        <a href="{{ route('project-team.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Team Member
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold">Team Members List</h6>
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
                            <th>Project</th>
                            <th>Employee</th>
                            <th>Role</th>
                            <th>Assigned Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teamMembers as $member)
                            <tr>
                                <td>{{ $member->id }}</td>
                                <td>
                                    <a href="{{ route('projects.show', $member->project->id) }}">
                                        {{ $member->project->name }}
                                    </a>
                                </td>
                                <td>
    @if($member->project)
        <a href="{{ route('projects.show', $member->project->id) }}">
            {{ $member->project->name }}
        </a>
    @else
        N/A
    @endif
</td>

                                <td>{{ $member->role }}</td>
                                <td>{{ $member->assigned_date->format('d M, Y') }}</td>
                                <td class="text-black">{!! $member->status_badge !!}</td>
                                <td class="d-flex">
                                    <a href="{{ route('project-team.show', $member->id) }}" class="btn btn-sm btn-info text-white h-50">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('project-team.edit', $member->id) }}" class="btn btn-sm btn-warning text-white h-50">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('project-team.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this team member?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger text-white">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No team members found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $teamMembers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection