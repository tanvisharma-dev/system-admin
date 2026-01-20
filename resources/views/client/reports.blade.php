@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Download Reports</h3>
    <ul>
        <li><a href="{{ route('client.download.payment.report') }}">Payment Report</a></li>
        <li><a href="{{ route('client.download.maintenance.log') }}">Maintenance Logs</a></li>
        <li><a href="{{ route('client.download.documents') }}">Project Documents</a></li>
    </ul>
</div>
@endsection
