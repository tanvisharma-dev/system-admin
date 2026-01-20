@extends('layouts.admin')



@section('title', 'Dashboard')



@section('content')

<!-- <div class="row">

    <div class="col-12">

        <h1 class="mb-4">Dashboard</h1>

    </div>

</div> -->



<div class="row">

    

    <div class="col-md-4">

        <div class="card text-white bg-primary">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h6 class="card-title">Total Employees</h6>

                        <h2 class="mb-0">{{ $totalEmployees }}</h2>

                    </div>

                    <i class="fas fa-users fa-3x opacity-50"></i>

                </div>

            </div>

        </div>

    </div>



    <!-- Active Employees Card -->

    <div class="col-md-4">

        <div class="card text-white bg-info">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h6 class="card-title">Active Employees</h6>

                        <h2 class="mb-0">{{ $activeEmployees }}</h2>

                    </div>

                    <i class="fas fa-user-check fa-3x opacity-50"></i>

                </div>

            </div>

        </div>

    </div>



    <!-- Inactive Employees Card -->

    <div class="col-md-4">

        <div class="card text-white bg-warning">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h6 class="card-title">Inactive Employees</h6>

                        <h2 class="mb-0">{{ $inactiveEmployees }}</h2>

                    </div>

                    <i class="fas fa-user-times fa-3x opacity-50"></i>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- Quick Links -->

    <div class="col-md-12">

        <div class="card">

            <div class="card-header">

                <i class="fas fa-link me-2"></i> Quick Links

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <a href="{{ route('employees.create') }}" class="btn btn-primary w-100 text-white">

                            <i class="fas fa-user-plus me-2"></i> Add New Employee

                        </a>

                    </div>

                    <div class="col-md-4 mb-3">

                        <a href="{{ route('employees.index') }}" class="btn btn-primary  w-100 text-white">

                            <i class="fas fa-list me-2"></i> View All Employees

                        </a>

                    </div>

                    <div class="col-md-4 mb-3">

                        <a href="{{ route('attendances.index') }}" class="btn btn-primary w-100 text-white">

                            <i class="fas fa-calendar-check me-2"></i> View Attendance

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div> 
<!-- Quick Financial Entry Toggle -->

<div class="row mt-4">

    <div class="col-12">

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">

                <div>

                    <i class="fas fa-calculator me-2"></i> Quick Financial Entry

                </div>

                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#financialForm" aria-expanded="false" aria-controls="financialForm">

                    <i class="fas fa-plus me-1"></i> Add Entry

                </button>

            </div>

            <div class="collapse" id="financialForm">

                <div class="card-body">

                    <form id="quickFinancialForm">

                        @csrf

                        <div class="row">

                            <div class="col-md-3">

                                <div class="mb-3">

                                    <label for="date" class="form-label">Date <span class="text-danger">*</span></label>

                                    <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}" required>

                                    <div class="invalid-feedback"></div>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="mb-3">

                                    <label for="type" class="form-label">Type <span class="text-danger">*</span></label>

                                    <select class="form-select" id="type" name="type" required>

                                        <option value="">Select Type</option>

                                        <option value="Income">Income</option>

                                        <option value="Expense">Expense</option>

                                    </select>

                                    <div class="invalid-feedback"></div>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="mb-3">

                                    <label for="category" class="form-label">Category <span class="text-danger">*</span></label>

                                    <input type="text" class="form-control" id="category" name="category" placeholder="e.g., Hosting, Software" required>

                                    <div class="invalid-feedback"></div>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="mb-3">

                                    <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>

                                    <div class="input-group">

                                        <span class="input-group-text">₹</span>

                                        <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="0.00" required>

                                    </div>

                                    <div class="invalid-feedback"></div>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">

                                <div class="mb-3">

                                    <label for="payment_mode" class="form-label">Payment Mode</label>

                                    <select class="form-select" id="payment_mode" name="payment_mode">

                                        <option value="">Select Mode</option>

                                        <option value="Cash">Cash</option>

                                        <option value="Bank Transfer">Bank Transfer</option>

                                        <option value="UPI">UPI</option>

                                        <option value="Cheque">Cheque</option>

                                        <option value="Credit Card">Credit Card</option>

                                        <option value="Debit Card">Debit Card</option>

                                    </select>

                                    <div class="invalid-feedback"></div>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="mb-3">

                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>

                                    <select class="form-select" id="status" name="status" required>

                                        <option value="">Select Status</option>

                                        <option value="Paid">Paid</option>

                                        <option value="Pending">Pending</option>

                                    </select>

                                    <div class="invalid-feedback"></div>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="mb-3">

                                    <label for="description" class="form-label">Description</label>

                                    <input type="text" class="form-control" id="description" name="description" placeholder="Additional notes">

                                    <div class="invalid-feedback"></div>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="mb-3">

                                    <label for="remarks" class="form-label">Remarks</label>

                                    <textarea class="form-control" id="remarks" name="remarks" rows="2" placeholder="Additional remarks"></textarea>

                                    <div class="invalid-feedback"></div>

                                </div>

                            </div>

                        </div>

                       <div class="d-flex justify-content-end gap-2">
    <button type="button" id="financialCancel" class="btn btn-secondary">Cancel</button>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i> Save Entry
    </button>
</div>


                    </form>

                </div>

            </div>

        </div>

    </div>

</div>



<div class="row mt-4">

    



