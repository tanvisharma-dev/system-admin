
@extends('layouts.client')

@section('content')
<div class="container">
    <h3>My Projects</h3>
    @foreach($projects as $project)
        <div>
            <h5 class="text-danger">{{ $project->name }}</h5>
            <p>Status: {{ $project->status }}</p>
            <p>Timeline: {{ $project->start_date }} to {{ $project->end_date }}</p>
        </div>
    @endforeach
</div>
@endsection
