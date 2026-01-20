@extends('layouts.admin')

@section('title', 'Employee Attendance Overview')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Employee Attendance Overview</h1>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('attendances.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Mark Attendance
        </a>
    </div>
</div>

<!-- Filter Card -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('attendances.index') }}" class="row g-3">
            <div class="col-md-4">
                <label for="month" class="form-label">Month</label>
                <select name="month" id="month" class="form-select">
                    <option value="1" {{ $currentMonth == '1' ? 'selected' : '' }}>January</option>
                    <option value="2" {{ $currentMonth == '2' ? 'selected' : '' }}>February</option>
                    <option value="3" {{ $currentMonth == '3' ? 'selected' : '' }}>March</option>
                    <option value="4" {{ $currentMonth == '4' ? 'selected' : '' }}>April</option>
                    <option value="5" {{ $currentMonth == '5' ? 'selected' : '' }}>May</option>
                    <option value="6" {{ $currentMonth == '6' ? 'selected' : '' }}>June</option>
                    <option value="7" {{ $currentMonth == '7' ? 'selected' : '' }}>July</option>
                    <option value="8" {{ $currentMonth == '8' ? 'selected' : '' }}>August</option>
                    <option value="9" {{ $currentMonth == '9' ? 'selected' : '' }}>September</option>
                    <option value="10" {{ $currentMonth == '10' ? 'selected' : '' }}>October</option>
                    <option value="11" {{ $currentMonth == '11' ? 'selected' : '' }}>November</option>
                    <option value="12" {{ $currentMonth == '12' ? 'selected' : '' }}>December</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="year" class="form-label">Year</label>
                <select name="year" id="year" class="form-select">
                    @for($year = date('Y'); $year >= 2020; $year--)
                        <option value="{{ $year }}" {{ $currentYear == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">&nbsp;</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <a href="{{ route('attendances.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Clear
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Employee Cards -->
<div class="row">
    @forelse($employees as $employee)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card employee-card h-100" style="cursor: pointer;" onclick="openEmployeeModal({{ $employee->id }}, '{{ $employee->name }}', '{{ $employee->employee_id }}')">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                            @if($employee->profile_photo)
                                <img src="{{ asset('storage/' . $employee->profile_photo) }}" alt="Profile" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                            @else
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="card-title mb-1">{{ $employee->name }}</h6>
                            <small class="text-muted">{{ $employee->employee_id }}</small><br>
                            <small class="text-muted">{{ $employee->designation ?? 'N/A' }}</small>
                        </div>
                        <div class="text-end">
                            @php
                                $percentage = $employee->attendance_summary['attendance_percentage'];
                                $badgeClass = $percentage >= 90 ? 'bg-success' : ($percentage >= 75 ? 'bg-warning' : 'bg-danger');
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ $percentage }}%</span>
                        </div>
                    </div>
                    
                    <div class="row text-center">
                        <div class="col-3">
                            <small class="text-muted d-block">Present</small>
                            <strong class="text-success">{{ $employee->attendance_summary['present_days'] }}</strong>
                        </div>
                        <div class="col-3">
                            <small class="text-muted d-block">Absent</small>
                            <strong class="text-danger">{{ $employee->attendance_summary['absent_days'] }}</strong>
                        </div>
                        <div class="col-3">
                            <small class="text-muted d-block">Leave</small>
                            <strong class="text-warning">{{ $employee->attendance_summary['leave_days'] }}</strong>
                        </div>
                        <div class="col-3">
                            <small class="text-muted d-block">WFH</small>
                            <strong class="text-info">{{ $employee->attendance_summary['wfh_days'] }}</strong>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar {{ $badgeClass }}" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <small class="text-muted">Working Days: {{ $employee->attendance_summary['working_days'] }}/{{ $employee->attendance_summary['days_in_month'] }}</small>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle me-2"></i>No employees found.
            </div>
        </div>
    @endforelse
</div>

<!-- Employee Details Modal -->
<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel">Employee Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
                <div class="text-center py-4">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Loading employee details...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openEmployeeModal(employeeId, employeeName, employeeIdValue) {
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('employeeModal'));
    document.getElementById('employeeModalLabel').textContent = `${employeeName} (${employeeIdValue})`;
    
    // Reset modal content to loading
    document.getElementById('modalContent').innerHTML = `
        <div class="text-center py-4">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading employee details...</p>
        </div>
    `;
    
    modal.show();
    
    // Fetch employee data
    fetch(`/admin/employees/${employeeId}/attendance-details?month={{ $currentMonth }}&year={{ $currentYear }}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayEmployeeDetails(data.employee, data.attendances, data.leaves);
            } else {
                document.getElementById('modalContent').innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i> Error loading employee details.
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('modalContent').innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i> Error loading employee details.
                </div>
            `;
        });
}

function displayEmployeeDetails(employee, attendances, leaves) {
    const monthName = new Date({{ $currentYear }}, {{ $currentMonth }} - 1).toLocaleString('default', { month: 'long' });
    
    const modalContent = `
        <!-- Attendance Summary -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="text-success">${employee.attendance_summary.present_days}</h3>
                        <p class="mb-0">Present Days</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="text-danger">${employee.attendance_summary.absent_days}</h3>
                        <p class="mb-0">Absent Days</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="text-warning">${employee.attendance_summary.leave_days}</h3>
                        <p class="mb-0">Leave Days</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h3 class="text-info">${employee.attendance_summary.wfh_days}</h3>
                        <p class="mb-0">WFH Days</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabs -->
        <ul class="nav nav-tabs" id="employeeDetailTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="attendance-tab" data-bs-toggle="tab" data-bs-target="#attendance" type="button" role="tab">Attendance Details</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="leaves-tab" data-bs-toggle="tab" data-bs-target="#leaves" type="button" role="tab">Leave Records</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="salary-tab" data-bs-toggle="tab" data-bs-target="#salary" type="button" role="tab">Salary Management</button>
            </li>
        </ul>
        
        <div class="tab-content" id="employeeDetailTabsContent">
            <!-- Attendance Tab -->
            <div class="tab-pane fade show active" id="attendance" role="tabpanel">
                <div class="mt-3">
                    <h6>Attendance Records for ${monthName} {{ $currentYear }}</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Status</th>
                                    <th>Hours</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${attendances.length > 0 ? attendances.map(attendance => `
                                    <tr>
                                        <td>${new Date(attendance.date).toLocaleDateString()}</td>
                                        <td>${new Date(attendance.date).toLocaleDateString('en-US', { weekday: 'short' })}</td>
                                        <td>
                                            ${getStatusBadge(attendance.status)}
                                        </td>
                                        <td>${attendance.hours || 'N/A'}</td>
                                        <td>${attendance.comment || 'N/A'}</td>
                                    </tr>
                                `).join('') : '<tr><td colspan="5" class="text-center">No attendance records found</td></tr>'}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Leaves Tab -->
            <div class="tab-pane fade" id="leaves" role="tabpanel">
                <div class="mt-3">
                    <h6>Leave Records</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>Leave Type</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Status</th>
                                    <th>Days</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${leaves.length > 0 ? leaves.map(leave => {
                                    const fromDate = new Date(leave.from_date);
                                    const toDate = new Date(leave.to_date);
                                    const days = Math.ceil((toDate - fromDate) / (1000 * 60 * 60 * 24)) + 1;
                                    return `
                                        <tr>
                                            <td>${leave.leave_type}</td>
                                            <td>${fromDate.toLocaleDateString()}</td>
                                            <td>${toDate.toLocaleDateString()}</td>
                                            <td>${getLeaveStatusBadge(leave.status)}</td>
                                            <td>${days}</td>
                                        </tr>
                                    `;
                                }).join('') : '<tr><td colspan="5" class="text-center">No leave records found</td></tr>'}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- Salary Tab -->
            <div class="tab-pane fade" id="salary" role="tabpanel">
                <div class="mt-3">
                    <h6>Salary Management</h6>
                    <form id="salaryForm" onsubmit="submitSalaryForm(event, ${employee.id})">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="salary_month" class="form-label">Month *</label>
                                    <input type="month" class="form-control" id="salary_month" name="month" value="{{ $currentYear }}-{{ str_pad($currentMonth, 2, '0', STR_PAD_LEFT) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="basic_salary" class="form-label">Basic Salary *</label>
                                    <input type="number" class="form-control" id="basic_salary" name="basic" step="0.01" min="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="hra_salary" class="form-label">HRA</label>
                                    <input type="number" class="form-control" id="hra_salary" name="hra" step="0.01" min="0" value="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="other_allowances_salary" class="form-label">Other Allowances</label>
                                    <input type="number" class="form-control" id="other_allowances_salary" name="other_allowances" step="0.01" min="0" value="0">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="deductions_salary" class="form-label">Deductions</label>
                                    <input type="number" class="form-control" id="deductions_salary" name="deductions" step="0.01" min="0" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gross_salary" class="form-label">Gross Salary</label>
                                    <input type="number" class="form-control" id="gross_salary" name="gross" step="0.01" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="net_salary" class="form-label">Net Salary</label>
                                    <input type="number" class="form-control" id="net_salary" name="net_salary" step="0.01" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="pay_date_salary" class="form-label">Pay Date</label>
                                    <input type="date" class="form-control" id="pay_date_salary" name="pay_date">
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Salary Record
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('modalContent').innerHTML = modalContent;
    
    // Add event listeners for salary calculation after content is loaded
    setTimeout(() => {
        const basicSalary = document.getElementById('basic_salary');
        const hra = document.getElementById('hra_salary');
        const otherAllowances = document.getElementById('other_allowances_salary');
        const deductions = document.getElementById('deductions_salary');
        const grossSalary = document.getElementById('gross_salary');
        const netSalary = document.getElementById('net_salary');
        
        function calculateSalary() {
            const basic = parseFloat(basicSalary.value) || 0;
            const hraAmount = parseFloat(hra.value) || 0;
            const allowances = parseFloat(otherAllowances.value) || 0;
            const deductionAmount = parseFloat(deductions.value) || 0;
            
            const gross = basic + hraAmount + allowances;
            const net = gross - deductionAmount;
            
            grossSalary.value = gross.toFixed(2);
            netSalary.value = net.toFixed(2);
        }
        
        // Add event listeners
        [basicSalary, hra, otherAllowances, deductions].forEach(input => {
            if (input) {
                input.addEventListener('input', calculateSalary);
            }
        });
        
        // Calculate initially
        calculateSalary();
    }, 100);
}

function getStatusBadge(status) {
    const badges = {
        'P': '<span class="badge bg-success">Present</span>',
        'A': '<span class="badge bg-danger">Absent</span>',
        'L': '<span class="badge bg-warning text-dark">Leave</span>',
        'HL': '<span class="badge bg-info">Half Day</span>',
        'WFH': '<span class="badge bg-primary">Work From Home</span>'
    };
    return badges[status] || '<span class="badge bg-secondary">Unknown</span>';
}

function getLeaveStatusBadge(status) {
    const badges = {
        'Pending': '<span class="badge bg-warning text-dark">Pending</span>',
        'Approved': '<span class="badge bg-success">Approved</span>',
        'Rejected': '<span class="badge bg-danger">Rejected</span>'
    };
    return badges[status] || '<span class="badge bg-secondary">Unknown</span>';
}

function submitSalaryForm(event, employeeId) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    formData.append('employee_id', employeeId);
    
    // Add proper content type headers for JSON response
    fetch('/admin/salaries', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Use toastr for better user experience
            if (typeof toastr !== 'undefined') {
                toastr.success(data.message || 'Salary record saved successfully!');
            } else {
                alert('Salary record saved successfully!');
            }
            // Reset form
            event.target.reset();
            // Recalculate to show 0 values
            setTimeout(() => {
                const calculateEvent = new Event('input');
                document.getElementById('basic_salary').dispatchEvent(calculateEvent);
            }, 100);
        } else {
            const errorMessage = data.message || 'Unknown error occurred';
            if (typeof toastr !== 'undefined') {
                toastr.error('Error saving salary record: ' + errorMessage);
            } else {
                alert('Error saving salary record: ' + errorMessage);
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        const errorMessage = 'Error saving salary record: ' + error.message;
        if (typeof toastr !== 'undefined') {
            toastr.error(errorMessage);
        } else {
            alert(errorMessage);
        }
    });
}
</script>

<style>
.employee-card {
    transition: transform 0.2s, box-shadow 0.2s;
}

.employee-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.progress {
    background-color: #e9ecef;
}

.modal-xl {
    max-width: 1200px;
}
</style>

@endsection
