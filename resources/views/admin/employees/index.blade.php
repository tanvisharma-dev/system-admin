@extends('layouts.admin')

@section('title', 'Employees')

<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Employees</h1>
    </div>
    <div class="col-md-6 text-md-end">
        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Add New
        </a>
    </div>
</div>


<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped"
                id="employeesTable"
                data-toggle="table"
                data-toolbar="#toolbar"
                data-search="true"
                data-show-refresh="true"
                data-show-toggle="true"
                data-show-columns="true"
                data-show-columns-toggle-all="true"
                data-detail-view="false"
                data-show-export="true"
                data-click-to-select="true"
                data-minimum-count-columns="2"
                data-show-pagination-switch="true"
                data-pagination="true"
                data-id-field="id"
                data-page-list="[10, 25, 50, 100, 500, 1000 ,'all']"
                data-show-footer="true"
                width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Employment Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="employeesTableBody">
                    @forelse($employees as $employee)
                    <tr>
                        <td>
                            @if($employee->profile_photo)
                                <img src="{{ asset('storage/' . $employee->profile_photo) }}" alt="Profile" class="img-thumbnail" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    <i class="fas fa-user text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>{{ $employee->employee_id ?? 'N/A' }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->personal_email ?? 'N/A' }}</td>
                        <td>{{ $employee->employment_type }}</td>
                        <td>
                            <div class="btn-group gap-3" role="group">
                                <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-info text-white custom-btn view-btn">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-warning text-white custom-btn edit-btn">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger custom-btn delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $employee->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $employee->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $employee->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $employee->id }}">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete <strong>{{ $employee->name }}</strong>? This action cannot be undone.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No employees found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4" id="paginationLinks">
            {{ $employees->links() }}
        </div>
    </div>
</div>

<style>
.custom-btn { border-radius: 5px !important; transition: all 0.3s ease-in-out; box-shadow: 0 3px 6px rgba(0,0,0,0.15); }
.custom-btn:hover { transform: translateY(-3px) scale(1.05); box-shadow: 0 6px 12px rgba(0,0,0,0.25); }
.view-btn { background: linear-gradient(45deg, #17a2b8, #0dcaf0); border: none; }
.view-btn:hover { background: linear-gradient(45deg, #0dcaf0, #17a2b8); }
.edit-btn { background: linear-gradient(45deg, #ffc107, #ffb100); border: none; }
.edit-btn:hover { background: linear-gradient(45deg, #ffb100, #ffc107); }
.delete-btn { background: linear-gradient(45deg, #dc3545, #ff4d5e); border: none; }
.delete-btn:hover { background: linear-gradient(45deg, #ff4d5e, #dc3545); }
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    function fetchEmployees(query = '', page = 1) {
        $.ajax({
            url: "{{ route('employees.ajax') }}",
            type: 'GET',
            data: { search: query, page: page },
            success: function(data) {
                $('#employeesTableBody').html(data); // Replace table rows
                // Update pagination links
                var paginationHtml = $(data).filter('#paginationLinks').html();
                if(paginationHtml) $('#paginationLinks').html(paginationHtml);
            }
        });
    }

    // Toolbar search input
    $('#searchInput').on('keyup', function() {
        var query = $(this).val();
        fetchEmployees(query);
    });

    // Pagination click
    $(document).on('click', '#paginationLinks a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var query = $('#searchInput').val();
        fetchEmployees(query, page);
    });
});
</script>
@endsection
