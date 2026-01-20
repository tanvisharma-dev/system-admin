@extends('layouts.admin')

@section('title', 'Add Student Evaluation')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Add Student Evaluation') }}</h1>

    @if (session('error'))
        <div class="alert alert-danger border-left-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Evaluation Form</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('evaluations.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="student_id" class="col-md-4 col-form-label text-md-right">{{ __('Student') }}</label>
                            <div class="col-md-6">
                                <select id="student_id" class="form-control @error('student_id') is-invalid @enderror" name="student_id" required>
                                    <option value="">Select Student</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                            {{ $student->full_name }} - {{ $student->college_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('student_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="evaluated_by" class="col-md-4 col-form-label text-md-right">{{ __('Evaluator') }}</label>
                            <div class="col-md-6">
                                <select id="evaluated_by" class="form-control @error('evaluated_by') is-invalid @enderror" name="evaluated_by" required>
                                    <option value="">Select Evaluator</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ old('evaluated_by') == $employee->id ? 'selected' : '' }}>
                                            {{ $employee->name }} - {{ $employee->designation }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('evaluated_by')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="score" class="col-md-4 col-form-label text-md-right">{{ __('Score (0-10)') }}</label>
                            <div class="col-md-6">
                                <input id="score" type="number" step="0.1" min="0" max="10" class="form-control @error('score') is-invalid @enderror" name="score" value="{{ old('score') }}" required>
                                <small class="form-text text-muted">
                                    0-3: Poor, 4-6: Average, 7-8: Good, 9-10: Excellent
                                </small>
                                @error('score')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comments" class="col-md-4 col-form-label text-md-right">{{ __('Comments') }}</label>
                            <div class="col-md-6">
                                <textarea id="comments" class="form-control @error('comments') is-invalid @enderror" name="comments" rows="4" required>{{ old('comments') }}</textarea>
                                @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hiring_decision" class="col-md-4 col-form-label text-md-right">{{ __('Hiring Decision') }}</label>
                            <div class="col-md-6">
                                <select id="hiring_decision" class="form-control @error('hiring_decision') is-invalid @enderror" name="hiring_decision" required>
                                    @foreach ($hiringDecisions as $decision)
                                        <option value="{{ $decision }}" {{ old('hiring_decision') == $decision ? 'selected' : '' }}>
                                            {{ $decision }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">
                                    This will update the student's hiring status if set to Hired or Rejected.
                                </small>
                                @error('hiring_decision')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit Evaluation') }}
                                </button>
                                <a href="{{ route('evaluations.index') }}" class="btn btn-secondary">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection