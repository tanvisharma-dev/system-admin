@extends('layouts.employee')

@section('title', 'Daily Tasks')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daily Tasks</h1>
        <a href="{{ route('employee.daily_tasks.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Task
        </a>
    </div>

    <!-- Content Row haseen subha haseen shyam haseen hai-->
    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">My Daily Tasks</h6>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Task #</th>
                                    <th>Project Title</th>
                                    <th>Description</th>
                                    <th>Time Taken</th>
                                    <th>Status</th>
                                    <th>Created Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dailyTasks as $task)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($task->date)->format('M d, Y') }}</td>
                                        <td>{{ $task->task_no }}</td>
                                        <td>{{ $task->project_title }}</td>
                                        <td>
                                            <div class="text-truncate" style="max-width: 200px;" title="{{ $task->task_description }}">
                                                {{ $task->my_task }}
                                            </div>
                                        </td>
                                        <td>{{ $task->time_taken }} hours</td>
                                        <td>
                                            @if($task->completion_status == 'completed')
                                                <span class="badge badge-success text-black">Completed</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($task->created_time)->format('M d, Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('employee.daily_tasks.show', $task->id) }}" class="btn btn-info btn-sm" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('employee.daily_tasks.edit', $task->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('employee.daily_tasks.destroy', $task->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No daily tasks found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($dailyTasks->hasPages())
                        <div class="d-flex justify-content-center">
                            {{ $dailyTasks->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
