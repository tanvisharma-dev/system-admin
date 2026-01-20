@extends('layouts.admin')

@section('title', 'Asset Details')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Asset Details</h5>
                <div>
                    <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('assets.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Assets
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 200px;">Asset Name</th>
                                <td>{{ $asset->device_type }}</td>
                            </tr>
                            <tr>
                                <th>Assigned To</th>
                                <td>{{ $asset->employee ? $asset->employee->name : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Serial Number</th>
                                <td>{{ $asset->serial_number }}</td>
                            </tr>
                            <tr>
                                <th>Issued Date</th>
                                <td>{{ $asset->issued_date ? $asset->issued_date->format('d M, Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Return Date</th>
                                <td>{{ $asset->return_date ? $asset->return_date->format('d M, Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Condition</th>
                                <td>
                                    @if($asset->asset_condition == 'Working')
                                        <span class="badge bg-success">{{ $asset->asset_condition }}</span>
                                    @elseif($asset->asset_condition == 'Damaged')
                                        <span class="badge bg-danger">{{ $asset->asset_condition }}</span>
                                    @elseif($asset->asset_condition == 'Under Repair')
                                        <span class="badge bg-warning">{{ $asset->asset_condition }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $asset->asset_condition }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Notes</th>
                                <td>{{ $asset->notes ?? 'No notes available' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection