@extends('layouts.admin')

@section('title', 'Tasks')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tasks</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Task
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold">Task List</h6>
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
                            <th>Title</th>
                            <th>Assigned To</th>
                            <th>Start Date</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>
                                    <a href="{{ route('projects.show', $task->project->id) }}">
                                        {{ $task->project->name }}
                                    </a>
                                </td>
                                <td>{{ $task->title }}</td>
                                <td>
                                    @if($task->assignedEmployee)
    <a href="{{ route('employees.show', $task->assignedEmployee->id) }}">
        {{ $task->assignedEmployee->full_name }}
    </a>
@else
    N/A
@endif
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
                                    <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-sm btn-info text-white h-50">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning text-white h-50">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
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
                                <td colspan="8" class="text-center">No tasks found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</div>
@endsection