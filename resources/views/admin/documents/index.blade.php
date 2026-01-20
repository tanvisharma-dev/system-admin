@extends('layouts.admin')

@section('title', 'Documents')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Document Management</h5>
                <a href="{{ route('documents.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Upload New Document
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped"
                            data-toggle="table" data-toolbar="#toolbar" data-search="true"
                            data-show-refresh="true" data-show-toggle="true"
                            data-show-fullscreen="false" data-show-columns="true"
                            data-show-columns-toggle-all="true" data-detail-view="false"
                            data-show-export="true" data-click-to-select="true"
                            data-detail-formatter="detailFormatter"
                            data-minimum-count-columns="2" data-show-pagination-switch="true"
                            data-pagination="true" data-id-field="id"
                            data-page-list="[10, 25, 50, 100, 500, 1000 ,'all']"
                            data-show-footer="true" data-response-handler="responseHandler" id="dataTable" width="100%" cellspacing="0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Employee</th>
                                <th>Document Type</th>
                                <th>Date Uploaded</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($documents as $document)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $document->employee ? $document->employee->name : 'N/A' }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            @if($document->resume)
                                                <span class="badge bg-primary">Resume</span>
                                            @endif
                                            @if($document->aadhar)
                                                <span class="badge bg-success">Aadhar</span>
                                            @endif
                                            @if($document->pan)
                                                <span class="badge bg-warning">PAN</span>
                                            @endif
                                            @if($document->offer_letter)
                                                <span class="badge bg-info">Offer Letter</span>
                                            @endif
                                            @if($document->joining_letter)
                                                <span class="badge bg-secondary">Joining Letter</span>
                                            @endif
                                            @if($document->contract)
                                                <span class="badge bg-dark">Contract</span>
                                            @endif
                                            @if(!$document->resume && !$document->aadhar && !$document->pan && !$document->offer_letter && !$document->joining_letter && !$document->contract)
                                                <span class="text-muted">No documents uploaded</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $document->created_at ? $document->created_at->format('d M, Y') : 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('documents.show', $document->id) }}" class="btn btn-sm btn-info d-flex align-items-center h-50">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($document->file_path && Storage::disk('public')->exists($document->file_path))
                                                <a href="{{ route('documents.download', $document->id) }}" class="btn btn-sm btn-success d-flex align-items-center h-50">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            @endif
                                            <a href="{{ route('employees.edit', $document->employee_id) }}" class="btn btn-sm btn-warning d-flex align-items-center h-50" title="Edit Employee Documents">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No documents found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection