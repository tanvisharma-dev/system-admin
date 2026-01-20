@extends('layouts.admin')

@section('title', 'Letters')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Letters</h1>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('letters.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Letter
        </a>
    </div>
</div>

<div class="card">
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
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee</th>
                        <th>Letter Type</th>
                        <th>Send Via</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($letters as $letter)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
<td>{{ $letter->employee?->name ?? 'N/A' }}</td>
                        <td class="bg-have">{!! $letter->letter_type_badge !!}</td>
                        <td class="bg-have">{!! $letter->send_via_badge !!}</td>
                        <td class="bg-have">{!! $letter->status_badge !!}</td>
                        <td>{{ $letter->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('letters.show', $letter) }}" class="btn btn-sm btn-info text-white">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(!$letter->is_sent)
                                <a href="{{ route('letters.edit', $letter) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('letters.destroy', $letter) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger text-white" onclick="return confirm('Are you sure you want to delete this letter?')">
                                        <i class="fas fa-trash "></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No letters found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $letters->links() }}
        </div>
    </div>
</div>
@endsection