@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Upload Attendance</h1>
        <a href="{{ route('attendances.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Attendance
        </a>
    </div>

    <!-- Upload Form -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Upload Excel File</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('attendances.upload') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                        <label for="file"><strong>Select Excel/CSV File</strong></label>
                        <input type="file" 
                               class="form-control-file @error('file') is-invalid @enderror" 
                               id="file" 
                               name="file" 
                               accept=".csv,.xls,.xlsx"
                               required>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Please upload Excel (.xls, .xlsx) or CSV (.csv) files.
                        </small>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-upload"></i> Upload Attendance
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Uploaded Excel Files -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Uploaded Excel Files</h6>
        </div>
        <div class="card-body">
            @if($uploadedFiles->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>File Name</th>
                                <th>Upload Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($uploadedFiles as $file)
                            <tr>
                                <td>{{ $file->name }}</td>
                                <td>{{ $file->upload_date->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="{{ $file->url }}" class="btn btn-sm btn-primary" download>
                                        <i class="fas fa-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center text-muted py-4">
                    <i class="fas fa-file-excel fa-3x mb-3"></i>
                    <p>No Excel files uploaded yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": true,
            "pageLength": 10,
            "ordering": false,
            "info": true,
            "searching": false
        });
    });
</script>
@endsection
