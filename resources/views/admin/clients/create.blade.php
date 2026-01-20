@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    {{-- Back Button --}}
    <div class="mb-3">
        <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Back to Clients
        </a>
    </div>

    {{-- Minimal Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <h5 class="mb-4 text-muted">
                <i class="fas fa-user-plus me-2"></i>Add New Client
            </h5>

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-warning small">
                    <strong>Whoops!</strong> Please fix the following issues:
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('admin.clients.store') }}" method="POST">
                @csrf

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="company_name" class="form-label small text-muted">Company Name</label>
                        <input type="text" class="form-control form-control-sm" id="company_name" name="company_name" value="{{ old('company_name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="contact_person" class="form-label small text-muted">Contact Person</label>
                        <input type="text" class="form-control form-control-sm" id="contact_person" name="contact_person" value="{{ old('contact_person') }}" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label small text-muted">Email</label>
                        <input type="email" class="form-control form-control-sm" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label small text-muted">Phone</label>
                        <input type="text" class="form-control form-control-sm" id="phone" name="phone" value="{{ old('phone') }}" required>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label small text-muted">Password</label>
                        <input type="password" class="form-control form-control-sm" id="password" name="password" required>
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label small text-muted">Confirm Password</label>
                        <input type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="billing_address" class="form-label small text-muted">Billing Address</label>
                    <textarea class="form-control form-control-sm" id="billing_address" name="billing_address" rows="3" required>{{ old('billing_address') }}</textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-check"></i> Save Client
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
