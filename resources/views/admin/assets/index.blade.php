@extends('layouts.admin')

@section('title', 'Assets')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Asset Management</h5>
                <a href="{{ route('assets.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Asset
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
                                <th>Asset Name</th>
                                <th>Assigned To</th>
                                <th>Serial Number</th>
                                <th>Issued Date</th>
                                <th>Condition</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($assets as $asset)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $asset->device_type }}</td>
                                    <td>{{ $asset->employee ? $asset->employee->name : 'N/A' }}</td>
                                    <td>{{ $asset->serial_number }}</td>
                                    <td>{{ $asset->issued_date ? $asset->issued_date->format('d M, Y') : 'N/A' }}</td>
                                    <td>{{ $asset->asset_condition }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('assets.show', $asset->id) }}" class="btn btn-sm btn-info d-flex align-items-center h-50">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-sm btn-warning  d-flex align-items-center h-50">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this asset?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No assets found.</td>
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