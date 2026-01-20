@extends('layouts.admin')

@section('title', 'Task Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Task Details</h1>
        <div>
            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Task
            </a>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Tasks
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Task Information Card -->
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Task Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 30%">Project</th>
                            <td>
                                <a href="{{ route('projects.show', $task->project->id) }}">
                                    {{ $task->project->name }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Task Title</th>
                            <td>{{ $task->title }}</td>
                        </tr>
                        <tr>
                            <th>Assigned To</th>
                            <td>
                                <a href="{{ route('employees.show', $task->assignedEmployee->id) }}">
                                    {{ $task->assignedEmployee->full_name }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{!! $task->status_badge !!}</td>
                        </tr>
                        <tr>
                            <th>Start Date</th>
                            <td>{{ $task->start_date->format('d M, Y') }}</td>
                        </tr>
                        <tr>
                            <th>Due Date</th>
                            <td>
                                {{ $task->due_date->format('d M, Y') }}
                                @if($task->is_overdue && $task->status != 'Done')
                                    <span class="badge bg-danger text-white ms-2">Overdue</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Completion Date</th>
                            <td>{{ $task->completion_date ? $task->completion_date->format('d M, Y') : 'Not completed yet' }}</td>
                        </tr>
                        <tr>
                            <th>Remarks</th>
                            <td>{{ $task->remarks ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Task Status Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Task Status</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        @php
                            if ($task->status == 'Done') {
                                $statusIcon = 'fa-check-circle text-success';
                                $statusText = 'Completed';
                            } elseif ($task->status == 'In Progress') {
                                $statusIcon = 'fa-spinner text-primary';
                                $statusText = 'In Progress';
                            } else {
                                $statusIcon = 'fa-clock text-warning';
                                $statusText = 'Pending';
                            }
                        @endphp
                        <i class="fas {{ $statusIcon }} fa-5x mb-3"></i>
                        <h4>{{ $statusText }}</h4>
                    </div>

                    <div class="mb-4">
                        <h6>Timeline</h6>
                        <div class="progress mb-2">
                            @php
                                $totalDays = $task->start_date->diffInDays($task->due_date);
                                $passedDays = $task->start_date->diffInDays(now());
                                $percentage = $totalDays > 0 ? min(100, ($passedDays / $totalDays) * 100) : 0;
                                
                                if ($task->status == 'Done') {
                                    $progressClass = 'bg-success';
                                    $percentage = 100;
                                } elseif ($task->is_overdue) {
                                    $progressClass = 'bg-danger';
                                    $percentage = 100;
                                } else {
                                    $progressClass = 'bg-info';
                                }
                            @endphp
                            <div class="progress-bar {{ $progressClass }}" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{ round($percentage) }}%</div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small>{{ $task->start_date->format('M d') }}</small>
                            <small>{{ $task->due_date->format('M d') }}</small>
                        </div>
                    </div>

                    @if($task->status != 'Done')
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="project_id" value="{{ $task->project_id }}">
                            <input type="hidden" name="title" value="{{ $task->title }}">
                            <input type="hidden" name="assigned_to" value="{{ $task->assigned_to }}">
                            <input type="hidden" name="start_date" value="{{ $task->start_date->format('Y-m-d') }}">
                            <input type="hidden" name="due_date" value="{{ $task->due_date->format('Y-m-d') }}">
                            <input type="hidden" name="remarks" value="{{ $task->remarks }}">
                            <input type="hidden" name="status" value="Done">
                            <input type="hidden" name="completion_date" value="{{ now()->format('Y-m-d') }}">
                            
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-check-circle"></i> Mark as Completed
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Project Information -->
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Project Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 30%">Project Name</th>
                                    <td>{{ $task->project->name }}</td>
                                </tr>
                                <tr>
                                    <th>Client Name</th>
                                    <td>{{ $task->project->client_name }}</td>
                                </tr>
                                <tr>
                                    <th>Project Manager</th>
                                    <td>
                                        @if($task->project->manager)
                                            <a href="{{ route('employees.show', $task->project->manager->id) }}">
                                                {{ $task->project->manager->full_name }}
                                            </a>
                                        @else
                                            Not Assigned
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 30%">Start Date</th>
                                    <td>{{ $task->project->start_date->format('d M, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>End Date</th>
                                    <td>{{ $task->project->end_date->format('d M, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{!! $task->project->status_badge !!}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('projects.show', $task->project->id) }}" class="btn btn-info">
                            <i class="fas fa-project-diagram"></i> View Project Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection