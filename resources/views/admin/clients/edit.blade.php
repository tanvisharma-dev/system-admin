@extends('layouts.admin')

@section('title', 'Edit Client')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">✏️ Edit Client</h2>
        <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-primary">
            ← Back to Clients
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please correct the following errors:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('admin.clients.update', $client->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" name="company_name" class="form-control" id="company_name" value="{{ old('company_name', $client->company_name) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="contact_person" class="form-label">Contact Person</label>
                        <input type="text" name="contact_person" class="form-control" id="contact_person" value="{{ old('contact_person', $client->contact_person) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $client->email) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone', $client->phone) }}" required>
                    </div>

                    <div class="col-12">
                        <label for="billing_address" class="form-label">Billing Address</label>
                        <textarea name="billing_address" class="form-control" id="billing_address" rows="3" required>{{ old('billing_address', $client->billing_address) }}</textarea>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success">
                            💾 Save Changes
                        </button>
                        <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary ms-2">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
