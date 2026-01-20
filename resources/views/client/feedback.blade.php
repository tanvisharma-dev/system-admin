@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Submit Feedback</h3>
    <form method="POST" action="{{ route('client.feedback.submit') }}" enctype="multipart/form-data">
        @csrf
        <textarea name="feedback" class="form-control" required></textarea>
        <input type="file" name="attachment" class="form-control mt-2">
        <button class="btn btn-success mt-2">Submit</button>
    </form>

    <h4 class="mt-4">My Feedback</h4>
    @foreach($feedbacks as $fb)
        <div>
            <p>Status: {{ $fb->status }}</p>
            <p>{{ $fb->text }}</p>
        </div>
    @endforeach
</div>
@endsection
