@extends('layouts.admin')
@section('title', 'Employee Details')
@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Employee Details</h1>
    </div>
    <div class="col-md-6 text-md-end">
        <a onclick="history.back()" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>


       <div class="container-fluid">
  <div class="row">
    
    <!-- Employee Tabs Sidebar -->
  <div class="col-md-3 border-end" 
     style="height:auto; background:#0d6efd; padding:15px; border-right:2px solid #0b5ed7;">

  <ul class="nav flex-column nav-pills" id="employeeTabs" role="tablist" 
      style="list-style:none; padding-left:0; margin:0;">
    
    <li class="nav-item" style="margin-bottom:6px;">
      <a class="nav-link active" id="personal-tab" data-bs-toggle="pill" href="#personal" role="tab"
         style="display:block; padding:10px 14px; border-radius:8px; font-weight:500;
                color:#fff; background:#0b5ed7; text-decoration:none; transition:all 0.2s;">
        Personal Information
      </a>
    </li>

    <li class="nav-item" style="margin-bottom:6px;">
      <a class="nav-link" id="employment-tab" data-bs-toggle="pill" href="#employment" role="tab"
         style="display:block; padding:10px 14px; border-radius:8px; font-weight:500;
                color:#fff; background:transparent; text-decoration:none; transition:all 0.2s;">
        Employment Details
      </a>
    </li>

    <li class="nav-item" style="margin-bottom:6px;">
      <a class="nav-link" id="bank-tab" data-bs-toggle="pill" href="#bank" role="tab"
         style="display:block; padding:10px 14px; border-radius:8px; font-weight:500;
                color:#fff; background:transparent; text-decoration:none; transition:all 0.2s;">
        Bank Details
      </a>
    </li>

    <li class="nav-item" style="margin-bottom:6px;">
      <a class="nav-link" id="salary-tab" data-bs-toggle="pill" href="#salary" role="tab"
         style="display:block; padding:10px 14px; border-radius:8px; font-weight:500;
                color:#fff; background:transparent; text-decoration:none; transition:all 0.2s;">
        Salary Information
      </a>
    </li>

    <li class="nav-item" style="margin-bottom:6px;">
      <a class="nav-link" id="documents-tab" data-bs-toggle="pill" href="#documents" role="tab"
         style="display:block; padding:10px 14px; border-radius:8px; font-weight:500;
                color:#fff; background:transparent; text-decoration:none; transition:all 0.2s;">
        Documents
      </a>
    </li>

    <li class="nav-item" style="margin-bottom:6px;">
      <a class="nav-link" id="attendance-tab" data-bs-toggle="pill" href="#attendance" role="tab"
         style="display:block; padding:10px 14px; border-radius:8px; font-weight:500;
                color:#fff; background:transparent; text-decoration:none; transition:all 0.2s;">
        Attendance
      </a>
    </li>

    <li class="nav-item" style="margin-bottom:6px;">
      <a class="nav-link" id="leaves-tab" data-bs-toggle="pill" href="#leaves" role="tab"
         style="display:block; padding:10px 14px; border-radius:8px; font-weight:500;
                color:#fff; background:transparent; text-decoration:none; transition:all 0.2s;">
        Leaves
      </a>
    </li>

    <li class="nav-item" style="margin-bottom:6px;">
      <a class="nav-link" id="managed-projects-tab" data-bs-toggle="pill" href="#managed-projects" role="tab"
         style="display:block; padding:10px 14px; border-radius:8px; font-weight:500;
                color:#fff; background:transparent; text-decoration:none; transition:all 0.2s;">
        Managed Projects
      </a>
    </li>

    <li class="nav-item" style="margin-bottom:6px;">
      <a class="nav-link" id="project-teams-tab" data-bs-toggle="pill" href="#project-teams" role="tab"
         style="display:block; padding:10px 14px; border-radius:8px; font-weight:500;
                color:#fff; background:transparent; text-decoration:none; transition:all 0.2s;">
        Project Teams
      </a>
    </li>

    <li class="nav-item" style="margin-bottom:6px;">
      <a class="nav-link" id="assigned-tasks-tab" data-bs-toggle="pill" href="#assigned-tasks" role="tab"
         style="display:block; padding:10px 14px; border-radius:8px; font-weight:500;
                color:#fff; background:transparent; text-decoration:none; transition:all 0.2s;">
        Assigned Tasks
      </a>
    </li>

    <li class="nav-item" style="margin-bottom:6px;">
      <a class="nav-link" id="daily-tasks-tab" data-bs-toggle="pill" href="#daily-tasks" role="tab"
         style="display:block; padding:10px 14px; border-radius:8px; font-weight:500;
                color:#fff; background:transparent; text-decoration:none; transition:all 0.2s;">
        Daily Tasks
      </a>
    </li>
  </ul>
