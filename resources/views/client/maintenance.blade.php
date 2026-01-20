@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Maintenance Activity</h3>
    @foreach($maintenances as $maintenance)
        <div>
            <p>Date: {{ $maintenance->date }}</p>
            <p>Hours Worked: {{ $maintenance->hours }}</p>
            <p>Issue: {{ $maintenance->issue }}</p>
            <p>Resolved: {{ $maintenance->resolved ? 'Yes' : 'No' }}</p>
        </div>
    @endforeach
</div>
@endsection
