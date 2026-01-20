{{-- resources/views/admin/clients/show.blade.php --}}

@extends('layouts.admin')

@section('title', 'View Client')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">👤 Client Details</h2>
        <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-primary">
            ← Back to Clients
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">{{ $client->company_name }}</h5>
            <small class="text-light">Client ID: {{ $client->id }}</small>
        </div>
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <p class="mb-1"><i class="bi bi-person-fill me-2"></i><strong>Contact Person:</strong></p>
                    <p class="text-muted">{{ $client->contact_person }}</p>
                </div>

                <div class="col-md-6">
                    <p class="mb-1"><i class="bi bi-envelope-fill me-2"></i><strong>Email:</strong></p>
                    <p class="text-muted">{{ $client->email }}</p>
                </div>

                <div class="col-md-6">
                    <p class="mb-1"><i class="bi bi-telephone-fill me-2"></i><strong>Phone:</strong></p>
                    <p class="text-muted">{{ $client->phone }}</p>
                </div>

                <div class="col-md-6">
                    <p class="mb-1"><i class="bi bi-geo-alt-fill me-2"></i><strong>Billing Address:</strong></p>
                    <p class="text-muted">{{ $client->billing_address }}</p>
                </div>

                <div class="col-md-6">
                    <p class="mb-1"><i class="bi bi-check-circle-fill me-2"></i><strong>Status:</strong></p>
                    <span class="badge bg-{{ $client->status ? 'success' : 'danger' }}">
                        {{ $client->status ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