</div>
<script>
  // Sidebar active + hover behavior
  document.querySelectorAll('#employeeTabs .nav-link').forEach(link => {
    link.addEventListener('mouseover', function() {
      if (!this.classList.contains('active')) {
        this.style.background = '#0b74ff';
      }
    });
    link.addEventListener('mouseout', function() {
      if (!this.classList.contains('active')) {
        this.style.background = 'transparent';
      }
    });
    link.addEventListener('click', function() {
      document.querySelectorAll('#employeeTabs .nav-link').forEach(el => {
        el.classList.remove('active');
        el.style.background = 'transparent';
      });
      this.classList.add('active');
      this.style.background = '#0b5ed7';
    });
  });
</script>

    <!-- Tab Content (right side of sidebar) -->
    <div class="col-md-9">
      <div class="tab-content" id="employeeTabContent">

    <!-- Personal Info -->
       <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
    <div class="card mb-4 shadow-sm border-0 rounded-3">

        <!-- Header -->
        <div class="card-header bg-light">
            <h6 class="mb-0 fw-bold text-dark">
                <i class="fas fa-user me-2 text-primary"></i> Personal Information
            </h6>
        </div>

        <!-- Body -->
        <div class="card-body p-4">

            <!-- Profile picture & info side by side -->
            <div class="row align-items-center mb-4">
                <div class="col-auto">
    @if($employee->profile_photo)
        <div style="width: 100px; height: 100px;">
            <img src="{{ asset('storage/' . $employee->profile_photo) }}" 
                 alt="Profile Photo" 
                 class="img-fluid rounded-circle shadow-sm" 
                 style="width: 100px; height: 100px; object-fit: cover;">
        </div>
    @else
        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center shadow-sm" 
             style="width: 100px; height: 100px;">
            <i class="fas fa-user fa-2x text-secondary"></i>
        </div>
    @endif
