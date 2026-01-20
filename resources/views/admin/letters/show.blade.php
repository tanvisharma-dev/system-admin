@extends('layouts.admin')

@section('title', 'View Letter')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>View Letter</h1>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('letters.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Letters
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Letter Details</h5>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Letter Type:</th>
                        <td>{!! $letter->letter_type_badge !!}</td>
                    </tr>
                    <tr>
                        <th>Send Via:</th>
                        <td>{!! $letter->send_via_badge !!}</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>{!! $letter->status_badge !!}</td>
                    </tr>
                    <tr>
                        <th>Created At:</th>
                        <td>{{ $letter->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                    @if($letter->is_sent)
                    <tr>
                        <th>Sent At:</th>
                        <td>{{ $letter->sent_at->format('M d, Y H:i') }}</td>
                    </tr>
                    @endif
                </table>
                
                <div class="mt-3">
                    @if(!$letter->is_sent)
                    <form action="{{ route('letters.send', $letter) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-paper-plane"></i> Send Letter
                        </button>
                    </form>
                    @endif
                    
                    <a href="{{ route('letters.download', $letter) }}" class="btn btn-info">
                        <i class="fas fa-download"></i> Download
                    </a>
                    
                    @if(!$letter->is_sent)
                    <a href="{{ route('letters.edit', $letter) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    
                    <form action="{{ route('letters.destroy', $letter) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this letter?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Employee Information</h5>
            </div>
            <div class="card-body text-center">
                @if($letter->employee)
                    <img src="{{ $letter->employee->photo }}" alt="{{ $letter->employee->name }}" class="rounded-circle mb-3" width="100">
                    <table class="table">
                        <tr>
                            <th>Name:</th>
                            <td>{{ $letter->employee->name }}</td>
                        </tr>
                        <tr>
                            <th>Employee ID:</th>
                            <td>{{ $letter->employee->employee_id }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $letter->employee->email }}</td>
                        </tr>
                        <tr>
                            <th>Designation:</th>
                            <td>{{ $letter->employee->designation }}</td>
                        </tr>
                        <tr>
                            <th>Department:</th>
                            <td>{{ $letter->employee->department }}</td>
                        </tr>
                    </table>
                    <a href="{{ route('employees.show', $letter->employee) }}" class="btn btn-sm btn-info">
                        <i class="fas fa-user"></i> View Employee
                    </a>
                @else
                    <img src="https://via.placeholder.com/100" alt="No Employee" class="rounded-circle mb-3">
                    <table class="table">
                        <tr>
                            <th>Name:</th>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <th>Employee ID:</th>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <th>Designation:</th>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <th>Department:</th>
                            <td>N/A</td>
                        </tr>
                    </table>
                    <button class="btn btn-sm btn-secondary" disabled>
                        <i class="fas fa-user"></i> No Employee
                    </button>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Letter Content</h5>
            </div>
            <div class="card-body">
                <div class="letter-content border p-4">
                    {!! $letter->content !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
