    @extends('layouts.admin')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bank Details Management</h1>
        <a href="{{ route('bank-details.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Bank Details
        </a>
    </div>

    <!-- Alert Messages -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Bank Details</h6>
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
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee</th>
                            <th>Bank Name</th>
                            <th>Account Number</th>
                            <th>IFSC Code</th>
                            <th>UPI ID</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bankDetails as $bankDetail)
                        <tr>
                            <td>{{ $bankDetail->id }}</td>
<td>{{ $bankDetail->employee->name ?? 'N/A' }}</td>
                            <td>{{ $bankDetail->bank_name }}</td>
                            <td>{{ $bankDetail->account_number }}</td>
                            <td>{{ $bankDetail->ifsc_code }}</td>
                            <td>{{ $bankDetail->uan_number ?? 'N/A' }}</td>
                            <td style="display: flex">
                                <a href="{{ route('bank-details.show', $bankDetail->id) }}" class="btn btn-sm btn-info text-white h-50">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('bank-details.edit', $bankDetail->id) }}" class="btn btn-sm btn-warning text-white h-50">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form method="POST" action="{{ route('bank-details.destroy', $bankDetail->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger text-white" type="submit" onclick="return confirm('Are you sure you want to delete these bank details?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $bankDetails->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": false,
            "info": false
        });
    });
</script>
@endsection