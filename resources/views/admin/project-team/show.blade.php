@extends('layouts.admin')

@section('title', 'Team Member Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Team Member Details</h1>
        <div>
            <a href="{{ route('project-team.edit', $projectTeam->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('project-team.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Team List
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Team Member Information</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 30%">ID</th>
                                    <td>{{ $projectTeam->id }}</td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td>{{ $projectTeam->role }}</td>
                                </tr>
                                <tr>
                                    <th>Assigned Date</th>
                                    <td>{{ $projectTeam->assigned_date->format('d M, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{!! $projectTeam->status_badge !!}</td>
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
                    <h6 class="m-0 font-weight-bold">Project Information</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 30%">Project</th>
                                    <td>
                                        <a href="{{ route('projects.show', $projectTeam->project->id) }}">
                                            {{ $projectTeam->project->name }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Client</th>
                                    <td>{{ $projectTeam->project->client_name }}</td>
                                </tr>
                                <tr>
                                    <th>Project Status</th>
                                    <td>{!! $projectTeam->project->status_badge !!}</td>
                                </tr>
                                <tr>
                                    <th>Project Manager</th>
                                    <td>
                                        <a href="{{ route('employees.show', $projectTeam->project->project_manager) }}">
                                            {{ $projectTeam->project->manager->full_name ?? 'Not Assigned' }}
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Employee Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th style="width: 30%">Employee</th>
                                            <td>
                                                <a href="{{ route('employees.show', $projectTeam->employee->id) }}">
                                                    {{ $projectTeam->employee->full_name }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Designation</th>
                                            <td>{{ $projectTeam->employee->designation }}</td>
                                        </tr>
                                        <tr>
                                            <th>Department</th>
                                            <td>{{ $projectTeam->employee->department }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $projectTeam->employee->email }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                @if($projectTeam->employee->photo)
                                    <img src="{{ asset('storage/' . $projectTeam->employee->photo) }}" alt="{{ $projectTeam->employee->full_name }}" class="img-profile rounded-circle" style="width: 150px; height: 150px;">
                                @else
                                    <img src="{{ asset('img/undraw_profile.svg') }}" alt="{{ $projectTeam->employee->full_name }}" class="img-profile rounded-circle" style="width: 150px; height: 150px;">
                                @endif
                                <h5 class="mt-3">{{ $projectTeam->employee->full_name }}</h5>
                                <p class="text-muted">{{ $projectTeam->employee->designation }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">Other Team Members in This Project</h6>
                    <a href="{{ route('projects.show', $projectTeam->project->id) }}" class="btn btn-sm btn-info">
                        <i class="fas fa-users"></i> View All Team
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Role</th>
                                    <th>Assigned Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($otherTeamMembers as $member)
                                    <tr>
                                        <td>
                                            <a href="{{ route('project-team.show', $member->id) }}">
                                                {{ $member->employee->full_name }}
                                            </a>
                                        </td>
                                        <td>{{ $member->role }}</td>
                                        <td>{{ $member->assigned_date->format('d M, Y') }}</td>
                                        <td>{!! $member->status_badge !!}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No other team members found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection