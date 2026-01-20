@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">View Email</h3>
                </div>
                <div class="card-body">
                    <div class="email-header mb-4">
                        <h4>{{ $subject ?? 'No Subject' }}</h4>
                        <p class="text-muted">
                            From: {{ $from ?? 'Unknown' }}<br>
                            Date: {{ $date ?? 'Unknown' }}
                        </p>
                    </div>
                    <div class="email-body">
                        <div class="card">
                            <div class="card-body">
                                <pre>{{ $body ?? 'No content available' }}</pre>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
