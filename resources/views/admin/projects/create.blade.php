@extends('layouts.admin')

@section('title', 'Add Project')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add New Project</h1>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Projects
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold">Project Details</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('projects.store') }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Project Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="client_name">Client <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <!-- <input type="text" class="form-control @error('client_name') is-invalid @enderror" id="client_name" name="client_name" value="{{ old('client_name') }}" required> -->
                                    <select class="form-control select2 @error('client_name') is-invalid @enderror"
                                        id="client_name" name="client_id" required>
                                        <option value="" disabled selected>Select Client</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->company_name }}</option>
                                        @endforeach
                                    </select>


                                    <!-- <div class="input-group-append">
                                        <button type="button" class="btn btn-info" id="addClientBtn">
                                            <i class="fas fa-plus"></i> Add Client
                                        </button>
                                    </div> -->
                                </div>
                                @error('client_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Client Details Section -->
                    <!-- <div class="row mb-3" id="clientDetailsSection" style="display: none;">
                        <div class="col-md-12">
                            <h6 class="text-info mb-3"><i class="fas fa-user-tie"></i> Client Details</h6>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="client_address">Client Address</label>
                                <textarea class="form-control @error('client_address') is-invalid @enderror" id="client_address" name="client_address" rows="3">{{ old('client_address') }}</textarea>
                                @error('client_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="client_phone">Client Phone</label>
                                <input type="text" class="form-control @error('client_phone') is-invalid @enderror" id="client_phone" name="client_phone" value="{{ old('client_phone') }}">
                                @error('client_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="client_email">Client Email</label>
                                <input type="email" class="form-control @error('client_email') is-invalid @enderror" id="client_email" name="client_email" value="{{ old('client_email') }}">
                                @error('client_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div> -->

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">Start Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                    id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">End Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                    id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="project_manager">Project Manager <span class="text-danger">*</span></label>
                                <select class="form-control @error('project_manager') is-invalid @enderror"
                                    id="project_manager" name="project_manager" required>
                                    <option value="">Select Project Manager</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ old('project_manager') == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->name }} ({{ $employee->designation }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('project_manager')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status"
                                    required>
                                    <option value="">Select Status</option>
                                    @foreach($statuses as $value => $label)
                                        <option value="{{ $value }}" {{ old('status') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Payment Schedule Section -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h6 class="text-primary mb-3"><i class="fas fa-money-bill-wave"></i> Payment Schedule</h6>
                            <div class="mb-2">
                                <button type="button" class="btn btn-success btn-sm" id="addPaymentBtn">
                                    <i class="fas fa-plus"></i> Add Module-wise Payment
                                </button>
                            </div>
                            <div id="paymentScheduleContainer">
                                <!-- Dynamic payment schedule fields will be added here -->
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <textarea class="form-control @error('remarks') is-invalid @enderror" id="remarks"
                                    name="remarks" rows="3">{{ old('remarks') }}</textarea>
                                @error('remarks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const statuses = {!! json_encode($statuses) !!};
        const currentPhases = {!! json_encode($currentPhase) !!};
    </script>

    <script>



        $(document).ready(function () {
            let paymentIndex = 0;

            // Toggle client details section
            // $('#addClientBtn').click(function() {
            //     $('#clientDetailsSection').toggle();
            //     if ($('#clientDetailsSection').is(':visible')) {
            //         $(this).html('<i class="fas fa-minus"></i> Hide Client Details');
            //     } else {
            //         $(this).html('<i class="fas fa-plus"></i> Add Client');
            //     }
            // });



            // Add payment schedule
            $('#addPaymentBtn').click(function () {
                let statusOptions = '<option value="">Select Status</option>';
                for (const [key, value] of Object.entries(statuses)) {
                    statusOptions += `<option value="${key}">${value}</option>`;
                }

                let phaseOptions = '<option value="">Select Phase</option>';
                for (const [key, value] of Object.entries(currentPhases)) {
                    phaseOptions += `<option value="${key}">${value}</option>`;
                }
                const paymentHtml = `
                <div class="payment-schedule-group border p-3 mb-3 rounded d-flex" data-index="${paymentIndex}">
                    <div class="row flex-fill pe-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Module Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="payment_schedules[${paymentIndex}][module_name]" placeholder="e.g., Frontend Development" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Amount <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0" class="form-control" name="payment_schedules[${paymentIndex}][amount]" placeholder="0.00" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Start Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="payment_schedules[${paymentIndex}][start_date]" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Due Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="payment_schedules[${paymentIndex}][due_date]" required>
                            </div>
                        </div>
                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <label>Current Phase <span class="text-danger">*</span></label>
                                <select class="form-control" name="payment_schedules[${paymentIndex}][current_phase]" required>
                                    ${phaseOptions}
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 mt-2">
                            <div class="form-group">
                                <label>Module Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="payment_schedules[${paymentIndex}][module_status]" required>
                                    ${statusOptions}
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <div class="form-group">
                                <label>Module Status <span class="text-dark">(optional)</span></label>
                                <input type="text" class="form-control" name="payment_schedules[${paymentIndex}][feedback]">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 d-flex gap-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <a href="#">
                                <button type="button" class="btn btn-primary btn-sm d-block remove-payment p-2 py-1">
                                    <i class="fas fa-eye"></i>
                                </button></a>
                        </div>
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button type="button" class="btn btn-danger btn-sm d-block remove-payment">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;

                $('#paymentScheduleContainer').append(paymentHtml);
                paymentIndex++;
            });

            // Remove payment schedule
            $(document).on('click', '.remove-payment', function () {
                $(this).closest('.payment-schedule-group').remove();
            });

            $(document).on('change', '.payment-schedule-group input[name$="[start_date]"], .payment-schedule-group input[name$="[due_date]"]', function () {
                const group = $(this).closest('.payment-schedule-group');
                const startDate = group.find('input[name$="[start_date]"]').val();
                const dueDate = group.find('input[name$="[due_date]"]').val();

                if (startDate && dueDate) {
                    if (new Date(dueDate) < new Date(startDate)) {
                        alert('Due Date cannot be before Start Date!');
                        // Optional: clear the due date so user can re-enter
                        group.find('input[name$="[due_date]"]').val('');
                    }
                }
            });

            // Validate end date is after start date
            $('#start_date').change(function () {
                $('#end_date').attr('min', this.value);
            });
        });

        $(document).ready(function () {
            $('#client_name').select2({
                placeholder: "Select Client",
                allowClear: true
            });
        });

    </script>
@endsection