<div class="row mt-4">

    <!-- Today's Attendance -->

    <div class="col-md-12">

        <div class="card">

            <div class="card-header">

                <div>

                    <i class="fas fa-calendar-day me-2"></i> Today's Attendance

                    <span class="text-muted ms-2">{{ date('F d, Y') }}</span>

                </div>

            </div>

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

                           @foreach($todayEmployees as $index => $employee)

<tr>

    <td>{{ $todayEmployees->firstItem() + $index }}</td>

    <td>{{ $employee->employee_id }}</td>

    <td>{{ $employee->name }}</td>

    <td>
    <div class="btn-group attendance-options" role="group" 
         data-employee-id="{{ $employee->id }}" 
         id="attendance-options-{{ $employee->id }}">
         
        <button type="button" 
            class="btn btn-sm {{ $employee->attendance && $employee->attendance->status == 'P' ? 'btn-success' : 'btn-outline-success' }} square-btn" 
            data-status="P" title="Present">
            P
        </button>
        
        <button type="button" 
            class="btn btn-sm {{ $employee->attendance && $employee->attendance->status == 'A' ? 'btn-danger' : 'btn-outline-danger' }} square-btn" 
            data-status="A" title="Absent">
            A
        </button>
        
        <button type="button" 
            class="btn btn-sm {{ $employee->attendance && $employee->attendance->status == 'HL' ? 'btn-warning' : 'btn-outline-warning' }} square-btn" 
            data-status="HL" title="Half Day Leave">
            HL
        </button>
        
        <button type="button" 
            class="btn btn-sm {{ $employee->attendance && $employee->attendance->status == 'L' ? 'btn-warning' : 'btn-outline-warning' }} square-btn" 
            data-status="L" title="Leave">
            L
        </button>
        
        <button type="button" 
            class="btn btn-sm {{ $employee->attendance && $employee->attendance->status == 'WFH' ? 'btn-info' : 'btn-outline-info' }} square-btn" 
            data-status="WFH" title="Work From Home">
            WFH
        </button>
    </div>
</td>

<style>
    .square-btn {
        width: 30px;        
        height: 30px;       
        display: flex;      
        align-items: center;
        justify-content: center;
        font-weight: 600;
        border-radius: 8px;  /* slightly rounded corners */
        margin-right: 4px;   /* space between buttons */
    }

    .attendance-options {
        display: flex;
        justify-content: center;
        gap: 6px;
    }
</style>


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

    </div>
<div class="d-flex justify-content-center mt-3">
    {{ $todayEmployees->links('pagination::bootstrap-5') }}
</div>

</div>

@endsection



@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  var cancelBtn = document.getElementById('financialCancel');
  var collapseEl = document.getElementById('financialForm');
  if (!cancelBtn || !collapseEl) return;

  cancelBtn.addEventListener('click', function () {
    // Get existing Collapse instance or create one without toggling
    var bsCollapse = bootstrap.Collapse.getInstance(collapseEl) || new bootstrap.Collapse(collapseEl, { toggle: false });
    bsCollapse.hide();

    // OPTIONAL: reset the form fields when closing
    // document.getElementById('quickFinancialForm').reset();
  });
});
</script>

<script>

    $(document).ready(function() {

        $(document).on('click', '.attendance-options button', function() {

            const button = $(this);

            const employeeId = button.parent().data('employee-id');

            const status = button.data('status');

            



            button.prop('disabled', true);



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

        



        $(document).on('click', '.save-comment', function() {

            const button = $(this);

            const employeeId = button.data('employee-id');

            const commentInput = $(`.comment-input[data-employee-id="${employeeId}"]`);

            const comment = commentInput.val();

            

            button.prop('disabled', true);

            

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



        // Financial Form Handling

        $('#quickFinancialForm').on('submit', function(e) {

            e.preventDefault();

            

            const form = $(this);

            const submitButton = form.find('button[type="submit"]');

            const originalText = submitButton.html();

            

            // Clear previous validation errors

            form.find('.is-invalid').removeClass('is-invalid');

            form.find('.invalid-feedback').text('');

            

            // Disable submit button

            submitButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i> Saving...');

            

            $.ajax({

                url: '{{ route("dashboard.financial.store") }}',

                type: 'POST',

                data: form.serialize(),

                dataType: 'json',

                success: function(response) {

                    if (response.success) {

                        toastr.success(response.message);

                        form[0].reset();

                        form.find('#date').val('{{ date("Y-m-d") }}');

                        $('#financialForm').collapse('hide');

                    } else {

                        toastr.error(response.message || 'Something went wrong!');

                    }

                },

                error: function(xhr) {

                    if (xhr.status === 422) {

                        // Validation errors

                        const errors = xhr.responseJSON.errors;

                        $.each(errors, function(field, messages) {

                            const input = form.find(`[name="${field}"]`);

                            input.addClass('is-invalid');

                            input.siblings('.invalid-feedback').text(messages[0]);

                        });

                        toastr.error('Please fix the validation errors.');

                    } else {

                        toastr.error('Failed to save financial entry. Please try again.');

                    }

                },

                complete: function() {

                    submitButton.prop('disabled', false).html(originalText);

                }

            });

        });

        

        // Reset form when collapsed

        $('#financialForm').on('hidden.bs.collapse', function () {

            const form = $('#quickFinancialForm');

            form[0].reset();

            form.find('#date').val('{{ date("Y-m-d") }}');

            form.find('.is-invalid').removeClass('is-invalid');

            form.find('.invalid-feedback').text('');

        });

    });

</script>

@endsection

