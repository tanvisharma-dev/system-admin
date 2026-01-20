@extends('layouts.admin')

@section('title', 'Project Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Project Details</h1>
        <div>
            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Project
            </a>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Projects
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Project Information Card -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Project Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 30%">Project Name</th>
                            <td>{{ $project->name }}</td>
                        </tr>
                        <tr>
                            <th>Client Name</th>
                            <td>{{ $project->client_name }}</td>
                        </tr>
                        @if($project->client_address || $project->client_phone || $project->client_email)
                            <tr>
                                <th>Client Address</th>
                                <td>{{ $project->client_address ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Client Phone</th>
                                <td>{{ $project->client_phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Client Email</th>
                                <td>{{ $project->client_email ?? 'N/A' }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Start Date</th>
                            <td>{{ $project->start_date->format('d M, Y') }}</td>
                        </tr>
                        <tr>
                            <th>End Date</th>
                            <td>{{ $project->end_date->format('d M, Y') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td class="text-dark">{!! $project->status_badge !!}</td>
                        </tr>
                        <tr>
                            <th>Project Manager</th>
                            <td>
                                @if($project->manager)
                                    <a href="{{ route('employees.show', $project->manager->id) }}">
                                        {{ $project->manager->name }}
                                    </a>
                                @else
                                    Not Assigned
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Remarks</th>
                            <td>{{ $project->remarks ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Project Timeline Card -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Project Timeline</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <h5>Start Date</h5>
                            <div class="border rounded p-3 bg-light">
                                <i class="fas fa-calendar-alt fa-2x text-primary mb-2"></i>
                                <p class="mb-0 font-weight-bold">{{ $project->start_date->format('d M, Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <h5>End Date</h5>
                            <div class="border rounded p-3 bg-light">
                                <i class="fas fa-calendar-check fa-2x text-danger mb-2"></i>
                                <p class="mb-0 font-weight-bold">{{ $project->end_date->format('d M, Y') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h5>Duration</h5>
                        <div class="progress">
                            @php
                                $totalDays = $project->start_date->diffInDays($project->end_date);
                                $passedDays = $project->start_date->diffInDays(now());
                                $percentage = $totalDays > 0 ? min(100, ($passedDays / $totalDays) * 100) : 0;
                                
                                if ($project->status == 'Completed') {
                                    $progressClass = 'bg-success';
                                    $percentage = 100;
                                } elseif ($project->status == 'On Hold') {
                                    $progressClass = 'bg-warning';
                                } elseif (now()->gt($project->end_date)) {
                                    $progressClass = 'bg-danger';
                                    $percentage = 100;
                                } else {
                                    $progressClass = 'bg-info';
                                }
                            @endphp
                            <div class="progress-bar {{ $progressClass }}" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{ round($percentage) }}%</div>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <small>{{ $project->start_date->format('M d') }}</small>
                            <small>{{ $project->end_date->format('M d') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Team Members -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">Project Team</h6>
                    <a href="{{ route('project-team.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add Team Member
                    </a>
                </div>
                <div class="card-body">
                    @if($project->team->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Role</th>
                                        <th>Assigned Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($project->team as $member)
                                        <tr>
                                            <td>
                                                <a href="{{ route('employees.show', $member->employee->id) }}">
                                                    {{ $member->employee->name }}
                                                </a>
                                            </td>
                                            <td>{{ $member->role }}</td>
                                            <td>{{ $member->assigned_date->format('d M, Y') }}</td>
                                            <td>{!! $member->status_badge !!}</td>
                                            <td class="d-flex">
                                                <a href="{{ route('project-team.edit', $member->id) }}" class="btn btn-primary btn-sm me-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('project-team.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this team member?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            No team members assigned to this project yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Project Tasks -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold">Project Tasks</h6>
                    <a href="{{ route('tasks.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add Task
                    </a>
                </div>
                <div class="card-body">
                    @if($project->tasks->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Assigned To</th>
                                        <th>Start Date</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($project->tasks as $task)
                                        <tr>
                                            <td>{{ $task->title }}</td>
                                            <td>
                                                <a href="{{ route('employees.show', $task->assignedEmployee->id) }}">
                                                    {{ $task->assignedEmployee->name }}
                                                </a>
                                            </td>
                                            <td>{{ $task->start_date->format('d M, Y') }}</td>
                                            <td>
                                                {{ $task->due_date->format('d M, Y') }}
                                                @if($task->is_overdue && $task->status != 'Done')
                                                    <span class="badge bg-danger text-white">Overdue</span>
                                                @endif
                                            </td>
                                            <td>{!! $task->status_badge !!}</td>
                                            <td class="d-flex">
                                                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-info btn-sm me-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm me-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            No tasks created for this project yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Schedules -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-money-bill-wave"></i> Payment Schedules</h6>
                </div>
                <div class="card-body">
                    @if($project->paymentSchedules->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Module Name</th>
                                        <th>Amount</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Paid Date</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $totalAmount = 0; @endphp
                                    @foreach($project->paymentSchedules as $schedule)
                                        @php $totalAmount += $schedule->amount; @endphp
                                        <tr>
                                            <td>{{ $schedule->module_name }}</td>
                                            <td><strong class="text-success">₹{{ number_format($schedule->amount, 2) }}</strong></td>
                                            <td>{{ $schedule->due_date->format('d M, Y') }}</td>
                                            <td>{!! $schedule->status_badge !!}</td>
                                            <td>{{ $schedule->paid_date ? $schedule->paid_date->format('d M, Y') : 'N/A' }}</td>
                                            <td>{{ $schedule->notes ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="table-info">
                                        <th>Total Project Value</th>
                                        <th><strong class="text-primary">₹{{ number_format($totalAmount, 2) }}</strong></th>
                                        <th colspan="4"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No payment schedules defined for this project.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
