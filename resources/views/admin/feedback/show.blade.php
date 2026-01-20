@extends('layouts.admin')

@section('title', 'Feedback Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Feedback Details</h1>
        <div>
            <a href="{{ route('feedback.edit', $feedback->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('feedback.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Feedback
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Feedback #{{ $feedback->id }}</h6>
                    <div>
                        <span class="badge bg-info text-white">Submitted: {{ $feedback->submitted_at->format('d M, Y H:i') }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="font-weight-bold">Student Information</h5>
                            <p><strong>Name:</strong> {{ $feedback->student->full_name }}</p>
                            <p><strong>Email:</strong> {{ $feedback->student->email }}</p>
                            <p><strong>Phone:</strong> {{ $feedback->student->phone }}</p>
                            <p><strong>College:</strong> {{ $feedback->student->college_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="font-weight-bold">Seminar Information</h5>
                            <p><strong>College:</strong> {{ $feedback->seminar->college_name }}</p>
                            <p><strong>Date:</strong> {{ $feedback->seminar->seminar_date->format('d M, Y') }}</p>
                            <p><strong>Location:</strong> {{ $feedback->seminar->location }}</p>
                            <p><strong>Status:</strong> {!! $feedback->seminar->status_badge !!}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="font-weight-bold">Rating</h5>
                            <div class="mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $feedback->rating)
                                        <i class="fas fa-star fa-2x text-warning"></i>
                                    @else
                                        <i class="far fa-star fa-2x text-warning"></i>
                                    @endif
                                @endfor
                                <span class="ms-2 fs-5">
                                    {{ $feedback->rating }}/5 - 
                                    {{ $feedback->rating == 1 ? 'Poor' : ($feedback->rating == 2 ? 'Fair' : ($feedback->rating == 3 ? 'Good' : ($feedback->rating == 4 ? 'Very Good' : 'Excellent'))) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="font-weight-bold">Feedback</h5>
                            <div class="p-3 bg-light rounded">
                                {{ $feedback->feedback_text }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete Feedback
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection