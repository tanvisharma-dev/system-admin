@extends('layouts.admin')

@section('title', 'Submit Feedback')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Submit Feedback</h1>
        <a href="{{ route('feedback.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Feedback
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Feedback Form</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('feedback.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="student_id">Student <span class="text-danger">*</span></label>
                            <select class="form-control @error('student_id') is-invalid @enderror" id="student_id" name="student_id" required>
                                <option value="">Select Student</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->full_name }} ({{ $student->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="seminar_id">Seminar <span class="text-danger">*</span></label>
                            <select class="form-control @error('seminar_id') is-invalid @enderror" id="seminar_id" name="seminar_id" required>
                                <option value="">Select Seminar</option>
                                @foreach($seminars as $seminar)
                                    <option value="{{ $seminar->id }}" {{ old('seminar_id') == $seminar->id ? 'selected' : '' }}>
                                        {{ $seminar->college_name }} - {{ $seminar->seminar_date->format('d M, Y') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('seminar_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rating">Rating <span class="text-danger">*</span></label>
                            <select class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" required>
                                <option value="">Select Rating</option>
                                @foreach($ratings as $rating)
                                    <option value="{{ $rating }}" {{ old('rating') == $rating ? 'selected' : '' }}>
                                        {{ $rating }} - {{ $rating == 1 ? 'Poor' : ($rating == 2 ? 'Fair' : ($rating == 3 ? 'Good' : ($rating == 4 ? 'Very Good' : 'Excellent'))) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="feedback_text">Feedback <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('feedback_text') is-invalid @enderror" id="feedback_text" name="feedback_text" rows="5" required>{{ old('feedback_text') }}</textarea>
                            @error('feedback_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Submit Feedback
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection