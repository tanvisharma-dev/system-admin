@extends('layouts.admin')

@section('title', 'Notifications')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Notifications</h1>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('notifications.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Create New Notification
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
                        <th>Title</th>
                        <th>Recipient Type</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notifications as $notification)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $notification->title }}</td>
                        <td class="bg-have">{!! $notification->recipient_type_badge !!}</td>
                        <td class="bg-have">{!! $notification->status_badge !!}</td>
                        <td>{{ $notification->created_at->format('M d, Y') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('notifications.show', $notification) }}" class="btn btn-sm btn-info d-flex alig-items-center h-50">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('notifications.destroy', $notification) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this notification?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No notifications found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $notifications->links() }}
        </div>
    </div>
</div>
@endsection