@extends('layouts.admin')



@section('title', 'Edit Employee')



@section('content')

<div class="row mb-4">

    <div class="col-md-6">

        <h1>Edit Employee</h1>

    </div>

    <div class="col-md-6 text-md-end">

        <a onclick="history.back()" class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i> Back

        </a>

    </div>

</div>



<div class="card">

    <div class="card-body">

        <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data">

            @csrf

            @method('PUT')

            

            <div class="row">

                <!-- Personal Information -->

                <div class="col-md-6">

                    <h4 class="mb-3">Personal Information</h4>

                    

                    <div class="mb-3">

                        <label for="employee_id" class="form-label">Employee ID</label>

                        <input type="text" class="form-control @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id" value="{{ old('employee_id', $employee->employee_id) }}">

                        @error('employee_id')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                    

                    <div class="mb-3">

                        <label for="user_login_email" class="form-label">User Login Email <span class="text-danger">*</span></label>

                        <input type="email" class="form-control @error('user_login_email') is-invalid @enderror" id="user_login_email" name="user_login_email" value="{{ old('user_login_email', $employee->user_login_email) }}" required>

                        <small class="form-text text-muted">Email for system login access</small>

                        @error('user_login_email')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                    

                    <div class="mb-3">

                        <label for="user_login_password" class="form-label">User Login Password <span class="text-danger">*</span></label>

                        <div class="input-group">

                            <input type="password" class="form-control @error('user_login_password') is-invalid @enderror" id="user_login_password" name="user_login_password" value="{{ old('user_login_password', $employee->user_login_password) }}" required>

                            <button class="btn btn-outline-secondary" type="button" id="toggleUserPassword">

                                <i class="fas fa-eye" id="toggleUserIcon"></i>

                            </button>

                        </div>

                        <small class="form-text text-muted">Password for system login access</small>

                        @error('user_login_password')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                    

                    <div class="mb-3">

                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>

                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $employee->name) }}" required>

                        @error('name')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                    

                    <div class="mb-3">

                        <label for="dob" class="form-label">Date of Birth</label>

                        <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob', $employee->dob) }}">

                        @error('dob')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                    

                    <div class="mb-3">

                        <label for="personal_email" class="form-label">Personal Email</label>

                        <input type="email" class="form-control @error('personal_email') is-invalid @enderror" id="personal_email" name="personal_email" value="{{ old('personal_email', $employee->personal_email) }}">

                        @error('personal_email')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                    

                    <div class="mb-3">

                        <label for="professional_email" class="form-label">Professional Email</label>

                        <input type="email" class="form-control @error('professional_email') is-invalid @enderror" id="professional_email" name="professional_email" value="{{ old('professional_email', $employee->professional_email) }}">

                        @error('professional_email')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                    

                    <div class="mb-3">

                        <label for="professional_email_password" class="form-label">Professional Email Password</label>

                        <div class="input-group">

                            <input type="password" class="form-control @error('professional_email_password') is-invalid @enderror" id="professional_email_password" name="professional_email_password" value="{{ old('professional_email_password', $employee->professional_email_password) }}">

                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">

                                <i class="fas fa-eye" id="toggleIcon"></i>

                            </button>

                        </div>

                        <small class="form-text text-muted">Enter the password for the professional email account</small>

                        @error('professional_email_password')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                    

                    <div class="mb-3">

                        <label for="phone" class="form-label">Phone</label>

                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $employee->phone) }}">

                        @error('phone')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                </div>

                

                <div class="col-md-6">

                    <h4 class="mb-3">Employment Information</h4>

                    



                    <div class="mb-3">

                        <label for="department_id" class="form-label">Department</label>

                        <select class="form-select @error('department_id') is-invalid @enderror" id="department_id" name="department_id">

                            <option value="">Select Department</option>

                            @foreach($departments as $department)

                                <option value="{{ $department->id }}" {{ old('department_id', $employee->department_id) == $department->id ? 'selected' : '' }}>

                                    {{ $department->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('department_id')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                    

                    <div class="mb-3">

                        <label for="designation" class="form-label">Designation</label>

                        <select class="form-select @error('designation') is-invalid @enderror" id="designation" name="designation" required>

                            <option value="">Select Designation</option>

                            <option value="Web Developer" {{ old('designation', $employee->designation) == 'Web Developer' ? 'selected' : '' }}>Web Developer</option>

                            <option value="Salesman" {{ old('designation', $employee->designation) == 'Salesman' ? 'selected' : '' }}>Salesman</option>

                            <option value="Office boy" {{ old('designation', $employee->designation) == 'Office boy' ? 'selected' : '' }}>Office boy</option>

                        </select> 

                        @error('designation')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                        

                    </div>

                    

                    <div class="mb-3">

                        <label for="employment_type" class="form-label">Employment Type <span class="text-danger">*</span></label>

                        <select class="form-select @error('employment_type') is-invalid @enderror" id="employment_type" name="employment_type" required>

                            <option value="">Select Employment Type</option>

                            <option value="Full-time" {{ old('employment_type', $employee->employment_type) == 'Full-time' ? 'selected' : '' }}>Full-time</option>

                            <option value="Part-time" {{ old('employment_type', $employee->employment_type) == 'Part-time' ? 'selected' : '' }}>Part-time</option>

                            <option value="Intern" {{ old('employment_type', $employee->employment_type) == 'Intern' ? 'selected' : '' }}>Intern</option>

                        </select>

                        @error('employment_type')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>



                    <div class="mb-3">

                        <label for="employee_category" class="form-label">Employee Category <span class="text-danger">*</span></label>

                        <select class="form-select @error('employee_category') is-invalid @enderror" id="employee_category" name="employee_category" required>

                            <option value="">Select Category</option>

                            <option value="trainee" {{ old('employee_category', $employee->employee_category) == 'trainee' ? 'selected' : '' }}>Trainee</option>

                            <option value="intern" {{ old('employee_category', $employee->employee_category) == 'intern' ? 'selected' : '' }}>Intern</option>

                            <option value="employee" {{ old('employee_category', $employee->employee_category) == 'employee' ? 'selected' : '' }}>Employee</option>

                        </select>

                        @error('employee_category')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                    

                    <div class="mb-3">

                        <label for="joining_date" class="form-label">Joining Date</label>

                        <input type="date" class="form-control @error('joining_date') is-invalid @enderror" id="joining_date" name="joining_date" value="{{ old('joining_date', $employee->joining_date) }}">

                        @error('joining_date')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>



                    <!-- Training fields for trainee/intern -->

                    <div id="training_fields" class="training-fields" style="display: {{ in_array(old('employee_category', $employee->employee_category), ['trainee', 'intern']) ? 'block' : 'none' }};">

                        <div class="mb-3">

                            <label for="training_start_date" class="form-label">Training Start Date <span class="text-danger">*</span></label>

                            <input type="date" class="form-control @error('training_start_date') is-invalid @enderror" id="training_start_date" name="training_start_date" value="{{ old('training_start_date', $employee->training_start_date) }}">

                            @error('training_start_date')

                                <div class="invalid-feedback">{{ $message }}</div>

                            @enderror

                        </div>

                        

                        <div class="mb-3">

                            <label for="training_end_date" class="form-label">Training End Date <span class="text-danger">*</span></label>

                            <input type="date" class="form-control @error('training_end_date') is-invalid @enderror" id="training_end_date" name="training_end_date" value="{{ old('training_end_date', $employee->training_end_date) }}">

                            @error('training_end_date')

                                <div class="invalid-feedback">{{ $message }}</div>

                            @enderror

                        </div>

                    </div>



                    <!-- Employee fields -->

                    <div id="employee_fields" class="employee-fields" style="display: {{ old('employee_category', $employee->employee_category) == 'employee' ? 'block' : 'none' }};">

                        <div class="mb-3">

                            <label for="contract_renewable" class="form-label">Contract Renewable</label>

                            <select class="form-select @error('contract_renewable') is-invalid @enderror" id="contract_renewable" name="contract_renewable">

                                <option value="0" {{ old('contract_renewable', $employee->contract_renewable) == '0' ? 'selected' : '' }}>No</option>

                                <option value="1" {{ old('contract_renewable', $employee->contract_renewable) == '1' ? 'selected' : '' }}>Yes</option>

                            </select>

                            @error('contract_renewable')

                                <div class="invalid-feedback">{{ $message }}</div>

                            @enderror

                        </div>

                        

                        <div class="mb-3">

                            <label for="paid_leave_per_month" class="form-label">Paid Leave per Month</label>

                            <input type="number" class="form-control @error('paid_leave_per_month') is-invalid @enderror" id="paid_leave_per_month" name="paid_leave_per_month" value="{{ old('paid_leave_per_month', $employee->paid_leave_per_month) }}" min="0" max="31">

                            <small class="form-text text-muted">Number of paid leave days allowed per month</small>

                            @error('paid_leave_per_month')

                                <div class="invalid-feedback">{{ $message }}</div>

                            @enderror

                        </div>

                    </div>



                    <div class="mb-3">

                        <label for="employment_status" class="form-label">Employment Status</label>

                        <select class="form-select @error('employment_status') is-invalid @enderror" id="employment_status" name="employment_status">

                            <option value="active" {{ old('employment_status', $employee->employment_status) == 'active' ? 'selected' : '' }}>Active</option>

                            <option value="resigned" {{ old('employment_status', $employee->employment_status) == 'resigned' ? 'selected' : '' }}>Resigned</option>

                            <option value="terminated" {{ old('employment_status', $employee->employment_status) == 'terminated' ? 'selected' : '' }}>Terminated</option>

                        </select>

                        @error('employment_status')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                    

                    <div class="mb-3">

                        <label for="status" class="form-label">Status</label>

                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">

                            <option value="1" {{ old('status', $employee->status) == 1 ? 'selected' : '' }}>Active</option>

                            <option value="0" {{ old('status', $employee->status) == 0 ? 'selected' : '' }}>Inactive</option>

                        </select>

                        @error('status')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                </div>

            </div>



            <hr>



            {{-- Profile Photo and Resume Section --}}

            <div class="row">

                <div class="col-md-12">

                    <h4 class="mb-3 mt-3">Profile Information</h4>

                    <p class="text-muted">Upload or update employee profile photo and resume. Current files will be replaced if new files are uploaded.</p>

                </div>



                <div class="col-md-6">

                    <div class="mb-3">

                        <label for="profile_photo" class="form-label">Profile Photo

                            @if($employee->profile_photo)

                                <span class="badge bg-success ms-2">Uploaded</span>

                            @endif

                        </label>

                        <input type="file" class="form-control @error('profile_photo') is-invalid @enderror" id="profile_photo" name="profile_photo" accept=".jpg,.jpeg,.png,.gif">

                        <small class="form-text text-muted">Accepted formats: JPG, JPEG, PNG, GIF (Max: 2MB)</small>

                        @if($employee->profile_photo)

                            <div class="mt-2">

                                <img src="{{ asset('employees/photos' . $employee->profile_photo) }}" alt="Profile Photo" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">

                            </div>

                        @endif

                        @error('profile_photo')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                </div>



                <div class="col-md-6">

                    <div class="mb-3">

                        <label for="resume" class="form-label">Resume

                            @if($employee->resume)

                                <span class="badge bg-success ms-2">Uploaded</span>

                            @endif

                        </label>

                        <input type="file" class="form-control @error('resume') is-invalid @enderror" id="resume" name="resume" accept=".pdf,.doc,.docx">

                        <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX (Max: 10MB)</small>

                        @if($employee->resume)

                            <div class="mt-2">

                                <a href="{{ asset('employees/resumes' . $employee->resume) }}" target="_blank" class="btn btn-sm btn-outline-primary">

                                    <i class="fas fa-download"></i> View Current Resume

                                </a>

                            </div>

                        @endif

                        @error('resume')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                </div>



                <div class="col-md-6">

                    <div class="mb-3">

                        <label for="experience_letter" class="form-label">Experience/Relieving Letter

                            @if($employee->experience_letter_path)

                                <span class="badge bg-success ms-2">Uploaded</span>

                            @endif

                        </label>

                        <input type="file" class="form-control @error('experience_letter') is-invalid @enderror" id="experience_letter" name="experience_letter" accept=".pdf,.doc,.docx">

                        <small class="form-text text-muted">Upload experience or relieving letter (PDF, DOC, DOCX - Max: 10MB)</small>

                        @if($employee->experience_letter_path)

                            <div class="mt-2">

                                <a href="{{ asset('employees/experience_letters' . $employee->experience_letter_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">

                                    <i class="fas fa-download"></i> View Current Experience Letter

                                </a>

                            </div>

                        @endif

                        @error('experience_letter')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                </div>

            </div>



            <hr>



            {{-- Documents Section --}}

            <div class="row">

                <div class="col-md-12">

                    <h4 class="mb-3 mt-3">Documents</h4>

                    <p class="text-muted">Upload or update employee documents. Current documents will be replaced if new files are uploaded.</p>

                </div>



                <div class="col-md-6">

                    <div class="mb-3">

                        <label for="offer_letter" class="form-label">Offer Letter

                            @if($employee->documentTracker && $employee->documentTracker->offer_letter)

                                <span class="badge bg-success ms-2">Uploaded</span>

                            @endif

                        </label>

                        <input type="file" class="form-control @error('offer_letter') is-invalid @enderror" id="offer_letter" name="offer_letter" accept=".pdf,.doc,.docx">

                        <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX</small>

                        @error('offer_letter')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                </div>



                <div class="col-md-6">

                    <div class="mb-3">

                        <label for="joining_letter" class="form-label">Joining Letter

                            @if($employee->documentTracker && $employee->documentTracker->joining_letter)

                                <span class="badge bg-success ms-2">Uploaded</span>

                            @endif

                        </label>

                        <input type="file" class="form-control @error('joining_letter') is-invalid @enderror" id="joining_letter" name="joining_letter" accept=".pdf,.doc,.docx">

                        <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX</small>

                        @error('joining_letter')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                </div>



                <div class="col-md-6">

                    <div class="mb-3">

                        <label for="aadhar_card" class="form-label">Aadhar Card

                            @if($employee->documentTracker && $employee->documentTracker->aadhar)

                                <span class="badge bg-success ms-2">Uploaded</span>

                            @endif

                        </label>

                        <input type="file" class="form-control @error('aadhar_card') is-invalid @enderror" id="aadhar_card" name="aadhar_card" accept=".pdf,.jpg,.jpeg,.png">

                        <small class="form-text text-muted">Accepted formats: PDF, JPG, PNG</small>

                        @error('aadhar_card')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                </div>



                <div class="col-md-6">

                    <div class="mb-3">

                        <label for="pan_card" class="form-label">PAN Card

                            @if($employee->documentTracker && $employee->documentTracker->pan)

                                <span class="badge bg-success ms-2">Uploaded</span>

                            @endif

                        </label>

                        <input type="file" class="form-control @error('pan_card') is-invalid @enderror" id="pan_card" name="pan_card" accept=".pdf,.jpg,.jpeg,.png">

                        <small class="form-text text-muted">Accepted formats: PDF, JPG, PNG</small>

                        @error('pan_card')

                            <div class="invalid-feedback">{{ $message }}</div>

                        @enderror

                    </div>

                </div>

            </div>

            

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">

                <a href="{{ route('employees.index') }}" class="btn btn-light me-md-2">Cancel</a>

                <button type="submit" class="btn btn-primary">Update</button>

            </div>

        </form>

    </div>

</div>



<script>

document.addEventListener('DOMContentLoaded', function() {

    const employeeCategorySelect = document.getElementById('employee_category');

    const trainingFields = document.getElementById('training_fields');

    const employeeFields = document.getElementById('employee_fields');

    const trainingStartDate = document.getElementById('training_start_date');

    const trainingEndDate = document.getElementById('training_end_date');

    

    function toggleFields() {

        const category = employeeCategorySelect.value;

        

        if (category === 'trainee' || category === 'intern') {

            // Show training fields, hide employee fields

            trainingFields.style.display = 'block';

            employeeFields.style.display = 'none';

            

            // Make training dates required

            trainingStartDate.required = true;

            trainingEndDate.required = true;

            

            // Remove required from employee fields

            document.getElementById('contract_renewable').required = false;

            document.getElementById('paid_leave_per_month').required = false;

        } else if (category === 'employee') {

            // Show employee fields, hide training fields

            trainingFields.style.display = 'none';

            employeeFields.style.display = 'block';

            

            // Remove required from training dates

            trainingStartDate.required = false;

            trainingEndDate.required = false;

            

            // Employee fields are not required but can be filled

        } else {

            // Hide both if no category selected

            trainingFields.style.display = 'none';

            employeeFields.style.display = 'none';

            

            // Remove all required attributes

            trainingStartDate.required = false;

            trainingEndDate.required = false;

        }

    }

    

    // Initial call to set the correct state

    toggleFields();

    

    // Listen for changes

    employeeCategorySelect.addEventListener('change', toggleFields);

    

    // Password toggle functionality for professional email password

    const togglePassword = document.getElementById('togglePassword');

    const passwordField = document.getElementById('professional_email_password');

    const toggleIcon = document.getElementById('toggleIcon');

    

    if (togglePassword && passwordField && toggleIcon) {

        togglePassword.addEventListener('click', function() {

            const type = passwordField.type === 'password' ? 'text' : 'password';

            passwordField.type = type;

            

            // Toggle icon

            if (type === 'password') {

                toggleIcon.className = 'fas fa-eye';

            } else {

                toggleIcon.className = 'fas fa-eye-slash';

            }

        });

    }

    

    // Password toggle functionality for user login password

    const toggleUserPassword = document.getElementById('toggleUserPassword');

    const userPasswordField = document.getElementById('user_login_password');

    const toggleUserIcon = document.getElementById('toggleUserIcon');

    

    if (toggleUserPassword && userPasswordField && toggleUserIcon) {

        toggleUserPassword.addEventListener('click', function() {

            const type = userPasswordField.type === 'password' ? 'text' : 'password';

            userPasswordField.type = type;

            

            // Toggle icon

            if (type === 'password') {

                toggleUserIcon.className = 'fas fa-eye';

            } else {

                toggleUserIcon.className = 'fas fa-eye-slash';

            }

        });

    }

});

</script>



@endsection

