@extends('layouts.admin') {{-- Or change to client layout if needed --}}

@section('content')
<div class="container">
    <h2>Register a New Client</h2>

    {{-- Show errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.clients.store') }}">

        @csrf

        <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}" required>
        </div>

        <div class="form-group">
            <label for="contact_person">Contact Person</label>
            <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
        </div>

        <div class="form-group">
            <label for="billing_address">Billing Address</label>
            <textarea name="billing_address" class="form-control" required>{{ old('billing_address') }}</textarea>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Register Client</button>
    </form>
</div>
@endsection
