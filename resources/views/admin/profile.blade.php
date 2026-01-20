@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <!-- Profile Header -->
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-gradient text-white py-4" 
             style="background: linear-gradient(135deg, #4e73df, #224abe);">
            <h3 class="mb-0"><i class="fas fa-user-circle me-2"></i> Admin Profile</h3>
        </div>

        <div class="card-body d-flex flex-column flex-md-row align-items-center p-4">
            <!-- Profile Image (Square Random) -->
            <div class="me-md-4 mb-3 mb-md-0 text-center">
                <img src="https://i.pravatar.cc/150?img={{ rand(1,70) }}" 
                     alt="Profile Picture" 
                     class="border shadow-sm rounded-3"
                     width="140" height="140">
            </div>

            <!-- Profile Info -->
            <div class="flex-grow-1 text-center text-md-start">
                <h4 class="fw-bold">{{ $admin->name }}</h4>
                <p class="text-muted mb-2"><i class="fas fa-envelope me-2"></i>{{ $admin->email }}</p>
                <button class="btn btn-primary px-4 rounded-pill shadow-sm" 
                        data-bs-toggle="modal" data-bs-target="#updateProfileModal">
                    <i class="fas fa-edit me-2"></i> Update Profile
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Update Profile Modal -->
<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg border-0">
            <div class="modal-header bg-gradient text-white"
                 style="background: linear-gradient(135deg, #1cc88a, #198754);">
                <h5 class="modal-title"><i class="fas fa-user-edit me-2"></i> Update Profile</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" value="{{ $admin->name }}" class="form-control" id="name" required>
                        <label for="name"><i class="fas fa-user me-2"></i> Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" value="{{ $admin->email }}" class="form-control" id="email" required>
                        <label for="email"><i class="fas fa-envelope me-2"></i> Email</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4">
                        <i class="fas fa-save me-2"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
