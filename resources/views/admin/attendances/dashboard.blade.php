@extends('layouts.admin')

@section('title', 'Attendance Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Today's Attendance Dashboard</h1>
        <p class="text-muted">{{ date('F d, Y') }}</p>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="attendance-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Attendance Mark</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $index => $employee)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $employee->employee_id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>
                            <div class="btn-group attendance-options" role="group" data-employee-id="{{ $employee->id }}" id="attendance-options-{{ $employee->id }}">
                                <button type="button" class="btn btn-sm {{ $employee->attendance && $employee->attendance->status == 'P' ? 'btn-success' : 'btn-outline-success' }}" data-status="P" title="Present">
                                    P
                                </button>
                                <button type="button" class="btn btn-sm {{ $employee->attendance && $employee->attendance->status == 'A' ? 'btn-danger' : 'btn-outline-danger' }}" data-status="A" title="Absent">
                                    A
                                </button>
                                <button type="button" class="btn btn-sm {{ $employee->attendance && $employee->attendance->status == 'HL' ? 'btn-warning' : 'btn-outline-warning' }}" data-status="HL" title="Half Day Leave">
                                    HL
                                </button>
                                <button type="button" class="btn btn-sm {{ $employee->attendance && $employee->attendance->status == 'L' ? 'btn-warning' : 'btn-outline-warning' }}" data-status="L" title="Leave">
                                    L
                                </button>
                                <button type="button" class="btn btn-sm {{ $employee->attendance && $employee->attendance->status == 'WFH' ? 'btn-info' : 'btn-outline-info' }}" data-status="WFH" title="Work From Home">
                                    WFH
                                </button>
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm comment-input" 
                                    value="{{ $employee->attendance ? $employee->attendance->comment : '' }}" 
                                    placeholder="Add comment" 
                                    data-employee-id="{{ $employee->id }}">
                                <button class="btn btn-sm btn-outline-primary save-comment" type="button" data-employee-id="{{ $employee->id }}">
                                    <i class="fas fa-check"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Ensure jQuery is available
    if (typeof $ === 'undefined') {
        console.error('jQuery is not loaded');
    }
    
    $(document).ready(function() {
        // Handle attendance marking
        $('.attendance-options button').on('click', function() {
            const button = $(this);
            const employeeId = button.parent().data('employee-id');
            const status = button.data('status');
            
            // Show loading state
            button.prop('disabled', true);
            
            // Make AJAX request to mark attendance
            $.ajax({
                url: '{{ route("attendances.mark") }}',
                type: 'POST',
                data: {
                    employee_id: employeeId,
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    // Reset all buttons in this group
                    button.parent().find('button').each(function() {
                        const btnStatus = $(this).data('status');
                        if (btnStatus === status) {
                            // Highlight selected button
                            $(this).removeClass('btn-outline-success btn-outline-danger btn-outline-warning btn-outline-info')
                                  .addClass(getButtonClass(status));
                        } else {
                            // Reset other buttons
                            $(this).removeClass('btn-success btn-danger btn-warning btn-info')
                                  .addClass(getOutlineButtonClass($(this).data('status')));
                        }
                    });
                    
                    // Show success message
                    toastr.success(response.message);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    toastr.error('Failed to mark attendance');
                },
                complete: function() {
                    button.prop('disabled', false);
                }
            });
        });
        
        // Handle comment saving
        $('.save-comment').on('click', function() {
            const button = $(this);
            const employeeId = button.data('employee-id');
            const commentInput = $(`.comment-input[data-employee-id="${employeeId}"]`);
            const comment = commentInput.val();
            
            // Show loading state
            button.prop('disabled', true);
            
            // Make AJAX request to save comment
            $.ajax({
                url: '{{ route("attendances.comment") }}',
                type: 'POST',
                data: {
                    employee_id: employeeId,
                    comment: comment,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    toastr.success(response.message);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    toastr.error('Failed to save comment');
                },
                complete: function() {
                    button.prop('disabled', false);
                }
            });
        });
        
        // Helper functions for button classes
        function getButtonClass(status) {
            switch(status) {
                case 'P': return 'btn-success';
                case 'A': return 'btn-danger';
                case 'HL': 
                case 'L': return 'btn-warning';
                case 'WFH': return 'btn-info';
                default: return 'btn-outline-secondary';
            }
        }
        
        function getOutlineButtonClass(status) {
            switch(status) {
                case 'P': return 'btn-outline-success';
                case 'A': return 'btn-outline-danger';
                case 'HL': 
                case 'L': return 'btn-outline-warning';
                case 'WFH': return 'btn-outline-info';
                default: return 'btn-outline-secondary';
            }
        }
    });
</script>
@endsection