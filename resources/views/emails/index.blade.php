@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Email Inbox</h3>
                        <a href="{{ route('emails.compose') }}" class="btn btn-primary">Compose New Email</a>
                    </div>
                </div>
                <div class="card-body">
                    @if(!$emails)
                        <div class="alert alert-info">
                            Please connect your Gmail account to view emails
                            <a href="{{ route('email.login') }}" class="btn btn-sm btn-primary">Connect Gmail</a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>From</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($emails as $email)
                                        <tr>
                                            <td>{{ $email['from'] }}</td>
                                            <td>{{ $email['subject'] }}</td>
                                            <td>{{ $email['date'] }}</td>
                                            <td>
                                                <a href="{{ route('emails.view', $email['id']) }}" class="btn btn-sm btn-info">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
