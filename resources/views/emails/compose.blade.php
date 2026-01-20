@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Compose New Email</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('emails.send') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="from">From (Your Gmail):</label>
                            <input type="email" class="form-control" id="from" name="from" value="{{ auth()->user()->email ?? '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="to">To:</label>
                            <input type="email" class="form-control" id="to" name="to" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject:</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="body">Message:</label>
                            <textarea class="form-control" id="body" name="body" rows="10" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Send Email</button>
                            <a href="{{ route('emails.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
