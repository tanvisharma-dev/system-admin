@extends('layouts.admin')

@section('title', 'Document Details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Document Details</h5>
                <div>
                    <a href="{{ route('documents.download', $document->id) }}" class="btn btn-success">
                        <i class="fas fa-download"></i> Download
                    </a>
                    <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('documents.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Documents
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 200px;">Employee</th>
                                <td>{{ $document->employee ? $document->employee->name : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Document Type</th>
                                <td>{{ $document->document_type }}</td>
                            </tr>
                            <tr>
                                <th>File</th>
                                <td>
                                    @if($document->file_path)
                                        <a href="{{ route('documents.download', $document->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-file-alt me-1"></i> {{ basename($document->file_path) }}
                                        </a>
                                    @else
                                        <span class="text-muted">No file available</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Upload Date</th>
                                <td>{{ $document->created_at ? $document->created_at->format('d M, Y h:i A') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ $document->updated_at ? $document->updated_at->format('d M, Y h:i A') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Notes</th>
                                <td>{{ $document->notes ?? 'No notes available' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection