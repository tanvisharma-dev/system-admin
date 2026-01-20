@extends('layouts.employee')

@section('title', 'My Profile')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg p-4 border-0 rounded-3">
                <div class="row">
                    <!-- Profile Left -->
                    <div class="col-md-4 text-center border-end">
                        @if($employee->profile_photo)
                            <img src="{{ asset('storage/' . $employee->profile_photo) }}" 
                                 class="rounded-circle img-fluid border shadow" 
                                 style="width: 180px; height: 180px; object-fit: cover;" 
                                 alt="Profile Photo">
                        @else
                            <img src="{{ asset('default-user.png') }}" 
                                 class="rounded-circle img-fluid border shadow" 
                                 style="width: 180px; height: 180px; object-fit: cover;" 
                                 alt="Default Profile Photo">
                        @endif

                        <h4 class="mt-3">{{ $employee->name }}</h4>
                        <p class="text-muted mb-1">{{ $employee->designation ?? 'Web Developer' }}</p>
                        
                        <span class="badge bg-success px-3 py-2">Active</span>
                    </div>

                    <!-- Profile Right -->
                    <div class="col-md-8">
                        <h4 class="mb-3">Profile Information</h4>
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item">
                                <strong>Employee ID:</strong> {{ $employee->employee_id ?? 'EMP-XXXX' }}
                            </li>

                            <li class="list-group-item">
                                <strong>Login Email:</strong> {{ $employee->email ?? 'N/A' }}
                            </li>

                           

                            <li class="list-group-item">
                                <strong>Date of Birth:</strong> 
                                {{ $employee->dob ? \Carbon\Carbon::parse($employee->dob)->format('d M, Y') : 'N/A' }}
                            </li>

                            <li class="list-group-item">
                                <strong>Personal Email:</strong> {{ $employee->personal_email ?? 'N/A' }}
                            </li>

                            <li class="list-group-item">
                                <strong>Professional Email:</strong> {{ $employee->professional_email ?? 'N/A' }}
                            </li>

                            <li class="list-group-item">
                                <strong>Phone:</strong> {{ $employee->phone ?? 'N/A' }}
                            </li>

                            <li class="list-group-item">
                                <strong>Department:</strong> {{ $employee->department->name ?? 'N/A' }}
                            </li>

                            <li class="list-group-item">
    <strong>Joined On:</strong>
    {{ $employee->joining_date ? $employee->joining_date->format('d M, Y') : 'N/A' }}
</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
