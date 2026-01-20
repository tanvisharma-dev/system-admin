@extends('layouts.admin')

@section('title', 'Departments')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Departments</h1>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('departments.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Department
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
       
        <div class="table-responsive">
            <table id="dataTable"
                class="table table-striped"
                data-toggle="table"
                data-toolbar="#toolbar"
                data-search="true"
                data-show-refresh="true"
                data-show-toggle="true"
                data-show-fullscreen="false"
                data-show-columns="true"
                data-show-columns-toggle-all="true"
                data-detail-view="false"
                data-show-export="true"
                data-click-to-select="true"
                data-detail-formatter="detailFormatter"
                data-minimum-count-columns="2"
                data-show-pagination-switch="true"
                data-pagination="true"
                data-side-pagination="server"
                data-url="{{ route('departments.ajax') }}"
                data-page-list="[10,25,50,100]"
                data-response-handler="responseHandler"
                width="100%">
                <thead>
                    <tr>
                        <th data-field="name" data-sortable="true">Name</th>
                        <th data-field="description">Description</th>
                        <th data-field="status">Status</th>
                        <th data-field="created_at" data-sortable="true">Created At</th>
                        <th data-field="actions">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<style>
    .custom-btn {
        border-radius: 5px !important;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 3px 6px rgba(0,0,0,0.15);
    }

    .custom-btn:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 6px 12px rgba(0,0,0,0.25);
    }

    .view-btn {
        background: linear-gradient(45deg, #17a2b8, #0dcaf0);
        border: none;
        color: white;
    }
    .view-btn:hover {
        background: linear-gradient(45deg, #0dcaf0, #17a2b8);
    }

    .edit-btn {
        background: linear-gradient(45deg, #ffc107, #ffb100);
        border: none;
        color: white;
    }
    .edit-btn:hover {
        background: linear-gradient(45deg, #ffb100, #ffc107);
    }

    .delete-btn {
        background: linear-gradient(45deg, #dc3545, #ff4d5e);
        border: none;
        color: white;
    }
    .delete-btn:hover {
        background: linear-gradient(45deg, #ff4d5e, #dc3545);
    }
</style>

<script>
    function responseHandler(res) {
        return res; // Expecting { total: ..., rows: [...] } JSON from Laravel
    }
</script>

@endsection
