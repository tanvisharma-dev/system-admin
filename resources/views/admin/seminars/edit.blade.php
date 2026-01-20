@extends('layouts.admin')

@section('title', 'Edit Seminar')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Seminar</h1>
        <a href="{{ route('seminars.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Seminars
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold">Seminar Details</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('seminars.update', $seminar->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="college_name">College Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('college_name') is-invalid @enderror" id="college_name" name="college_name" value="{{ old('college_name', $seminar->college_name) }}" required>
                            @error('college_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="seminar_date">Seminar Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('seminar_date') is-invalid @enderror" id="seminar_date" name="seminar_date" value="{{ old('seminar_date', $seminar->seminar_date->format('Y-m-d')) }}" required>
                            @error('seminar_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="location">Location <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $seminar->location) }}" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contact_person">Contact Person <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('contact_person') is-invalid @enderror" id="contact_person" name="contact_person" value="{{ old('contact_person', $seminar->contact_person) }}" required>
                            @error('contact_person')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="">Select Status</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ old('status', $seminar->status) == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea class="form-control @error('remarks') is-invalid @enderror" id="remarks" name="remarks" rows="3">{{ old('remarks', $seminar->remarks) }}</textarea>
                            @error('remarks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Seminar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection