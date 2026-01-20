@extends('layouts.employee')

@section('title', 'Assigned Project Tasks')

@section('content')
<div class="container mt-4">
    <h2>Assigned Project Tasks</h2>

    <div class="mb-3">
        <form method="GET" action="{{ route('employee.project-tasks') }}" class="form-inline">
            <div class="form-group mr-2">
                <label for="status" class="mr-2">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="all" {{ $status == 'all' ? 'selected' : '' }}>All</option>
                    <option value="Pending" {{ $status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="In Progress" {{ $status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Done" {{ $status == 'Done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>

            <div class="form-group mr-2">
                <label for="project" class="mr-2">Project</label>
                <select name="project" id="project" class="form-control">
                    <option value="all" {{ $project == 'all' ? 'selected' : '' }}>All</option>
                    @foreach($availableProjects as $proj)
                        <option value="{{ $proj->id }}" {{ $project == $proj->id ? 'selected' : '' }}>{{ $proj->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Project</th>
                <th>Task Title</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr @if($task->is_overdue) class="table-danger" @endif>
                    <td>{{ $task->project->name ?? 'N/A' }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{!! $task->status_badge !!}</td>
                    <td>{{ $task->start_date ? $task->start_date->format('Y-m-d') : '-' }}</td>
                    <td>{{ $task->due_date ? $task->due_date->format('Y-m-d') : '-' }}</td>
                    <td>{{ $task->remarks ?? '-' }}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary update-status-btn" data-id="{{ $task->id }}" data-status="{{ $task->status }}" data-remarks="{{ $task->remarks }}">Update Status</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No tasks assigned.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $tasks->withQueryString()->links() }}
</div>

<!-- Modal for Update Status -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-labelledby="updateStatusLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="updateStatusForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateStatusLabel">Update Task Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <input type="hidden" name="task_id" id="task_id">

          <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control" required>
              <option value="Pending">Pending</option>
              <option value="In Progress">In Progress</option>
              <option value="Done">Done</option>
            </select>
          </div>

          <div class="form-group">
            <label for="remarks">Remarks</label>
            <textarea id="remarks" name="remarks" class="form-control" rows="3"></textarea>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>

      </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    var modal = $('#updateStatusModal');
    var form = $('#updateStatusForm');

    $('.update-status-btn').click(function() {
        var taskId = $(this).data('id');
        var status = $(this).data('status');
        var remarks = $(this).data('remarks');

        $('#task_id').val(taskId);
        $('#status').val(status);
        $('#remarks').val(remarks || '');

        modal.modal('show');
    });

    form.submit(function(e) {
        e.preventDefault();
        var taskId = $('#task_id').val();
        var data = {
            status: $('#status').val(),
            remarks: $('#remarks').val(),
            _token: '{{ csrf_token() }}'
        };

        $.post('/employee/project-tasks/' + taskId + '/update-status', data)
            .done(function(response) {
                alert(response.message);
                modal.modal('hide');
                location.reload();
            })
            .fail(function(xhr) {
                alert('Failed to update task status: ' + (xhr.responseJSON?.error || 'Unknown error'));
            });
    });
});
</script>
@endsection