</div>
  
                <div class="col">
                    <h4 class="fw-bold text-dark mb-1">{{ $employee->name }}</h4>
                    <p class="text-muted mb-1">{{ $employee->designation ?? 'N/A' }}</p>
                    <span class="badge {{ $employee->status == 1 ? 'bg-success' : 'bg-danger' }} px-3 py-1 rounded-pill">
                        {{ $employee->status == 1 ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>

            <!-- List details -->
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-id-card me-2 text-secondary"></i> Employee ID</span>
                    <span class="fw-semibold">{{ $employee->employee_id ?? 'N/A' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-at me-2 text-secondary"></i> Login Email</span>
                    <span class="fw-semibold">{{ $employee->user_login_email ?? 'N/A' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-key me-2 text-secondary"></i> Login Password</span>
                    <span>
                        @if($employee->user_login_password)
                            <span id="password-display">••••••••</span>
                            <button type="button" class="btn btn-sm btn-outline-secondary ms-2" onclick="togglePassword()">
                                <i class="fas fa-eye" id="password-toggle-icon"></i>
                            </button>
                            <span id="actual-password" style="display: none;">{{ $employee->user_login_password }}</span>
                        @else
                            N/A
                        @endif
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-birthday-cake me-2 text-secondary"></i> Date of Birth</span>
                    <span class="fw-semibold">{{ $employee->dob ? date('F d, Y', strtotime($employee->dob)) : 'N/A' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-envelope me-2 text-secondary"></i> Personal Email</span>
                    <span class="fw-semibold">{{ $employee->personal_email ?? 'N/A' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-briefcase me-2 text-secondary"></i> Professional Email</span>
                    <span class="fw-semibold">{{ $employee->professional_email ?? 'N/A' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-phone me-2 text-secondary"></i> Phone</span>
                    <span class="fw-semibold">{{ $employee->phone ?? 'N/A' }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>


    <div class="tab-pane fade" id="employment" role="tabpanel" aria-labelledby="employment-tab">

    <!-- Employment Details -->

        <div class="card mb-4 shadow-sm border-0 rounded-3">

        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-light">
            <h6 class="mb-0 fw-bold text-dark">
            <i class="fas fa-briefcase me-2 text-primary"></i> Employment Details
            </h6>
            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-warning shadow-sm">
            <i class="fas fa-edit"></i> Edit
            </a>
        </div>

        <!-- Body -->
        <div class="card-body">
            <div class="row">
            
            <!-- Left Column -->
            <div class="col-md-6 mb-3">
                <table class="table table-borderless align-middle">
                <tr>
                    <th class="text-muted" style="width: 40%;">Department:</th>
                    <td class="fw-semibold">{{ $employee->department ? $employee->department->name : 'N/A' }}</td>
                </tr>
                <tr>
                    <th class="text-muted">Designation:</th>
                    <td class="fw-semibold">{{ $employee->designation ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th class="text-muted">Employment Type:</th>
                    <td class="fw-semibold">{{ $employee->employment_type }}</td>
                </tr>
                <tr>
                    <th class="text-muted">Employee Category:</th>
                    <td><span class="badge bg-info px-3 py-1">{{ ucfirst($employee->employee_category ?? 'N/A') }}</span></td>
                </tr>

                @if(in_array($employee->employee_category, ['trainee', 'intern']))
                <tr>
                    <th class="text-muted">Training Start Date:</th>
                    <td>{{ $employee->training_start_date ? $employee->training_start_date->format('F d, Y') : 'N/A' }}</td>
                </tr>
                <tr>
                    <th class="text-muted">Training End Date:</th>
                    <td>{{ $employee->training_end_date ? $employee->training_end_date->format('F d, Y') : 'N/A' }}</td>
                </tr>
                @endif

                <tr>
                    <th class="text-muted">Joining Date:</th>
                    <td>{{ $employee->joining_date ? date('F d, Y', strtotime($employee->joining_date)) : 'N/A' }}</td>
                </tr>
                </table>
            </div>

            <!-- Right Column -->
            <div class="col-md-6 mb-3">
                <table class="table table-borderless align-middle">
                @if($employee->employee_category === 'employee')
                <tr>
                    <th class="text-muted" style="width: 40%;">Contract Renewable:</th>
                    <td>
                    <span class="badge {{ $employee->contract_renewable ? 'bg-success' : 'bg-secondary' }} px-3 py-1">
                        {{ $employee->contract_renewable ? 'Yes' : 'No' }}
                    </span>
                    </td>
                </tr>
                @if($employee->paid_leave_per_month)
                <tr>
                    <th class="text-muted">Paid Leave per Month:</th>
                    <td class="fw-semibold">{{ $employee->paid_leave_per_month }} days</td>
                </tr>
                @endif
                @endif

                <tr>
                    <th class="text-muted">Employment Status:</th>
                    <td>
                    @php
                        $statusColor = match($employee->employment_status ?? 'active') {
                        'active' => 'bg-success',
                        'resigned' => 'bg-warning text-dark',
                        'terminated' => 'bg-danger',
                        default => 'bg-secondary'
                        };
                    @endphp
                    <span class="badge {{ $statusColor }} px-3 py-1">
                        {{ ucfirst($employee->employment_status ?? 'Active') }}
                    </span>
                    </td>
                </tr>

                <tr>
                    <th class="text-muted">Status:</th>
                    <td>
                    @if($employee->status == 1)
                        <span class="badge bg-success px-3 py-1">Active</span>
                    @else
                        <span class="badge bg-danger px-3 py-1">Inactive</span>
                    @endif
                    </td>
                </tr>
                </table>
            </div>
            </div>
        </div>
        </div>

    </div>

    <div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank-tab">

        <!-- Bank Details -->

        <div class="card mb-4 shadow-sm border-0 rounded-3">

        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-light">
            <h6 class="mb-0 fw-bold text-dark">
            <i class="fas fa-university me-2 text-primary"></i> Bank Details
            </h6>
            @if(!$employee->bankDetail)
            <a href="{{ route('bank-details.create', ['employee_id' => $employee->id]) }}" 
                class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus"></i> Add Bank Details
            </a>
            @else
            <a href="{{ route('bank-details.edit', $employee->bankDetail) }}" 
                class="btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-edit"></i> Edit
            </a>
            @endif
        </div>

        <!-- Body -->
        <div class="card-body">
            @if($employee->bankDetail)
            <div class="row">
                
                <!-- Left Column -->
                <div class="col-md-6 mb-3">
                <table class="table table-borderless align-middle">
                    <tr>
                    <th class="text-muted" style="width: 40%;">Bank Name:</th>
                    <td class="fw-semibold">{{ $employee->bankDetail->bank_name }}</td>
                    </tr>
                    <tr>
                    <th class="text-muted">Account Number:</th>
                    <td class="fw-semibold">{{ $employee->bankDetail->account_number }}</td>
                    </tr>
                </table>
                </div>

                <!-- Right Column -->
                <div class="col-md-6 mb-3">
                <table class="table table-borderless align-middle">
                    <tr>
                    <th class="text-muted" style="width: 40%;">IFSC Code:</th>
                    <td class="fw-semibold">{{ $employee->bankDetail->ifsc_code }}</td>
                    </tr>
                    <tr>
                    <th class="text-muted">UAN Number:</th>
                    <td class="fw-semibold">{{ $employee->bankDetail->uan_number ?? 'N/A' }}</td>
                    </tr>
                </table>
                </div>

            </div>
            @else
            <div class="alert alert-info d-flex align-items-center mb-0 rounded-3 shadow-sm">
                <i class="fas fa-info-circle me-2"></i>
                No bank details available for this employee.
            </div>
            @endif
        </div>
        </div>

    </div>        
        

    <div class="tab-pane fade" id="salary" role="tabpanel" aria-labelledby="salary-tab">

        <!-- Salary Details -->

 <div class="card mb-4 shadow-sm border-0 rounded-3">

        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-light">
            <h6 class="mb-0 fw-bold text-dark">
            <i class="fas fa-money-bill-wave me-2 text-success"></i> Salary Information
            </h6>
            <div>
            @if($employee->salaries->count() > 0)
                <a href="{{ route('salaries.index', ['employee_id' => $employee->id]) }}" 
                class="btn btn-sm btn-info shadow-sm me-2">
                <i class="fas fa-list"></i> View All Records
                </a>
            @endif
            <a href="{{ route('salaries.create', ['employee_id' => $employee->id]) }}" 
                class="btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus"></i> Add Salary Record
            </a>
            </div>
        </div>

        <!-- Body -->
        <div class="card-body">
            @if($employee->salaries->count() > 0)
            <div class="row">
                <div class="col-md-12">

                <h6 class="fw-bold text-secondary mb-3">Latest Salary Record</h6>

                <table class="table table-borderless align-middle">
                    <tr>
                    <th class="text-muted" style="width: 20%;">Month:</th>
                    <td class="fw-semibold">{{ $employee->salaries->first()->month }}</td>
                    <th class="text-muted" style="width: 20%;">Pay Date:</th>
                    <td class="fw-semibold">
                        {{ $employee->salaries->first()->pay_date ? date('F d, Y', strtotime($employee->salaries->first()->pay_date)) : 'N/A' }}
                    </td>
                    </tr>
                    <tr>
                    <th class="text-muted">Basic:</th>
                    <td class="fw-semibold">₹{{ number_format($employee->salaries->first()->basic, 2) }}</td>
                    <th class="text-muted">Deductions:</th>
                    <td class="fw-semibold">₹{{ number_format($employee->salaries->first()->deductions, 2) }}</td>
                    </tr>
                    <tr>
                    <th class="text-muted">Net Salary:</th>
                    <td colspan="3">
                        <span class="badge bg-success px-3 py-2 fs-6">
                        ₹{{ number_format($employee->salaries->first()->net_salary, 2) }}
                        </span>
                    </td>
                    </tr>
                </table>

                </div>
            </div>
            @else
            <div class="alert alert-info d-flex align-items-center mb-0 rounded-3 shadow-sm">
                <i class="fas fa-info-circle me-2"></i>
                No salary records available for this employee.
            </div>
            @endif
        </div>
        </div>


    </div>
    

    <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">

        <!-- Documents -->

 <div class="card mb-4 shadow-sm border-0 rounded-3">
    <!-- Header -->
    <div class="card-header d-flex justify-content-between align-items-center bg-light">
        <h6 class="mb-0 fw-bold text-dark">
            <i class="fas fa-file-alt me-2 text-primary"></i> Documents
        </h6>
        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-upload"></i> Manage Documents
        </a>
    </div>

    <!-- Body -->
    <div class="card-body">
        @php
            $allDocuments = collect();

            if($employee->resume) {
                $allDocuments->push((object) [
                    'document_type' => 'resume',
                    'document_label' => 'Resume',
                    'file_path' => $employee->resume,
                    'uploaded_at' => null
                ]);
            }

            if($employee->experience_letter_path) {
                $allDocuments->push((object) [
                    'document_type' => 'experience_letter',
                    'document_label' => 'Experience Letter',
                    'file_path' => $employee->experience_letter_path,
                    'uploaded_at' => null
                ]);
            }

            if($employee->documents && $employee->documents->count() > 0) {
                $allDocuments = $allDocuments->merge($employee->documents);
            }
        @endphp

        @if($allDocuments->count() > 0)
            <div class="row">
                @foreach($allDocuments as $document)
                    <div class="col-md-6 mb-4">
                        <div class="p-3 border rounded-3 shadow-sm bg-white h-100">
                            <h6 class="fw-bold mb-2">
                                @if($document->document_type == 'resume')
                                    <i class="fas fa-file-text text-primary"></i> Resume
                                @elseif($document->document_type == 'aadhar')
                                    <i class="fas fa-id-card text-info"></i> Aadhar Card
                                @elseif($document->document_type == 'pan')
                                    <i class="fas fa-credit-card text-success"></i> PAN Card
                                @elseif($document->document_type == 'offer_letter')
                                    <i class="fas fa-envelope text-warning"></i> Offer Letter
                                @elseif($document->document_type == 'joining_letter')
                                    <i class="fas fa-file-contract text-primary"></i> Joining Letter
                                @elseif($document->document_type == 'contract')
                                    <i class="fas fa-file-signature text-dark"></i> Contract
                                @elseif($document->document_type == 'experience_letter')
                                    <i class="fas fa-certificate text-success"></i> Experience Letter
                                @else
                                    <i class="fas fa-file text-muted"></i> {{ $document->document_label ?? ucfirst(str_replace('_', ' ', $document->document_type)) }}
                                @endif
                            </h6>

                            <p class="mb-1 text-muted small">
                                <i class="fas fa-paperclip me-1"></i> {{ basename($document->file_path) }}
                            </p>

                            @if($document->uploaded_at)
                                <p class="mb-2 text-muted small">
                                    <i class="fas fa-clock me-1"></i> Uploaded: {{ $document->uploaded_at->format('M d, Y') }}
                                </p>
                            @endif

                            <div>
                                @if($document->file_path && file_exists(public_path('storage/' . $document->file_path)))
                                    <a href="{{ asset('storage/' . $document->file_path) }}" 
                                       class="btn btn-sm btn-outline-primary shadow-sm" 
                                       target="_blank">
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                @else
                                    <span class="badge bg-danger px-3 py-2">File not found</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info d-flex align-items-center mb-0 rounded-3 shadow-sm">
                <i class="fas fa-info-circle me-2"></i>
                No documents available for this employee.
            </div>
        @endif
    </div>
</div>

    </div>

    <div class="tab-pane fade" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">

        <!-- Attendance Records -->

<div class="card mb-4 shadow-sm border-0 rounded-3">
    <!-- Header -->
    <div class="card-header d-flex justify-content-between align-items-center bg-light">
        <h6 class="mb-0 fw-bold text-dark">
            <i class="fas fa-calendar-check me-2 text-primary"></i> Attendance Records - {{ date('Y') }}
        </h6>
        <div class="d-flex align-items-center">
            <div class="me-3">
                <select class="form-select form-select-sm shadow-sm" id="attendanceYearFilter" onchange="filterAttendanceByYear()">
                    @foreach($availableYears as $year)
                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="btn-group" role="group">
                <a href="{{ route('attendances.index', ['employee_id' => $employee->id]) }}" 
                   class="btn btn-sm btn-info shadow-sm">
                    <i class="fas fa-list"></i> View All
                </a>
                <a href="{{ route('attendances.create', ['employee_id' => $employee->id]) }}" 
                   class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus"></i> Add Attendance
                </a>
            </div>
        </div>
    </div>

    <!-- Body -->
    <div class="card-body">
        @if($attendanceData->count() > 0)
            <!-- Monthly Attendance Summary -->
            <div class="row mb-4">
                <div class="col-12">
                    <h6 class="fw-bold text-secondary mb-3">
                        <i class="fas fa-chart-bar me-2 text-dark"></i> Monthly Summary
                    </h6>
                    <div class="table-responsive shadow-sm rounded-3">
                        <table class="table table-bordered table-sm align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Month</th>
                                    <th class="text-center">Total Days</th>
                                    <th class="text-center">Present</th>
                                    <th class="text-center">Absent</th>
                                    <th class="text-center">Leave</th>
                                    <th class="text-center">Half Day</th>
                                    <th class="text-center">WFH</th>
                                    <th class="text-center">Attendance %</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendanceData as $monthYear => $monthData)
                                    @php
                                        $attendancePercentage = $monthData['total'] > 0 
                                            ? round(($monthData['present'] + $monthData['work_from_home'] + ($monthData['half_day'] * 0.5)) / $monthData['total'] * 100, 1) 
                                            : 0;
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $monthData['month_name'] }}</strong></td>
                                        <td class="text-center">{{ $monthData['total'] }}</td>
                                        <td class="text-center"><span class="badge bg-success">{{ $monthData['present'] }}</span></td>
                                        <td class="text-center"><span class="badge bg-danger">{{ $monthData['absent'] }}</span></td>
                                        <td class="text-center"><span class="badge bg-warning">{{ $monthData['leave'] }}</span></td>
                                        <td class="text-center"><span class="badge bg-info">{{ $monthData['half_day'] }}</span></td>
                                        <td class="text-center"><span class="badge bg-primary">{{ $monthData['work_from_home'] }}</span></td>
                                        <td class="text-center">
                                            <span class="badge {{ $attendancePercentage >= 90 ? 'bg-success' : ($attendancePercentage >= 75 ? 'bg-warning' : 'bg-danger') }}">
                                                {{ $attendancePercentage }}%
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Detailed Monthly Records -->
            @foreach($attendanceData as $monthYear => $monthData)
                <div class="card mb-3 shadow-sm border rounded-3">
                    <div class="card-header bg-light">
                        <h6 class="mb-0 fw-bold text-dark">
                            <i class="fas fa-calendar me-2 text-primary"></i> {{ $monthData['month_name'] }}
                            <span class="badge bg-secondary ms-2">{{ $monthData['total'] }} days</span>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Day</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Hours</th>
                                        <th>Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($monthData['attendances'] as $attendance)
                                        <tr>
                                            <td>{{ $attendance->date->format('d M Y') }}</td>
                                            <td>{{ $attendance->date->format('D') }}</td>
                                            <td class="text-center">
                                                @if($attendance->status == 'P')
                                                    <span class="badge bg-success"><i class="fas fa-check"></i> Present</span>
                                                @elseif($attendance->status == 'A')
                                                    <span class="badge bg-danger"><i class="fas fa-times"></i> Absent</span>
                                                @elseif($attendance->status == 'L')
                                                    <span class="badge bg-warning"><i class="fas fa-calendar-times"></i> Leave</span>
                                                @elseif($attendance->status == 'HL')
                                                    <span class="badge bg-info"><i class="fas fa-clock"></i> Half Day</span>
                                                @elseif($attendance->status == 'WFH')
                                                    <span class="badge bg-primary"><i class="fas fa-home"></i> Work From Home</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $attendance->hours ? $attendance->hours . 'h' : 'N/A' }}</td>
                                            <td>{{ $attendance->comment ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-info d-flex align-items-center mb-0 rounded-3 shadow-sm">
                <i class="fas fa-info-circle me-2"></i>
                No attendance records available for this employee in {{ date('Y') }}.
            </div>
        @endif
    </div>
</div>

        </div>
        
        
<div class="tab-content mt-3" id="employeeTabsContent">
    <!-- Leaves -->
   <div class="tab-pane fade show" id="leaves" role="tabpanel">
    <div class="card mb-4 shadow-sm border-0 rounded-3">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-light">
            <h6 class="mb-0 fw-bold text-dark">
                <i class="fas fa-calendar-alt me-2 text-primary"></i> Leaves
            </h6>
            <div class="btn-group" role="group">
                <a href="{{ route('leaves.create', ['employee_id' => $employee->id]) }}" 
                   class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus"></i> Add Leave
                </a>
                @if($employee->leaves->count() > 0)
                    <a href="{{ route('leaves.index', ['employee_id' => $employee->id]) }}" 
                       class="btn btn-sm btn-info shadow-sm">
                        <i class="fas fa-list"></i> View All
                    </a>
                @endif
            </div>
        </div>

        <!-- Body -->
        <div class="card-body">
            @if($employee->leaves->count())
                <div class="table-responsive shadow-sm rounded-3">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Leave Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee->leaves as $leave)
                                <tr>
                                    <td class="fw-semibold">{{ $leave->type }}</td>
                                    <td>{{ $leave->from_date->format('d M Y') }}</td>
                                    <td>{{ $leave->to_date->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <span class="badge 
                                            @if($leave->status == 'approved') bg-success
                                            @elseif($leave->status == 'rejected') bg-danger
                                            @else bg-warning text-dark
                                            @endif">
                                            {{ ucfirst($leave->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info d-flex align-items-center mb-0 rounded-3 shadow-sm">
                    <i class="fas fa-info-circle me-2"></i>
                    No leaves found.
                </div>
            @endif
        </div>
    </div>
</div>


    <!-- Managed Projects -->
    <div class="tab-pane fade" id="managed-projects" role="tabpanel">
    <div class="card mb-4 shadow-sm border-0 rounded-3">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-light">
            <h6 class="mb-0 fw-bold text-dark">
                <i class="fas fa-project-diagram me-2 text-primary"></i> Managed Projects
            </h6>
            <div class="btn-group" role="group">
                <a href="{{ route('projects.create', ['manager_id' => $employee->id]) }}" 
                   class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus"></i> Add Project
                </a>
                @if($employee->managedProjects->count() > 0)
                    <a href="{{ route('projects.index', ['manager_id' => $employee->id]) }}" 
                       class="btn btn-sm btn-info shadow-sm">
                        <i class="fas fa-list"></i> View All
                    </a>
                @endif
            </div>
        </div>

        <!-- Body -->
        <div class="card-body">
            @if($employee->managedProjects->count())
                <div class="table-responsive shadow-sm rounded-3">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Project Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee->managedProjects as $project)
                                <tr>
                                    <td class="fw-semibold">{{ $project->name }}</td>
                                    <td>{{ $project->start_date->format('d M Y') }}</td>
                                    <td>
                                        {{ $project->end_date ? $project->end_date->format('d M Y') : 'Ongoing' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info d-flex align-items-center mb-0 rounded-3 shadow-sm">
                    <i class="fas fa-info-circle me-2"></i>
                    No managed projects found.
                </div>
            @endif
        </div>
    </div>
</div>


   <!-- Project Teams -->
<div class="tab-pane fade" id="project-teams" role="tabpanel">
    <div class="card mb-4 shadow-sm border-0 rounded-3">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-light">
            <h6 class="mb-0 fw-bold text-dark">
                <i class="fas fa-users me-2 text-primary"></i> Project Teams
            </h6>
            <div class="btn-group" role="group">
                <a href="{{ route('project-team.create', ['employee_id' => $employee->id]) }}" 
                   class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus"></i> Add Team
                </a>
                @if($employee->projectTeams->count() > 0)
                    <a href="{{ route('project-team.index', ['employee_id' => $employee->id]) }}" 
                       class="btn btn-sm btn-info shadow-sm">
                        <i class="fas fa-list"></i> View All
                    </a>
                @endif
            </div>
        </div>

        <!-- Body -->
        <div class="card-body">
            @if($employee->projectTeams->count())
                <div class="table-responsive shadow-sm rounded-3">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Project</th>
                                <th>Role</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee->projectTeams as $index => $team)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="fw-semibold">{{ $team->project->name ?? 'Unnamed Project' }}</td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ $team->role }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('project-team.edit', $team->id) }}" 
                                           class="btn btn-sm btn-warning shadow-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('project-team.destroy', $team->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger shadow-sm" 
                                                    onclick="return confirm('Are you sure?')">
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
                <div class="alert alert-info d-flex align-items-center mb-0 rounded-3 shadow-sm">
                    <i class="fas fa-info-circle me-2"></i>
                    No project teams found.
                </div>
            @endif
        </div>
    </div>
</div>



  <!-- Assigned Tasks -->
<div class="tab-pane fade" id="assigned-tasks" role="tabpanel">
    <div class="card mb-4 shadow-sm border-0 rounded-3">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-light">
            <h6 class="mb-0 fw-bold text-dark">
                <i class="fas fa-tasks me-2 text-success"></i> Assigned Tasks
            </h6>
            <div class="btn-group" role="group">
                <a href="{{ route('tasks.create', ['employee_id' => $employee->id]) }}" 
                   class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus"></i> Add Task
                </a>
                @if($employee->assignedTasks->count() > 0)
                    <a href="{{ route('tasks.index', ['employee_id' => $employee->id]) }}" 
                       class="btn btn-sm btn-info shadow-sm">
                        <i class="fas fa-list"></i> View All
                    </a>
                @endif
            </div>
        </div>

        <!-- Body -->
        <div class="card-body">
            @if($employee->assignedTasks->count())
                <div class="table-responsive shadow-sm rounded-3">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Task Name</th>
                                <th>Project</th>
                                <th>Due Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee->assignedTasks as $index => $task)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="fw-semibold">{{ $task->name }}</td>
                                    <td>{{ $task->project->name ?? 'N/A' }}</td>
                                    <td>{{ $task->due_date->format('d-m-Y') }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($task->status === 'completed') bg-success 
                                            @elseif($task->status === 'pending') bg-warning text-dark 
                                            @else bg-secondary @endif">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info d-flex align-items-center mb-0 rounded-3 shadow-sm">
                    <i class="fas fa-info-circle me-2"></i>
                    No assigned tasks found.
                </div>
            @endif
        </div>
    </div>
</div>



    <!-- Daily Tasks -->
  <div class="tab-pane fade" id="daily-tasks" role="tabpanel">
    <div class="card mb-4 shadow-sm border-0 rounded-3">
        <!-- Header -->
        <div class="card-header d-flex justify-content-between align-items-center bg-light">
            <h6 class="mb-0 fw-bold text-dark">
                <i class="fas fa-calendar-day me-2 text-primary"></i> Daily Tasks
            </h6>
            <div class="btn-group" role="group">
                <a href="{{ route('daily_tasks.create') }}" 
                   class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus"></i> Add Daily Task
                </a>
                @if($employee->dailyTasks->count() > 0)
                    <a href="{{ route('daily_tasks.index', ['employee_id' => $employee->id]) }}" 
                       class="btn btn-sm btn-info shadow-sm">
                        <i class="fas fa-list"></i> View All
                    </a>
                @endif
            </div>
        </div>

        <!-- Body -->
        <div class="card-body">
            @if($employee->dailyTasks->count())
                <div class="table-responsive shadow-sm rounded-3">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Task</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee->dailyTasks as $index => $dailyTask)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $dailyTask->date->format('d-m-Y') }}</td>
                                    <td class="fw-semibold">{{ $dailyTask->my_task }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($dailyTask->completion_status === 'completed') bg-success 
                                            @elseif($dailyTask->completion_status === 'pending') bg-warning text-dark 
                                            @else bg-secondary @endif">
                                            {{ ucfirst($dailyTask->completion_status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info d-flex align-items-center mb-0 rounded-3 shadow-sm">
                    <i class="fas fa-info-circle me-2"></i>
                    No daily tasks found.
                </div>
            @endif
        </div>
    </div>
</div>

</div>


 

</div>
   </div>


@endsection



@push('scripts')
<!-- Bootstrap JS (make sure Bootstrap CSS is already included in <head>) -->

<script>

function togglePassword() {

    const passwordDisplay = document.getElementById('password-display');

    const actualPassword = document.getElementById('actual-password');

    const toggleIcon = document.getElementById('password-toggle-icon');

    

    if (passwordDisplay.style.display === 'none') {

        // Show masked password

        passwordDisplay.style.display = 'inline';

        actualPassword.style.display = 'none';

        toggleIcon.className = 'fas fa-eye';

    } else {

        // Show actual password

        passwordDisplay.style.display = 'none';

        actualPassword.style.display = 'inline';

        toggleIcon.className = 'fas fa-eye-slash';

    }

}



function filterAttendanceByYear() {

    const selectedYear = document.getElementById('attendanceYearFilter').value;

    const currentUrl = new URL(window.location);

    currentUrl.searchParams.set('year', selectedYear);

    

    // Show loading indicator

    const cardBody = document.querySelector('#attendance .card-body');

    cardBody.innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin"></i> Loading attendance data...</div>';

    

    // Reload page with year parameter

    window.location.href = currentUrl.toString();

}



// Add visual enhancements when page loads

document.addEventListener('DOMContentLoaded', function() {

    // Add hover effects to attendance records

    document.querySelectorAll('#attendance .table tbody tr').forEach(row => {

        row.addEventListener('mouseenter', function() {

            this.style.backgroundColor = '#f8f9fa';

        });

        row.addEventListener('mouseleave', function() {

            this.style.backgroundColor = '';

        });

    });

    

    // Add tooltip for attendance percentage badges

    document.querySelectorAll('.badge').forEach(badge => {

        if (badge.textContent.includes('%')) {

            const percentage = parseFloat(badge.textContent);

            let tooltip = '';

            if (percentage >= 90) {

                tooltip = 'Excellent Attendance';

            } else if (percentage >= 75) {

                tooltip = 'Good Attendance';

            } else {

                tooltip = 'Needs Improvement';

            }

            badge.setAttribute('title', tooltip);

            badge.setAttribute('data-bs-toggle', 'tooltip');

        }

    });

    

    // Initialize Bootstrap tooltips

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));

    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {

        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
<style>
.attendance-summary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
}
.attendance-card {
    transition: transform 0.2s, box-shadow 0.2s;
}
.attendance-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.status-badge {
    font-size: 0.85em;
    padding: 0.35em 0.65em;
}
.monthly-header {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    border-radius: 8px 8px 0 0;
}
.table-striped tbody tr:hover {
    background-color: #e3f2fd !important;
}
@media (max-width: 768px) {
    .attendance-summary {
        padding: 15px;
    }
    .table-responsive {
        font-size: 0.9em;

    }
}
</style>
@endpush

